<?php

declare(strict_types=1);

namespace Believe;

use Believe\Core\BaseClient;
use Believe\Core\Util;
use Believe\Core\Exceptions\APIException;
use Believe\Services\CharactersService;
use Believe\Services\TeamsService;
use Believe\Services\MatchesService;
use Believe\Services\EpisodesService;
use Believe\Services\QuotesService;
use Believe\Services\BelieveService;
use Believe\Services\ConflictsService;
use Believe\Services\ReframeService;
use Believe\Services\PressService;
use Believe\Services\CoachingService;
use Believe\Services\BiscuitsService;
use Believe\Services\PepTalkService;
use Believe\Services\StreamService;
use Believe\Services\TeamMembersService;
use Believe\Services\WebhooksService;
use Believe\Services\TicketSalesService;
use Believe\Services\HealthService;
use Believe\Services\VersionService;
use Believe\Services\ClientService;
use Believe\Services\BelieveClientRawService;
use Believe\Services\BelieveClientService;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;

/**
  * @phpstan-import-type NormalizedRequest from \Believe\Core\BaseClient
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
class Client extends BaseClient
{
  /** @var string $apiKey */
  public string $apiKey;

  /**
  * @api
  *
  * @var CharactersService $characters
 */
  public CharactersService $characters;

  /**
  * @api
  *
  * @var TeamsService $teams
 */
  public TeamsService $teams;

  /**
  * @api
  *
  * @var MatchesService $matches
 */
  public MatchesService $matches;

  /**
  * @api
  *
  * @var EpisodesService $episodes
 */
  public EpisodesService $episodes;

  /**
  * @api
  *
  * @var QuotesService $quotes
 */
  public QuotesService $quotes;

  /**
  * @api
  *
  * @var BelieveService $believe
 */
  public BelieveService $believe;

  /**
  * @api
  *
  * @var ConflictsService $conflicts
 */
  public ConflictsService $conflicts;

  /**
  * @api
  *
  * @var ReframeService $reframe
 */
  public ReframeService $reframe;

  /**
  * @api
  *
  * @var PressService $press
 */
  public PressService $press;

  /**
  * @api
  *
  * @var CoachingService $coaching
 */
  public CoachingService $coaching;

  /**
  * @api
  *
  * @var BiscuitsService $biscuits
 */
  public BiscuitsService $biscuits;

  /**
  * @api
  *
  * @var PepTalkService $pepTalk
 */
  public PepTalkService $pepTalk;

  /**
  * @api
  *
  * @var StreamService $stream
 */
  public StreamService $stream;

  /**
  * @api
  *
  * @var TeamMembersService $teamMembers
 */
  public TeamMembersService $teamMembers;

  /**
  * @api
  *
  * @var WebhooksService $webhooks
 */
  public WebhooksService $webhooks;

  /**
  * @api
  *
  * @var TicketSalesService $ticketSales
 */
  public TicketSalesService $ticketSales;

  /**
  * @api
  *
  * @var HealthService $health
 */
  public HealthService $health;

  /**
  * @api
  *
  * @var VersionService $version
 */
  public VersionService $version;

  /**
  * @api
  *
  * @var ClientService $client
 */
  public ClientService $client;

  /**
  * @api
  *
  * @var BelieveClientRawService $raw
 */
  public BelieveClientRawService $raw;

  /**
  * @api
  *
  * @var BelieveClientService $believeClientService
 */
  private BelieveClientService $believeClientService;

  /** @return array<string,string> */
  protected function authHeaders(): array {
    return $this->apiKey ? ['Authorization' => "Bearer {$this->apiKey}"] : [];
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
    return parent::buildRequest(
      method: $method,
      path: $path,
      query: $query,
      headers: [...$this->authHeaders(), ...$headers],
      body: $body,
      opts: $opts,
    );
  }

  /**
  * @param string|null $apiKey
  * @param string|null $baseUrl
  * @param RequestOpts|null $requestOptions
 */
  function __construct(
    ?string $apiKey = NULL,
    ?string $baseUrl = NULL,
    null|RequestOptions|array $requestOptions = NULL,
  ) {
    $this->apiKey = (string)($apiKey ?? Util::getenv('BELIEVE_API_KEY'));

    $baseUrl ??= Util::getenv('BELIEVE_BASE_URL') ?: "https://believe.cjav.dev";

    $options = RequestOptions::parse(
        RequestOptions::with(
            uriFactory: Psr17FactoryDiscovery::findUriFactory(),
            streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
            requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
            transporter: Psr18ClientDiscovery::find(),
        ),
        $requestOptions,
    );

    parent::__construct(
      headers: [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
        'User-Agent' => sprintf('believe/PHP %s', VERSION),
        'X-Stainless-Lang' => 'php',
        'X-Stainless-Package-Version' => '0.0.1',
        'X-Stainless-Arch' => Util::machtype(),
        'X-Stainless-OS' => Util::ostype(),
        'X-Stainless-Runtime' => php_sapi_name(),
        'X-Stainless-Runtime-Version' => phpversion(),
      ],
      baseUrl: $baseUrl,
      options: $options
    );

    $this->characters = new CharactersService($this);
    $this->teams = new TeamsService($this);
    $this->matches = new MatchesService($this);
    $this->episodes = new EpisodesService($this);
    $this->quotes = new QuotesService($this);
    $this->believe = new BelieveService($this);
    $this->conflicts = new ConflictsService($this);
    $this->reframe = new ReframeService($this);
    $this->press = new PressService($this);
    $this->coaching = new CoachingService($this);
    $this->biscuits = new BiscuitsService($this);
    $this->pepTalk = new PepTalkService($this);
    $this->stream = new StreamService($this);
    $this->teamMembers = new TeamMembersService($this);
    $this->webhooks = new WebhooksService($this);
    $this->ticketSales = new TicketSalesService($this);
    $this->health = new HealthService($this);
    $this->version = new VersionService($this);
    $this->client = new ClientService($this);
    $this->raw = new BelieveClientRawService($this);
    $this->believeClientService = new BelieveClientService($this);
  }

  /**
  * @api
  *
  * Get a warm welcome and overview of available endpoints.
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
  public function getWelcome(
    null|RequestOptions|array $requestOptions = null
  ): mixed {
    return $this->believeClientService->getWelcome($requestOptions);
  }
}