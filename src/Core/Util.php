<?php

declare(strict_types=1);

namespace Believe\Core;

use Psr\Http\Message\UriInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\ResponseInterface;

/**
  *
  * @phpstan-type SSEvent = array{
  *   event?: string|null, data?: string|null, id?: string|null, retry?: int|null
  * }
  *
 */
final class Util
{
  public const BUF_SIZE = 8192;

  public const JSON_ENCODE_FLAGS = JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

  public const JSON_CONTENT_TYPE = '/^application\/(?:vnd(?:.[^.]+)*+)?json(?!l)/';

  public const JSONL_CONTENT_TYPE = '/^application\/(:?x-(?:n|l)djson)|(:?(?:x-)?jsonl)/';

  /**
  * @param string $key
  *
  * @return string|null
 */
  public static function getenv(string $key): ?string {
    if (array_key_exists($key, array: $_ENV)) {
        if (!is_string($value = $_ENV[$key])) {
            throw new \InvalidArgumentException;
        }
        return $value;
    }

    if (is_string($value = getenv($key))) {
        return $value;
    }

    return null;
  }

  /**
  * @param object $object
  *
  * @return array<string,mixed>
 */
  public static function get_object_vars(object $object): array {
    return get_object_vars($object);
  }

  /** @return string */
  public static function machtype(): string {
    $arch = php_uname('m');

    return match (true) {
        str_contains($arch, 'aarch64'), str_contains($arch, 'arm64') => 'arm64',
        str_contains($arch, 'x86_64'), str_contains($arch, 'amd64') => 'x64',
        str_contains($arch, 'i386'), str_contains($arch, 'i686') => 'x32',
        str_contains($arch, 'arm') => 'arm',
        default => 'unknown',
    };
  }

  /** @return string */
  public static function ostype(): string {
    return match ($os = strtolower(PHP_OS_FAMILY)) {
        'linux' => 'Linux',
        'darwin' => 'MacOS',
        'windows' => 'Windows',
        'solaris' => 'Solaris',
        // @phpstan-ignore-next-line match.alwaysFalse
        'bsd', 'freebsd', 'openbsd' => 'BSD',
        default => "Other:$os",
    };
  }

  /**
  * @template T
  *
  * @param array<string,T> $array
  * @param array<string,string> $map
  *
  * @return array<string,T>
 */
  public static function array_transform_keys(array $array, array $map): array {
    $acc = [];
    foreach ($array as $key => $value) {
        $acc[$map[$key] ?? $key] = $value;
    }
    return $acc;
  }

  /**
  * @param mixed $value
  *
  * @return string
 */
  public static function strVal(mixed $value): string {
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    if (is_object($value) && is_a($value, class: \DateTimeInterface::class)) {
        return date_format($value, format: \DateTimeInterface::RFC3339);
    }

    // @phpstan-ignore-next-line argument.type
    return strval($value);
  }

  /**
  * @param callable $callback
  * @param mixed $value
  *
  * @return mixed
 */
  public static function mapRecursive(mixed $callback, mixed $value): mixed {
    $mapped = match (true) {
        is_array($value) => array_map(static fn ($v) => static::mapRecursive($callback, value: $v), $value),
        default => $value,
    };

    return $callback($mapped);
  }

  /**
  * @param mixed $value
  *
  * @return mixed
 */
  public static function removeNulls(mixed $value): mixed {
    $mapped = static::mapRecursive(
        static fn ($vs) => is_array($vs) && !array_is_list($vs) ? array_filter($vs, callback: static fn ($v) => !is_null($v)) : $vs,
        value: $value
    );

    return $mapped;
  }

  /**
  * @param mixed $array
  * @param string|int|list<string|int>|callable $key
  *
  * @return mixed
 */
  public static function dig(
    mixed $array, string|int|array|callable $key
  ): mixed {
    if (is_callable($key)) {
        return $key($array);
    }

    if (is_array($array)) {
        if ((is_string($key) || is_int($key)) && array_key_exists($key, array: $array)) {
            return $array[$key];
        }

        if (is_array($key) && !empty($key)) {
            if (array_key_exists($fst = $key[0], array: $array)) {
                return static::dig($array[$fst], key: array_slice($key, 1));
            }
        }
    }

    return null;
  }

  /**
  * @param string|list<string> $path
  *
  * @return string
 */
  public static function parsePath(string|array $path): string {
    if (is_string($path)) {
      return $path;
    }

    if (empty($path)) {
      return '';
    }

    [$template] = $path;
    $mapped = array_map(static fn ($s) => rawurlencode(static::strVal($s)), array: array_slice($path, 1));

    return sprintf($template, ...$mapped);
  }

