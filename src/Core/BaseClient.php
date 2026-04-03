<?php

declare(strict_types=1);

namespace Believe\Core;

use Believe\RequestOptions;
use Believe\Core\Contracts\BasePage;
use Believe\Core\Contracts\BaseStream;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Conversion\Contracts\Converter;
use Believe\Core\Conversion\Contracts\ConverterSource;
use Believe\Core\Exceptions\APIStatusException;
use Believe\Core\Exceptions\APIConnectionException;
use Believe\Core\Implementation\RawResponse;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  * @phpstan-type NormalizedRequest = array{
  *   method: string,
  *   path: string,
  *   query: array<string,mixed>,
  *   headers: array<string,string|null|list<string>>,
  *   body: mixed,
  * }
  *
 */
abstract class BaseClient
{
  protected UriInterface $baseUrl;

  /**
  * @internal
  *
  * @return string
 */
  protected function generateIdempotencyKey(): string {
    $hex = bin2hex(random_bytes(32));
    return "stainless-php-retry-{$hex}";
  }

  /**
  * @internal
  *
  * @param string $method
  * @param string|list<string> $path
  * @param array<string,mixed> $query
  * @param array<string,string|int|null|list<string|int>> $headers
  * @param mixed $body
  * @param RequestOpts|null $opts
  *
  * @return array{NormalizedRequest, RequestOptions}
 */
  protected function buildRequest(
    string $method,
    string|array $path,
    array $query,
    array $headers,
    mixed $body,
    null|RequestOptions|array $opts,
  ): array {
    $options = RequestOptions::parse($this->options, $opts);

    $parsedPath = Util::parsePath($path);
    /** @var array<string,mixed> $mergedQuery */
    $mergedQuery = array_merge_recursive(
      $query, $options->extraQueryParams ?? []
    );
    $uri = Util::joinUri($this->baseUrl, path: $parsedPath, query: $mergedQuery)->__toString();
    $idempotencyHeaders = $this->idempotencyHeader && !array_key_exists($this->idempotencyHeader, array: $headers)
        ? [$this->idempotencyHeader => $this->generateIdempotencyKey()]
        : [];
    /** @var array<string,string|null|list<string>> $mergedHeaders */
    $mergedHeaders = [
      ...$this->headers,
      ...$headers,
      ...($options->extraHeaders ?? []),
      ...$idempotencyHeaders
    ];

    $req = ['method' => strtoupper($method), 'path' => $uri, 'query' => $mergedQuery, 'headers' => $mergedHeaders, 'body' => $body];

    return [$req, $options];
  }

  /**
  * @param RequestInterface $request
  *
  * @return RequestInterface
 */
  protected function transformRequest(
    RequestInterface $request
  ): RequestInterface {
    return $request;
  }

  /**
  * @internal
  *
  * @param ResponseInterface $rsp
  * @param RequestInterface $req
  *
  * @return RequestInterface
 */
  protected function followRedirect(
    ResponseInterface $rsp, RequestInterface $req
  ): RequestInterface {
    $location = $rsp->getHeaderLine('Location');
    if (!$location) {
        throw new APIConnectionException($req, message: "Redirection without Location header");
    }

    $uri = Util::joinUri($req->getUri(), path: $location);
    return $req->withUri($uri);
  }

  /**
  * @internal
  *
  * @param RequestOptions $opts
  * @param int $retryCount
  * @param ResponseInterface|null $rsp
  *
  * @return bool
 */
  protected function shouldRetry(
    RequestOptions $opts, int $retryCount, ?ResponseInterface $rsp
  ): bool {
    if ($retryCount >= $opts->maxRetries) {
        return false;
    }

    $code = $rsp?->getStatusCode();
    if ($code == 408 || $code == 409 || $code == 429 || $code >= 500) {
        return true;
    }

    return false;
  }

  /**
  * @internal
  *
  * @param RequestOptions $opts
  * @param int $retryCount
  * @param ResponseInterface|null $rsp
  *
  * @return float
 */
  protected function retryDelay(
    RequestOptions $opts, int $retryCount, ?ResponseInterface $rsp
  ): float {
    if (!empty($header = $rsp?->getHeaderLine("retry-after"))) {
        if (is_numeric($header)) {
            return floatval($header);
        }

        try {
          $date = new \DateTimeImmutable($header);
          $span = time() - $date->getTimestamp();

          return max(0.0, $span);
        } catch (\DateMalformedStringException) {}
    }

    $scale = $retryCount ** 2;
    $jitter = 1 - (0.25 * mt_rand() / mt_getrandmax());
    $naive = $opts->initialRetryDelay * $scale * $jitter;
    return max(0.0, min($naive, $opts->maxRetryDelay));
  }

