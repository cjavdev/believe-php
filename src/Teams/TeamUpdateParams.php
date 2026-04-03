<?php

declare(strict_types=1);

namespace Believe\Teams;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Update specific fields of an existing team.
  * @see Believe\Services\TeamsService::update()
  * @phpstan-import-type AnnualBudgetGbpVariants from \Believe\Teams\TeamUpdateParams\AnnualBudgetGbp
  * @phpstan-import-type AnnualBudgetGbpShape from \Believe\Teams\TeamUpdateParams\AnnualBudgetGbp
  * @phpstan-import-type GeoLocationShape from \Believe\Teams\GeoLocation
  * @phpstan-import-type TeamValuesShape from \Believe\Teams\TeamValues
  * @phpstan-type TeamUpdateParamsShape = array{
  *   annualBudgetGbp?: AnnualBudgetGbpShape|null,
  *   averageAttendance?: float|null,
  *   contactEmail?: string|null,
  *   cultureScore?: int|null,
  *   foundedYear?: int|null,
  *   isActive?: bool|null,
  *   league?: null|League|value-of<League>,
  *   name?: string|null,
  *   nickname?: string|null,
  *   primaryColor?: string|null,
  *   rivalTeams?: list<string>|null,
  *   secondaryColor?: string|null,
  *   stadium?: string|null,
  *   stadiumLocation?: null|GeoLocation|GeoLocationShape,
  *   values?: null|TeamValues|TeamValuesShape,
  *   website?: string|null,
  *   winPercentage?: float|null,
  * }
  *
 */
final class TeamUpdateParams implements BaseModel
{
  /** @use SdkModel<TeamUpdateParamsShape> */
  use SdkModel;
  use SdkParams;

  /** @var AnnualBudgetGbpVariants|null $annualBudgetGbp */
  #[Optional('annual_budget_gbp', nullable: true)]
  public float|string|null $annualBudgetGbp;

  /** @var float|null $averageAttendance */
  #[Optional('average_attendance', nullable: true)]
  public ?float $averageAttendance;

  /** @var string|null $contactEmail */
  #[Optional('contact_email', nullable: true)]
  public ?string $contactEmail;

  /** @var int|null $cultureScore */
  #[Optional('culture_score', nullable: true)]
  public ?int $cultureScore;

  /** @var int|null $foundedYear */
  #[Optional('founded_year', nullable: true)]
  public ?int $foundedYear;

  /** @var bool|null $isActive */
  #[Optional('is_active', nullable: true)]
  public ?bool $isActive;

  /**
  * Football leagues.
  *
  * @var value-of<League>|null $league
 */
  #[Optional(enum: League::class, nullable: true)]
  public ?string $league;

  /** @var string|null $name */
  #[Optional(nullable: true)]
  public ?string $name;

  /** @var string|null $nickname */
  #[Optional(nullable: true)]
  public ?string $nickname;

  /** @var string|null $primaryColor */
  #[Optional('primary_color', nullable: true)]
  public ?string $primaryColor;

  /** @var list<string>|null $rivalTeams */
  #[Optional('rival_teams', list: 'string', nullable: true)]
  public ?array $rivalTeams;

  /** @var string|null $secondaryColor */
  #[Optional('secondary_color', nullable: true)]
  public ?string $secondaryColor;

  /** @var string|null $stadium */
  #[Optional(nullable: true)]
  public ?string $stadium;

  /**
  * Geographic coordinates for a location.
  *
  * @var GeoLocation|null $stadiumLocation
 */
  #[Optional('stadium_location', nullable: true)]
  public ?GeoLocation $stadiumLocation;

  /**
  * Core values that define a team's culture.
  *
  * @var TeamValues|null $values
 */
  #[Optional(nullable: true)]
  public ?TeamValues $values;

  /** @var string|null $website */
  #[Optional(nullable: true)]
  public ?string $website;

