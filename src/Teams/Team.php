<?php

declare(strict_types=1);

namespace Believe\Teams;

use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Full team model with ID.
  * @phpstan-import-type TeamValuesShape from \Believe\Teams\TeamValues
  * @phpstan-import-type GeoLocationShape from \Believe\Teams\GeoLocation
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
  *
 */
final class Team implements BaseModel
{
  /** @use SdkModel<TeamShape> */
  use SdkModel;

  /**
  * Unique identifier
  *
  * @var string $id
 */
  #[Required]
  public string $id;

  /**
  * Team culture/morale score (0-100)
  *
  * @var int $cultureScore
 */
  #[Required('culture_score')]
  public int $cultureScore;

  /**
  * Year the club was founded
  *
  * @var int $foundedYear
 */
  #[Required('founded_year')]
  public int $foundedYear;

  /**
  * Current league
  *
  * @var value-of<League> $league
 */
  #[Required(enum: League::class)]
  public string $league;

  /**
  * Team name
  *
  * @var string $name
 */
  #[Required]
  public string $name;

  /**
  * Home stadium name
  *
  * @var string $stadium
 */
  #[Required]
  public string $stadium;

  /**
  * Team's core values
  *
  * @var TeamValues $values
 */
  #[Required]
  public TeamValues $values;

  /**
  * Annual budget in GBP
  *
  * @var string|null $annualBudgetGbp
 */
  #[Optional('annual_budget_gbp', nullable: true)]
  public ?string $annualBudgetGbp;

  /**
  * Average match attendance
  *
  * @var float|null $averageAttendance
 */
  #[Optional('average_attendance', nullable: true)]
  public ?float $averageAttendance;

  /**
  * Team contact email
  *
  * @var string|null $contactEmail
 */
  #[Optional('contact_email', nullable: true)]
  public ?string $contactEmail;

  /**
  * Whether the team is currently active
  *
  * @var bool|null $isActive
 */
  #[Optional('is_active')]
  public ?bool $isActive;

  /**
  * Team nickname
  *
  * @var string|null $nickname
 */
  #[Optional(nullable: true)]
  public ?string $nickname;

  /**
  * Primary team color (hex)
  *
  * @var string|null $primaryColor
 */
  #[Optional('primary_color', nullable: true)]
  public ?string $primaryColor;

  /**
  * List of rival team IDs
  *
  * @var list<string>|null $rivalTeams
 */
  #[Optional('rival_teams', list: 'string')]
  public ?array $rivalTeams;

  /**
  * Secondary team color (hex)
  *
  * @var string|null $secondaryColor
 */
  #[Optional('secondary_color', nullable: true)]
  public ?string $secondaryColor;

  /**
  * Geographic coordinates for a location.
  *
  * @var GeoLocation|null $stadiumLocation
 */
  #[Optional('stadium_location', nullable: true)]
  public ?GeoLocation $stadiumLocation;

  /**
  * Official team website
  *
  * @var string|null $website
 */
  #[Optional(nullable: true)]
  public ?string $website;

  /**
  * Season win percentage
  *
  * @var float|null $winPercentage
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
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $id
  * @param int $cultureScore
  * @param int $foundedYear
  * @param League|value-of<League> $league
  * @param string $name
  * @param string $stadium
  * @param TeamValues|TeamValuesShape $values
  * @param string|null $annualBudgetGbp
  * @param float|null $averageAttendance
  * @param string|null $contactEmail
  * @param bool|null $isActive
  * @param string|null $nickname
  * @param string|null $primaryColor
  * @param list<string>|null $rivalTeams
  * @param string|null $secondaryColor
  * @param null|GeoLocation|GeoLocationShape $stadiumLocation
  * @param string|null $website
  * @param float|null $winPercentage
  *
  * @return self
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
    bool $isActive = null,
    ?string $nickname = null,
    ?string $primaryColor = null,
    array $rivalTeams = null,
    ?string $secondaryColor = null,
    null|GeoLocation|array $stadiumLocation = null,
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
  * Unique identifier
  *
  * @param string $id
  *
  * @return self
 */
  public function withID(string $id): self {
    $self = clone $this;
    $self['id'] = $id;
    return $self;
  }

