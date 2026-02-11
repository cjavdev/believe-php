<?php

declare(strict_types=1);

namespace Believe\Teams;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
 * Full team model with ID.
 *
 * @phpstan-import-type TeamValuesShape from \Believe\Teams\TeamValues
 * @phpstan-import-type GeoLocationShape from \Believe\Teams\GeoLocation
 *
 * @phpstan-type TeamShape = array{
 *   id: string,
 *   cultureScore: int,
 *   foundedYear: int,
 *   league: League|value-of<League>,
 *   name: string,
 *   stadium: string,
 *   values: TeamValues|TeamValuesShape,
 *   annualBudgetGbp?: string|null,
 *   averageAttendance?: float|null,
 *   contactEmail?: string|null,
 *   isActive?: bool|null,
 *   nickname?: string|null,
 *   primaryColor?: string|null,
 *   rivalTeams?: list<string>|null,
 *   secondaryColor?: string|null,
 *   stadiumLocation?: null|GeoLocation|GeoLocationShape,
 *   website?: string|null,
 *   winPercentage?: float|null,
 * }
 */
final class Team implements BaseModel
{
    /** @use SdkModel<TeamShape> */
    use SdkModel;

    /**
     * Unique identifier.
     */
    #[Required]
    public string $id;

    /**
     * Team culture/morale score (0-100).
     */
    #[Required('culture_score')]
    public int $cultureScore;

    /**
     * Year the club was founded.
     */
    #[Required('founded_year')]
    public int $foundedYear;

    /**
     * Current league.
     *
     * @var value-of<League> $league
     */
    #[Required(enum: League::class)]
    public string $league;

    /**
     * Team name.
     */
    #[Required]
    public string $name;

    /**
     * Home stadium name.
     */
    #[Required]
    public string $stadium;

    /**
     * Team's core values.
     */
    #[Required]
    public TeamValues $values;

    /**
     * Annual budget in GBP.
     */
    #[Optional('annual_budget_gbp', nullable: true)]
    public ?string $annualBudgetGbp;

    /**
     * Average match attendance.
     */
    #[Optional('average_attendance', nullable: true)]
    public ?float $averageAttendance;

    /**
     * Team contact email.
     */
    #[Optional('contact_email', nullable: true)]
    public ?string $contactEmail;

    /**
     * Whether the team is currently active.
     */
    #[Optional('is_active')]
    public ?bool $isActive;

    /**
     * Team nickname.
     */
    #[Optional(nullable: true)]
    public ?string $nickname;

    /**
     * Primary team color (hex).
     */
    #[Optional('primary_color', nullable: true)]
    public ?string $primaryColor;

    /**
     * List of rival team IDs.
     *
     * @var list<string>|null $rivalTeams
     */
    #[Optional('rival_teams', list: 'string')]
    public ?array $rivalTeams;

    /**
     * Secondary team color (hex).
     */
    #[Optional('secondary_color', nullable: true)]
    public ?string $secondaryColor;

    /**
     * Geographic coordinates for a location.
     */
    #[Optional('stadium_location', nullable: true)]
    public ?GeoLocation $stadiumLocation;

    /**
     * Official team website.
     */
    #[Optional(nullable: true)]
    public ?string $website;

    /**
     * Season win percentage.
     */
    #[Optional('win_percentage', nullable: true)]
    public ?float $winPercentage;

    /**
     * `new Team()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Team::with(
     *   id: ...,
     *   cultureScore: ...,
     *   foundedYear: ...,
     *   league: ...,
     *   name: ...,
     *   stadium: ...,
     *   values: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Team)
     *   ->withID(...)
     *   ->withCultureScore(...)
     *   ->withFoundedYear(...)
     *   ->withLeague(...)
     *   ->withName(...)
     *   ->withStadium(...)
     *   ->withValues(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param League|value-of<League> $league
     * @param TeamValues|TeamValuesShape $values
     * @param list<string>|null $rivalTeams
     * @param GeoLocation|GeoLocationShape|null $stadiumLocation
     */
    public static function with(
        string $id,
        int $cultureScore,
        int $foundedYear,
        League|string $league,
        string $name,
        string $stadium,
        TeamValues|array $values,
        ?string $annualBudgetGbp = null,
        ?float $averageAttendance = null,
        ?string $contactEmail = null,
        ?bool $isActive = null,
        ?string $nickname = null,
        ?string $primaryColor = null,
        ?array $rivalTeams = null,
        ?string $secondaryColor = null,
        GeoLocation|array|null $stadiumLocation = null,
        ?string $website = null,
        ?float $winPercentage = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['cultureScore'] = $cultureScore;
        $self['foundedYear'] = $foundedYear;
        $self['league'] = $league;
        $self['name'] = $name;
        $self['stadium'] = $stadium;
        $self['values'] = $values;

        null !== $annualBudgetGbp && $self['annualBudgetGbp'] = $annualBudgetGbp;
        null !== $averageAttendance && $self['averageAttendance'] = $averageAttendance;
        null !== $contactEmail && $self['contactEmail'] = $contactEmail;
        null !== $isActive && $self['isActive'] = $isActive;
        null !== $nickname && $self['nickname'] = $nickname;
        null !== $primaryColor && $self['primaryColor'] = $primaryColor;
        null !== $rivalTeams && $self['rivalTeams'] = $rivalTeams;
        null !== $secondaryColor && $self['secondaryColor'] = $secondaryColor;
        null !== $stadiumLocation && $self['stadiumLocation'] = $stadiumLocation;
        null !== $website && $self['website'] = $website;
        null !== $winPercentage && $self['winPercentage'] = $winPercentage;

        return $self;
    }

