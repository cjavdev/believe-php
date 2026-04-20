<?php

declare(strict_types=1);

namespace Believe\Characters;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Update specific fields of an existing character.
 *
 * @see Believe\Services\CharactersService::update()
 *
 * @phpstan-import-type SalaryGbpVariants from \Believe\Characters\CharacterUpdateParams\SalaryGbp
 * @phpstan-import-type EmotionalStatsShape from \Believe\Characters\EmotionalStats
 * @phpstan-import-type GrowthArcShape from \Believe\Characters\GrowthArc
 * @phpstan-import-type SalaryGbpShape from \Believe\Characters\CharacterUpdateParams\SalaryGbp
 *
 * @phpstan-type CharacterUpdateParamsShape = array{
 *   background?: string|null,
 *   dateOfBirth?: string|null,
 *   email?: string|null,
 *   emotionalStats?: null|EmotionalStats|EmotionalStatsShape,
 *   growthArcs?: list<GrowthArc|GrowthArcShape>|null,
 *   heightMeters?: float|null,
 *   name?: string|null,
 *   personalityTraits?: list<string>|null,
 *   profileImageURL?: string|null,
 *   role?: null|CharacterRole|value-of<CharacterRole>,
 *   salaryGbp?: SalaryGbpShape|null,
 *   signatureQuotes?: list<string>|null,
 *   teamID?: string|null,
 * }
 */
final class CharacterUpdateParams implements BaseModel
{
    /** @use SdkModel<CharacterUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional(nullable: true)]
    public ?string $background;

    #[Optional('date_of_birth', nullable: true)]
    public ?string $dateOfBirth;

    #[Optional(nullable: true)]
    public ?string $email;

    /**
     * Emotional intelligence statistics for a character.
     */
    #[Optional('emotional_stats', nullable: true)]
    public ?EmotionalStats $emotionalStats;

    /** @var list<GrowthArc>|null $growthArcs */
    #[Optional('growth_arcs', list: GrowthArc::class, nullable: true)]
    public ?array $growthArcs;

    #[Optional('height_meters', nullable: true)]
    public ?float $heightMeters;

    #[Optional(nullable: true)]
    public ?string $name;

    /** @var list<string>|null $personalityTraits */
    #[Optional('personality_traits', list: 'string', nullable: true)]
    public ?array $personalityTraits;

    #[Optional('profile_image_url', nullable: true)]
    public ?string $profileImageURL;

    /**
     * Roles characters can have.
     *
     * @var value-of<CharacterRole>|null $role
     */
    #[Optional(enum: CharacterRole::class, nullable: true)]
    public ?string $role;

    /** @var SalaryGbpVariants|null $salaryGbp */
    #[Optional('salary_gbp', nullable: true)]
    public float|string|null $salaryGbp;

    /** @var list<string>|null $signatureQuotes */
    #[Optional('signature_quotes', list: 'string', nullable: true)]
    public ?array $signatureQuotes;

    #[Optional('team_id', nullable: true)]
    public ?string $teamID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param EmotionalStats|EmotionalStatsShape|null $emotionalStats
     * @param list<GrowthArc|GrowthArcShape>|null $growthArcs
     * @param list<string>|null $personalityTraits
     * @param CharacterRole|value-of<CharacterRole>|null $role
     * @param SalaryGbpShape|null $salaryGbp
     * @param list<string>|null $signatureQuotes
     */
    public static function with(
        ?string $background = null,
        ?string $dateOfBirth = null,
        ?string $email = null,
        EmotionalStats|array|null $emotionalStats = null,
        ?array $growthArcs = null,
        ?float $heightMeters = null,
        ?string $name = null,
        ?array $personalityTraits = null,
        ?string $profileImageURL = null,
        CharacterRole|string|null $role = null,
        float|string|null $salaryGbp = null,
        ?array $signatureQuotes = null,
        ?string $teamID = null,
    ): self {
        $self = new self;

        null !== $background && $self['background'] = $background;
        null !== $dateOfBirth && $self['dateOfBirth'] = $dateOfBirth;
        null !== $email && $self['email'] = $email;
        null !== $emotionalStats && $self['emotionalStats'] = $emotionalStats;
        null !== $growthArcs && $self['growthArcs'] = $growthArcs;
        null !== $heightMeters && $self['heightMeters'] = $heightMeters;
        null !== $name && $self['name'] = $name;
        null !== $personalityTraits && $self['personalityTraits'] = $personalityTraits;
        null !== $profileImageURL && $self['profileImageURL'] = $profileImageURL;
        null !== $role && $self['role'] = $role;
        null !== $salaryGbp && $self['salaryGbp'] = $salaryGbp;
        null !== $signatureQuotes && $self['signatureQuotes'] = $signatureQuotes;
        null !== $teamID && $self['teamID'] = $teamID;

        return $self;
    }

    public function withBackground(?string $background): self
    {
        $self = clone $this;
        $self['background'] = $background;

        return $self;
    }

    public function withDateOfBirth(?string $dateOfBirth): self
    {
        $self = clone $this;
        $self['dateOfBirth'] = $dateOfBirth;

        return $self;
    }

    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Emotional intelligence statistics for a character.
     *
     * @param EmotionalStats|EmotionalStatsShape|null $emotionalStats
     */
    public function withEmotionalStats(
        EmotionalStats|array|null $emotionalStats
    ): self {
        $self = clone $this;
        $self['emotionalStats'] = $emotionalStats;

        return $self;
    }

    /**
     * @param list<GrowthArc|GrowthArcShape>|null $growthArcs
     */
    public function withGrowthArcs(?array $growthArcs): self
    {
        $self = clone $this;
        $self['growthArcs'] = $growthArcs;

        return $self;
    }

    public function withHeightMeters(?float $heightMeters): self
    {
        $self = clone $this;
        $self['heightMeters'] = $heightMeters;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param list<string>|null $personalityTraits
     */
    public function withPersonalityTraits(?array $personalityTraits): self
    {
        $self = clone $this;
        $self['personalityTraits'] = $personalityTraits;

        return $self;
    }

    public function withProfileImageURL(?string $profileImageURL): self
    {
        $self = clone $this;
        $self['profileImageURL'] = $profileImageURL;

        return $self;
    }

    /**
     * Roles characters can have.
     *
     * @param CharacterRole|value-of<CharacterRole>|null $role
     */
    public function withRole(CharacterRole|string|null $role): self
    {
        $self = clone $this;
        $self['role'] = $role;

        return $self;
    }

    /**
     * @param SalaryGbpShape|null $salaryGbp
     */
    public function withSalaryGbp(float|string|null $salaryGbp): self
    {
        $self = clone $this;
        $self['salaryGbp'] = $salaryGbp;

        return $self;
    }

    /**
     * @param list<string>|null $signatureQuotes
     */
    public function withSignatureQuotes(?array $signatureQuotes): self
    {
        $self = clone $this;
        $self['signatureQuotes'] = $signatureQuotes;

        return $self;
    }

    public function withTeamID(?string $teamID): self
    {
        $self = clone $this;
        $self['teamID'] = $teamID;

        return $self;
    }
}