  /**
  * Team culture/morale score (0-100)
  *
  * @param int $cultureScore
  *
  * @return self
 */
  public function withCultureScore(int $cultureScore): self {
    $self = clone $this;
    $self['cultureScore'] = $cultureScore;
    return $self;
  }

  /**
  * Year the club was founded
  *
  * @param int $foundedYear
  *
  * @return self
 */
  public function withFoundedYear(int $foundedYear): self {
    $self = clone $this;
    $self['foundedYear'] = $foundedYear;
    return $self;
  }

  /**
  * Current league
  *
  * @param League|value-of<League> $league
  *
  * @return self
 */
  public function withLeague(League|string $league): self {
    $self = clone $this;
    $self['league'] = $league;
    return $self;
  }

  /**
  * Team name
  *
  * @param string $name
  *
  * @return self
 */
  public function withName(string $name): self {
    $self = clone $this;
    $self['name'] = $name;
    return $self;
  }

  /**
  * Home stadium name
  *
  * @param string $stadium
  *
  * @return self
 */
  public function withStadium(string $stadium): self {
    $self = clone $this;
    $self['stadium'] = $stadium;
    return $self;
  }

  /**
  * Team's core values
  *
  * @param TeamValues|TeamValuesShape $values
  *
  * @return self
 */
  public function withValues(TeamValues|array $values): self {
    $self = clone $this;
    $self['values'] = $values;
    return $self;
  }

  /**
  * Annual budget in GBP
  *
  * @param string|null $annualBudgetGbp
  *
  * @return self
 */
  public function withAnnualBudgetGbp(?string $annualBudgetGbp): self {
    $self = clone $this;
    $self['annualBudgetGbp'] = $annualBudgetGbp;
    return $self;
  }

  /**
  * Average match attendance
  *
  * @param float|null $averageAttendance
  *
  * @return self
 */
  public function withAverageAttendance(?float $averageAttendance): self {
    $self = clone $this;
    $self['averageAttendance'] = $averageAttendance;
    return $self;
  }

  /**
  * Team contact email
  *
  * @param string|null $contactEmail
  *
  * @return self
 */
  public function withContactEmail(?string $contactEmail): self {
    $self = clone $this;
    $self['contactEmail'] = $contactEmail;
    return $self;
  }

  /**
  * Whether the team is currently active
  *
  * @param bool $isActive
  *
  * @return self
 */
  public function withIsActive(bool $isActive): self {
    $self = clone $this;
    $self['isActive'] = $isActive;
    return $self;
  }

  /**
  * Team nickname
  *
  * @param string|null $nickname
  *
  * @return self
 */
  public function withNickname(?string $nickname): self {
    $self = clone $this;
    $self['nickname'] = $nickname;
    return $self;
  }

  /**
  * Primary team color (hex)
  *
  * @param string|null $primaryColor
  *
  * @return self
 */
  public function withPrimaryColor(?string $primaryColor): self {
    $self = clone $this;
    $self['primaryColor'] = $primaryColor;
    return $self;
  }

  /**
  * List of rival team IDs
  *
  * @param list<string> $rivalTeams
  *
  * @return self
 */
  public function withRivalTeams(array $rivalTeams): self {
    $self = clone $this;
    $self['rivalTeams'] = $rivalTeams;
    return $self;
  }

  /**
  * Secondary team color (hex)
  *
  * @param string|null $secondaryColor
  *
  * @return self
 */
  public function withSecondaryColor(?string $secondaryColor): self {
    $self = clone $this;
    $self['secondaryColor'] = $secondaryColor;
    return $self;
  }

  /**
  * Geographic coordinates for a location.
  *
  * @param null|GeoLocation|GeoLocationShape $stadiumLocation
  *
  * @return self
 */
  public function withStadiumLocation(
    null|GeoLocation|array $stadiumLocation
  ): self {
    $self = clone $this;
    $self['stadiumLocation'] = $stadiumLocation;
    return $self;
  }

  /**
  * Official team website
  *
  * @param string|null $website
  *
  * @return self
 */
  public function withWebsite(?string $website): self {
    $self = clone $this;
    $self['website'] = $website;
    return $self;
  }

  /**
  * Season win percentage
  *
  * @param float|null $winPercentage
  *
  * @return self
 */
  public function withWinPercentage(?float $winPercentage): self {
    $self = clone $this;
    $self['winPercentage'] = $winPercentage;
    return $self;
  }
}