  /**
  * @internal
  *
  * @param RequestOptions $opts
  * @param RequestInterface $req
  * @param bool|int|float|string|null|resource|\Traversable<mixed,>|array<string,mixed> $data
  * @param int $retryCount
  * @param int $redirectCount
  *
  * @return ResponseInterface
 */
  protected function sendRequest(
    RequestOptions $opts,
    RequestInterface $req,
    mixed $data,
    int $retryCount,
    int $redirectCount,
  ): ResponseInterface {
    assert($opts->streamFactory !== null && $opts->transporter !== null);

    /** @var RequestInterface */
    $req = $req->withHeader('X-Stainless-Retry-Count', strval($retryCount));
    $req = Util::withSetBody($opts->streamFactory, req: $req, body: $data);

      $rsp = null;
      $err = null;
      try {
          $rsp = $opts->transporter->sendRequest($req);
      } catch (ClientExceptionInterface $e) {
          $err = $e;
      }

      $code = $rsp?->getStatusCode();


    if ($code >= 300 && $code < 400) {
        assert(!is_null($rsp));

        if ($redirectCount >= 20) {
            throw new APIConnectionException($req, message: "Maximum redirects exceeded");
        }

        $req = $this->followRedirect($rsp, req: $req);

        return $this->sendRequest($opts, req: $req, data: $data, retryCount: $retryCount, redirectCount: ++$redirectCount);
    }

    if ($code >= 400 || is_null($rsp)) {
         if (!$this->shouldRetry($opts, retryCount: $retryCount, rsp: $rsp)) {
            $exn = is_null($rsp) ? new APIConnectionException($req, previous: $err) : APIStatusException::from(request: $req, response: $rsp);

            throw $exn;
         }

         $seconds = $this->retryDelay($opts, retryCount: $retryCount, rsp: $rsp);
         $floor = floor($seconds);
         time_nanosleep((int) $floor, nanoseconds: (int) ($seconds - $floor) * 10 ** 9);

         return $this->sendRequest($opts, req: $req, data: $data, retryCount: ++$retryCount, redirectCount: $redirectCount);
    }

    return $rsp;
  }

  /**
  * @param string $method
  * @param string|list<mixed> $path
  * @param array<string,mixed> $query
  * @param array<string,mixed> $headers
  * @param mixed $body
  * @param string|int|null|list<string|int> $unwrap
  * @param string|null|Converter|ConverterSource $convert
  * @param class-string<BasePage<mixed>>|null $page
  * @param class-string<BaseStream<mixed>>|null $stream
  * @param null|RequestOptions|array<string,mixed> $options
  *
  * @return BaseResponse<mixed>
 */
  function request(
    string $method,
    string|array $path,
    array $query = [],
    array $headers = [],
    mixed $body = null,
    string|int|null|array $unwrap = null,
    string|null|Converter|ConverterSource $convert = null,
    ?string $page = null,
    ?string $stream = null,
    null|RequestOptions|array $options = [],
  ): BaseResponse {
    [$req, $opts] = $this->buildRequest(
      method: $method,
      // @phpstan-ignore argument.type
      path: $path,
      query: $query,
      // @phpstan-ignore argument.type
      headers: $headers,
      body: $body,
      // @phpstan-ignore argument.type
      opts: $options,
    );
    ['method' => $method, 'path' => $uri, 'headers' => $headers, 'body' => $data] = $req;
    assert(!is_null($opts->requestFactory));

    $request = $opts->requestFactory->createRequest($method, uri: $uri);
    $request = Util::withSetHeaders($request, headers: $headers);
    $request = $this->transformRequest($request);

    // @phpstan-ignore-next-line argument.type
    $rsp = $this->sendRequest($opts, req: $request, data: $data, redirectCount: 0, retryCount: 0);

    // @phpstan-ignore-next-line argument.type
    $raw = new RawResponse(client: $this, request: $request, response: $rsp, options: $opts, requestInfo: $req, unwrap: $unwrap, stream: $stream, page: $page, convert: $convert ?? 'null');

    return $raw;
  }

  /**
  * @internal
  *
  * @param array<string,string|int|null|list<string|int>> $headers
  * @param string|null $idempotencyHeader
  * @param RequestOptions $options
  * @param string $baseUrl
 */
  function __construct(
    protected array $headers,
    string $baseUrl,
    protected ?string $idempotencyHeader = null,
    protected RequestOptions $options = new RequestOptions(),
  ) {
    assert(!is_null($this->options->uriFactory));
    $this->baseUrl = $this->options->uriFactory->createUri($baseUrl);
  }
}