    /**
     * Unique identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Team culture/morale score (0-100).
     */
    public function withCultureScore(int $cultureScore): self
    {
        $self = clone $this;
        $self['cultureScore'] = $cultureScore;

        return $self;
    }

    /**
     * Year the club was founded.
     */
    public function withFoundedYear(int $foundedYear): self
    {
        $self = clone $this;
        $self['foundedYear'] = $foundedYear;

        return $self;
    }

    /**
     * Current league.
     *
     * @param League|value-of<League> $league
     */
    public function withLeague(League|string $league): self
    {
        $self = clone $this;
        $self['league'] = $league;

        return $self;
    }

    /**
     * Team name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Home stadium name.
     */
    public function withStadium(string $stadium): self
    {
        $self = clone $this;
        $self['stadium'] = $stadium;

        return $self;
    }

    /**
     * Team's core values.
     *
     * @param TeamValues|TeamValuesShape $values
     */
    public function withValues(TeamValues|array $values): self
    {
        $self = clone $this;
        $self['values'] = $values;

        return $self;
    }

    /**
     * Annual budget in GBP.
     */
    public function withAnnualBudgetGbp(?string $annualBudgetGbp): self
    {
        $self = clone $this;
        $self['annualBudgetGbp'] = $annualBudgetGbp;

        return $self;
    }

    /**
     * Average match attendance.
     */
    public function withAverageAttendance(?float $averageAttendance): self
    {
        $self = clone $this;
        $self['averageAttendance'] = $averageAttendance;

        return $self;
    }

    /**
     * Team contact email.
     */
    public function withContactEmail(?string $contactEmail): self
    {
        $self = clone $this;
        $self['contactEmail'] = $contactEmail;

        return $self;
    }

    /**
     * Whether the team is currently active.
     */
    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    /**
     * Team nickname.
     */
    public function withNickname(?string $nickname): self
    {
        $self = clone $this;
        $self['nickname'] = $nickname;

        return $self;
    }

    /**
     * Primary team color (hex).
     */
    public function withPrimaryColor(?string $primaryColor): self
    {
        $self = clone $this;
        $self['primaryColor'] = $primaryColor;

        return $self;
    }

    /**
     * List of rival team IDs.
     *
     * @param list<string> $rivalTeams
     */
    public function withRivalTeams(array $rivalTeams): self
    {
        $self = clone $this;
        $self['rivalTeams'] = $rivalTeams;

        return $self;
    }

    /**
     * Secondary team color (hex).
     */
    public function withSecondaryColor(?string $secondaryColor): self
    {
        $self = clone $this;
        $self['secondaryColor'] = $secondaryColor;

        return $self;
    }

    /**
     * Geographic coordinates for a location.
     *
     * @param GeoLocation|GeoLocationShape|null $stadiumLocation
     */
    public function withStadiumLocation(
        GeoLocation|array|null $stadiumLocation
    ): self {
        $self = clone $this;
        $self['stadiumLocation'] = $stadiumLocation;

        return $self;
    }

    /**
     * Official team website.
     */
    public function withWebsite(?string $website): self
    {
        $self = clone $this;
        $self['website'] = $website;

        return $self;
    }

    /**
     * Season win percentage.
     */
    public function withWinPercentage(?float $winPercentage): self
    {
        $self = clone $this;
        $self['winPercentage'] = $winPercentage;

        return $self;
    }
}