  /**
  * @param UriInterface $base
  * @param string $path
  * @param array<string,mixed> $query
  *
  * @return UriInterface
 */
  public static function joinUri(
    UriInterface $base, string $path, array $query = []
  ): UriInterface {
    $parsed = parse_url($path);
    if ($scheme = $parsed['scheme'] ?? null) {
      $base = $base->withScheme($scheme);
    }
    if ($host = $parsed['host'] ?? null) {
      $base = $base->withHost($host);
    }
    if ($port = $parsed['port'] ?? null) {
      $base = $base->withPort($port);
    }
    if (($user = $parsed['user'] ?? null) || ($pass = $parsed['pass'] ?? null)) {
      $base = $base->withUserInfo($user ?? '', $pass ?? null);
    }
    if ($path = $parsed['path'] ?? null) {
      $base = str_starts_with($path, "/") ? $base->withPath($path) : $base->withPath($base->getPath() . '/' . $path);
    }

    [$q1, $q2] = [[], []];
    parse_str($base->getQuery(), $q1);
    parse_str($parsed['query'] ?? '', $q2);

    $mergedQuery = array_merge_recursive($q1, $q2, $query);
    /** @var array<string,mixed> */
    $normalizedQuery = static::mapRecursive(
        static fn ($v) => is_bool($v) || is_numeric($v) ? static::strVal($v) : $v,
        value: $mergedQuery
    );
    $qs = http_build_query($normalizedQuery, encoding_type: PHP_QUERY_RFC3986);

    return $base->withQuery($qs);
  }

  /**
  * @param RequestInterface $req
  * @param array<string,string|int|null|list<string|int>> $headers
  *
  * @return RequestInterface
 */
  public static function withSetHeaders(
    RequestInterface $req, array $headers
  ): RequestInterface {
    foreach ($headers as $name => $value) {
        if (is_null($value)) {
            /** @var RequestInterface */
            $req = $req->withoutHeader($name);
        } else {
            $value = is_array($value) ? array_map(static fn ($v) => static::strVal($v), array: $value) : static::strVal($value);

            /** @var RequestInterface */
            $req = $req->withHeader($name, $value);
        }
    }
    return $req;
  }

  /**
  * @param StreamInterface $stream
  *
  * @return \Iterator<string>
 */
  public static function streamIterator(StreamInterface $stream): \Iterator {
    if (!$stream->isReadable()) {
        return;
    }
    try {
        while (!$stream->eof()) {
            yield $stream->read(static::BUF_SIZE);
        }
    } finally {
        $stream->close();
    }
  }

  /**
  * @param mixed $val
  * @param list<callable> $closing
  * @param string|null $contentType
  *
  * @return \Generator<string>
 */
  private static function writeMultipartContent(
    mixed $val, array &$closing, ?string $contentType = NULL
  ): \Generator {
    $contentLine = "Content-Type: %s\r\n\r\n";

    if (is_resource($val)) {
        yield sprintf($contentLine, $contentType ?? 'application/octet-stream');
        while (!feof($val)) {
            if ($read = fread($val, length: static::BUF_SIZE)) {
                yield $read;
            }
        }
    } else if (is_string($val) || is_numeric($val) || is_bool($val)) {
        yield sprintf($contentLine, $contentType ?? 'text/plain');
        yield static::strVal($val);
    } else {
        yield sprintf($contentLine, $contentType ?? 'application/json');
        yield json_encode($val, flags: static::JSON_ENCODE_FLAGS);
    }

    yield "\r\n";
  }

  /**
  * @param string $boundary
  * @param string|null $key
  * @param mixed $val
  * @param list<callable> $closing
  *
  * @return \Generator<string>
 */
  private static function writeMultipartChunk(
    string $boundary, ?string $key, mixed $val, array &$closing
  ): \Generator {
    yield "--{$boundary}\r\n";
    yield "Content-Disposition: form-data";

    if (!is_null($key)) {
        $name = rawurlencode(static::strVal($key));
        yield "; name=\"{$name}\"";
    }

    yield "\r\n";
    foreach (static::writeMultipartContent($val, closing: $closing) as $chunk) {
        yield $chunk;
    }
  }

  /**
  * @param bool|int|float|string|null|resource|\Traversable<mixed,>|array<string,mixed> $body
  *
  * @return array{string, \Generator<string>}
 */
  private static function encodeMultipartStreaming(mixed $body): array {
    $boundary = rtrim(strtr(base64_encode(random_bytes(60)), '+/', '-_'), '=');
    $gen = (function() use ($boundary, $body) {
      $closing = [];
      try {
          if (is_array($body) || is_object($body)) {
              foreach ((array) $body as $key => $val) {
                  foreach (static::writeMultipartChunk(boundary: $boundary, key: $key, val: $val, closing: $closing) as $chunk) {
                      yield $chunk;
                  }
              }
          } else {
              foreach (static::writeMultipartChunk(boundary: $boundary, key: NULL, val: $body, closing: $closing) as $chunk) {
                  yield $chunk;
              }
          }
          yield "--{$boundary}--\r\n";
      } finally {
          foreach ($closing as $c) {
              $c();
          }
      }
    })();

    return [$boundary, $gen];
  }

