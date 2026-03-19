<?php

declare(strict_types=1);

namespace Believe;

use Believe\Core\BaseClient;
use Believe\Core\Util;
use Believe\Services\BelieveService;
use Believe\Services\BiscuitsService;
use Believe\Services\CharactersService;
use Believe\Services\CoachingService;
use Believe\Services\ConflictsService;
use Believe\Services\EpisodesService;
use Believe\Services\MatchesService;
use Believe\Services\PepTalkService;
use Believe\Services\PressService;
use Believe\Services\QuotesService;
use Believe\Services\ReframeService;
use Believe\Services\StreamService;
use Believe\Services\TeamMembersService;
use Believe\Services\TeamsService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \Believe\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
class Client extends BaseClient
{
    public string $apiKey;

    /**
     * @api
     */
    public CharactersService $characters;

    /**
     * @api
     */
    public TeamsService $teams;

    /**
     * @api
     */
    public MatchesService $matches;

    /**
     * @api
     */
    public EpisodesService $episodes;

    /**
     * @api
     */
    public QuotesService $quotes;

    /**
     * @api
     */
    public BelieveService $believe;

    /**
     * @api
     */
    public ConflictsService $conflicts;

    /**
     * @api
     */
    public ReframeService $reframe;

    /**
     * @api
     */
    public PressService $press;

    /**
     * @api
     */
    public CoachingService $coaching;

    /**
     * @api
     */
    public BiscuitsService $biscuits;

    /**
     * @api
     */
    public PepTalkService $pepTalk;

    /**
     * @api
     */
    public StreamService $stream;

    /**
     * @api
     */
    public TeamMembersService $teamMembers;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $apiKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->apiKey = (string) ($apiKey ?? Util::getenv('BELIEVE_API_KEY'));

        $baseUrl ??= Util::getenv('BELIEVE_BASE_URL') ?: 'https://believe.cjav.dev';

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
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->apiKey ? ['Authorization' => "Bearer {$this->apiKey}"] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
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
        RequestOptions|array|null $opts,
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
}