  /** @var float|null $winPercentage */
  #[Optional('win_percentage', nullable: true)]
  public ?float $winPercentage;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param AnnualBudgetGbpShape|null $annualBudgetGbp
  * @param float|null $averageAttendance
  * @param string|null $contactEmail
  * @param int|null $cultureScore
  * @param int|null $foundedYear
  * @param bool|null $isActive
  * @param null|League|value-of<League> $league
  * @param string|null $name
  * @param string|null $nickname
  * @param string|null $primaryColor
  * @param list<string>|null $rivalTeams
  * @param string|null $secondaryColor
  * @param string|null $stadium
  * @param null|GeoLocation|GeoLocationShape $stadiumLocation
  * @param null|TeamValues|TeamValuesShape $values
  * @param string|null $website
  * @param float|null $winPercentage
  *
  * @return self
 */
  public static function with(
    float|string|null $annualBudgetGbp = null,
    ?float $averageAttendance = null,
    ?string $contactEmail = null,
    ?int $cultureScore = null,
    ?int $foundedYear = null,
    ?bool $isActive = null,
    null|League|string $league = null,
    ?string $name = null,
    ?string $nickname = null,
    ?string $primaryColor = null,
    ?array $rivalTeams = null,
    ?string $secondaryColor = null,
    ?string $stadium = null,
    null|GeoLocation|array $stadiumLocation = null,
    null|TeamValues|array $values = null,
    ?string $website = null,
    ?float $winPercentage = null,
  ): self {
    $self = new self;

    null !== $annualBudgetGbp && $self['annualBudgetGbp'] = $annualBudgetGbp;
    null !== $averageAttendance && $self['averageAttendance'] = $averageAttendance;
    null !== $contactEmail && $self['contactEmail'] = $contactEmail;
    null !== $cultureScore && $self['cultureScore'] = $cultureScore;
    null !== $foundedYear && $self['foundedYear'] = $foundedYear;
    null !== $isActive && $self['isActive'] = $isActive;
    null !== $league && $self['league'] = $league;
    null !== $name && $self['name'] = $name;
    null !== $nickname && $self['nickname'] = $nickname;
    null !== $primaryColor && $self['primaryColor'] = $primaryColor;
    null !== $rivalTeams && $self['rivalTeams'] = $rivalTeams;
    null !== $secondaryColor && $self['secondaryColor'] = $secondaryColor;
    null !== $stadium && $self['stadium'] = $stadium;
    null !== $stadiumLocation && $self['stadiumLocation'] = $stadiumLocation;
    null !== $values && $self['values'] = $values;
    null !== $website && $self['website'] = $website;
    null !== $winPercentage && $self['winPercentage'] = $winPercentage;

    return $self;
  }

  /**
  * @param AnnualBudgetGbpShape|null $annualBudgetGbp
  *
  * @return self
 */
  public function withAnnualBudgetGbp(
    float|string|null $annualBudgetGbp
  ): self {
    $self = clone $this;
    $self['annualBudgetGbp'] = $annualBudgetGbp;
    return $self;
  }

  /**
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
  * @param int|null $cultureScore
  *
  * @return self
 */
  public function withCultureScore(?int $cultureScore): self {
    $self = clone $this;
    $self['cultureScore'] = $cultureScore;
    return $self;
  }

  /**
  * @param int|null $foundedYear
  *
  * @return self
 */
  public function withFoundedYear(?int $foundedYear): self {
    $self = clone $this;
    $self['foundedYear'] = $foundedYear;
    return $self;
  }

  /**
  * @param bool|null $isActive
  *
  * @return self
 */
  public function withIsActive(?bool $isActive): self {
    $self = clone $this;
    $self['isActive'] = $isActive;
    return $self;
  }

  /**
  * Football leagues.
  *
  * @param null|League|value-of<League> $league
  *
  * @return self
 */
  public function withLeague(null|League|string $league): self {
    $self = clone $this;
    $self['league'] = $league;
    return $self;
  }

  /**
  * @param string|null $name
  *
  * @return self
 */
  public function withName(?string $name): self {
    $self = clone $this;
    $self['name'] = $name;
    return $self;
  }

  /**
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
  * @param list<string>|null $rivalTeams
  *
  * @return self
 */
  public function withRivalTeams(?array $rivalTeams): self {
    $self = clone $this;
    $self['rivalTeams'] = $rivalTeams;
    return $self;
  }

  /**
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
  * @param string|null $stadium
  *
  * @return self
 */
  public function withStadium(?string $stadium): self {
    $self = clone $this;
    $self['stadium'] = $stadium;
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
  * Core values that define a team's culture.
  *
  * @param null|TeamValues|TeamValuesShape $values
  *
  * @return self
 */
  public function withValues(null|TeamValues|array $values): self {
    $self = clone $this;
    $self['values'] = $values;
    return $self;
  }

  /**
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