  /**
  * @param StreamFactoryInterface $factory
  * @param RequestInterface $req
  * @param bool|int|float|string|null|resource|\Traversable<mixed,>|array<string,mixed> $body
  *
  * @return RequestInterface
 */
  public static function withSetBody(
    StreamFactoryInterface $factory, RequestInterface $req, mixed $body
  ): RequestInterface {
    if ($body instanceof StreamInterface) {
        /** @var RequestInterface */
        $req = $req->withBody($body);
        return $req;
    }

    $contentType = $req->getHeaderLine('Content-Type');
    if (preg_match(static::JSON_CONTENT_TYPE, $contentType)) {
        if (is_array($body) || is_object($body)) {
            $encoded = json_encode($body, flags: static::JSON_ENCODE_FLAGS);
            $stream = $factory->createStream($encoded);

            /** @var RequestInterface */
            $req = $req->withBody($stream);
            return $req;
        }
    }

    if (preg_match('/^multipart\/form-data/', $contentType)) {
        [$boundary, $gen] = static::encodeMultipartStreaming($body);
        $encoded = implode("", iterator_to_array($gen));
        $stream = $factory->createStream($encoded);

        /** @var RequestInterface */
        $req = $req->withHeader('Content-Type', "{$contentType}; boundary={$boundary}")->withBody($stream);
        return $req;
    }

    if (is_resource($body)) {
        $stream = $factory->createStreamFromResource($body);

        /** @var RequestInterface */
        $req = $req->withBody($stream);
        return $req;
    }

    if (is_string($body)) {
        $stream = $factory->createStream($body);

        /** @var RequestInterface */
        return $req->withBody($stream);
    }

    return $req;
  }

  /**
  * @param \Iterator<string> $stream
  *
  * @return \Iterator<string>
 */
  public static function decodeLines(\Iterator $stream): \Iterator {
    $buf = '';
    foreach ($stream as $chunk) {
        $buf .= $chunk;
        while (($pos = strpos($buf, "\n")) !== false) {
            yield substr($buf, 0, $pos);
            $buf = substr($buf, $pos + 1);
        }
    }
    if ($buf !== '') {
        yield $buf;
    }
  }

  /**
  * @param \Iterator<string> $lines
  *
  * @return \Generator<SSEvent>
 */
  public static function decodeSSE(\Iterator $lines): \Generator {
    $blank = ['event' => null, 'data' => null, 'id' => null, 'retry' => null];
    $acc = [];

    foreach ($lines as $line) {
        $line = rtrim($line);
        if ($line === '') {
            if (empty($acc)) {
                continue;
            }
            yield [...$blank, ...$acc];
            $acc = [];
        }

        if (str_starts_with($line, ':')) {
            continue;
        }

        $matches = [];
        if (preg_match('/^([^:]+):\s?(.*)$/', $line, $matches)) {
            [, $field, $value] = $matches;

            switch ($field) {
                case 'event':
                    $acc['event'] = $value;
                    break;
                case 'data':
                    if (isset($acc['data'])) {
                        $acc['data'] .= "\n" . $value;
                    } else {
                        $acc['data'] = $value;
                    }
                    break;
                case 'id':
                    $acc['id'] = $value;
                    break;
                case 'retry':
                    $acc['retry'] = (int) $value;
                    break;
            }
        }
    }

    if (!empty($acc)) {
        yield [...$blank, ...$acc];
    }
  }

  /**
  * @param string $json
  *
  * @return mixed
 */
  public static function decodeJson(string $json): mixed {
    return json_decode($json, associative: true, flags: JSON_THROW_ON_ERROR);
  }

  /**
  * @param ResponseInterface $rsp
  *
  * @return mixed
 */
  public static function decodeContent(ResponseInterface $rsp): mixed {
    if (204 == $rsp->getStatusCode()) {
        return null;
    }

    $content_type = $rsp->getHeaderLine('Content-Type');
    $body = $rsp->getBody();

    if (preg_match(static::JSON_CONTENT_TYPE, subject: $content_type)) {
        $json = $body->getContents();
        $decoded = static::decodeJson($json);
        return $decoded;
    }

    if (preg_match(static::JSONL_CONTENT_TYPE, subject: $content_type)) {
        $it = static::streamIterator($body);
        $lines = static::decodeLines($it);
        return (function() use ($lines) {
            foreach ($lines as $line) {
                yield static::decodeJson($line);
            }
        })();
    }

    if (str_contains($content_type, needle: 'text/event-stream')) {
        $it = static::streamIterator($body);
        $lines = static::decodeLines($it);
        return static::decodeSSE($lines);
    }

    return self::streamIterator($body);
  }

  /**
  * @param mixed $obj
  *
  * @return string
 */
  public static function prettyEncodeJson(mixed $obj): string {
    return json_encode($obj, flags: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?: '';
  }
}