<?php

declare(strict_types=1);

namespace Believe\Characters;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Add a new character to the Ted Lasso universe.
 *
 * @see Believe\Services\CharactersService::create()
 *
 * @phpstan-import-type SalaryGbpVariants from \Believe\Characters\CharacterCreateParams\SalaryGbp
 * @phpstan-import-type EmotionalStatsShape from \Believe\Characters\EmotionalStats
 * @phpstan-import-type GrowthArcShape from \Believe\Characters\GrowthArc
 * @phpstan-import-type SalaryGbpShape from \Believe\Characters\CharacterCreateParams\SalaryGbp
 *
 * @phpstan-type CharacterCreateParamsShape = array{
 *   background: string,
 *   emotionalStats: EmotionalStats|EmotionalStatsShape,
 *   name: string,
 *   personalityTraits: list<string>,
 *   role: CharacterRole|value-of<CharacterRole>,
 *   dateOfBirth?: string|null,
 *   email?: string|null,
 *   growthArcs?: list<GrowthArc|GrowthArcShape>|null,
 *   heightMeters?: float|null,
 *   profileImageURL?: string|null,
 *   salaryGbp?: SalaryGbpShape|null,
 *   signatureQuotes?: list<string>|null,
 *   teamID?: string|null,
 * }
 */
final class CharacterCreateParams implements BaseModel
{
    /** @use SdkModel<CharacterCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Character background and history.
     */
    #[Required]
    public string $background;

    /**
     * Emotional intelligence stats.
     */
    #[Required('emotional_stats')]
    public EmotionalStats $emotionalStats;

    /**
     * Character's full name.
     */
    #[Required]
    public string $name;

    /**
     * Key personality traits.
     *
     * @var list<string> $personalityTraits
     */
    #[Required('personality_traits', list: 'string')]
    public array $personalityTraits;

    /**
     * Character's role.
     *
     * @var value-of<CharacterRole> $role
     */
    #[Required(enum: CharacterRole::class)]
    public string $role;

    /**
     * Character's date of birth.
     */
    #[Optional('date_of_birth', nullable: true)]
    public ?string $dateOfBirth;

    /**
     * Character's email address.
     */
    #[Optional(nullable: true)]
    public ?string $email;

    /**
     * Character development across seasons.
     *
     * @var list<GrowthArc>|null $growthArcs
     */
    #[Optional('growth_arcs', list: GrowthArc::class)]
    public ?array $growthArcs;

    /**
     * Height in meters.
     */
    #[Optional('height_meters', nullable: true)]
    public ?float $heightMeters;

    /**
     * URL to character's profile image.
     */
    #[Optional('profile_image_url', nullable: true)]
    public ?string $profileImageURL;

    /**
     * Annual salary in GBP.
     *
     * @var SalaryGbpVariants|null $salaryGbp
     */
    #[Optional('salary_gbp', nullable: true)]
    public float|string|null $salaryGbp;

    /**
     * Memorable quotes from this character.
     *
     * @var list<string>|null $signatureQuotes
     */
    #[Optional('signature_quotes', list: 'string')]
    public ?array $signatureQuotes;

    /**
     * ID of the team they belong to.
     */
    #[Optional('team_id', nullable: true)]
    public ?string $teamID;

    /**
     * `new CharacterCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CharacterCreateParams::with(
     *   background: ...,
     *   emotionalStats: ...,
     *   name: ...,
     *   personalityTraits: ...,
     *   role: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CharacterCreateParams)
     *   ->withBackground(...)
     *   ->withEmotionalStats(...)
     *   ->withName(...)
     *   ->withPersonalityTraits(...)
     *   ->withRole(...)
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
     * @param EmotionalStats|EmotionalStatsShape $emotionalStats
     * @param list<string> $personalityTraits
     * @param CharacterRole|value-of<CharacterRole> $role
     * @param list<GrowthArc|GrowthArcShape>|null $growthArcs
     * @param SalaryGbpShape|null $salaryGbp
     * @param list<string>|null $signatureQuotes
     */
    public static function with(
        string $background,
        EmotionalStats|array $emotionalStats,
        string $name,
        array $personalityTraits,
        CharacterRole|string $role,
        ?string $dateOfBirth = null,
        ?string $email = null,
        ?array $growthArcs = null,
        ?float $heightMeters = null,
        ?string $profileImageURL = null,
        float|string|null $salaryGbp = null,
        ?array $signatureQuotes = null,
        ?string $teamID = null,
    ): self {
        $self = new self;

        $self['background'] = $background;
        $self['emotionalStats'] = $emotionalStats;
        $self['name'] = $name;
        $self['personalityTraits'] = $personalityTraits;
        $self['role'] = $role;

        null !== $dateOfBirth && $self['dateOfBirth'] = $dateOfBirth;
        null !== $email && $self['email'] = $email;
        null !== $growthArcs && $self['growthArcs'] = $growthArcs;
        null !== $heightMeters && $self['heightMeters'] = $heightMeters;
        null !== $profileImageURL && $self['profileImageURL'] = $profileImageURL;
        null !== $salaryGbp && $self['salaryGbp'] = $salaryGbp;
        null !== $signatureQuotes && $self['signatureQuotes'] = $signatureQuotes;
        null !== $teamID && $self['teamID'] = $teamID;

        return $self;
    }

    /**
     * Character background and history.
     */
    public function withBackground(string $background): self
    {
        $self = clone $this;
        $self['background'] = $background;

        return $self;
    }

    /**
     * Emotional intelligence stats.
     *
     * @param EmotionalStats|EmotionalStatsShape $emotionalStats
     */
    public function withEmotionalStats(
        EmotionalStats|array $emotionalStats
    ): self {
        $self = clone $this;
        $self['emotionalStats'] = $emotionalStats;

        return $self;
    }

    /**
     * Character's full name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Key personality traits.
     *
     * @param list<string> $personalityTraits
     */
    public function withPersonalityTraits(array $personalityTraits): self
    {
        $self = clone $this;
        $self['personalityTraits'] = $personalityTraits;

        return $self;
    }

    /**
     * Character's role.
     *
     * @param CharacterRole|value-of<CharacterRole> $role
     */
    public function withRole(CharacterRole|string $role): self
    {
        $self = clone $this;
        $self['role'] = $role;

        return $self;
    }

    /**
     * Character's date of birth.
     */
    public function withDateOfBirth(?string $dateOfBirth): self
    {
        $self = clone $this;
        $self['dateOfBirth'] = $dateOfBirth;

        return $self;
    }

    /**
     * Character's email address.
     */
    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Character development across seasons.
     *
     * @param list<GrowthArc|GrowthArcShape> $growthArcs
     */
    public function withGrowthArcs(array $growthArcs): self
    {
        $self = clone $this;
        $self['growthArcs'] = $growthArcs;

        return $self;
    }

    /**
     * Height in meters.
     */
    public function withHeightMeters(?float $heightMeters): self
    {
        $self = clone $this;
        $self['heightMeters'] = $heightMeters;

        return $self;
    }

    /**
     * URL to character's profile image.
     */
    public function withProfileImageURL(?string $profileImageURL): self
    {
        $self = clone $this;
        $self['profileImageURL'] = $profileImageURL;

        return $self;
    }

    /**
     * Annual salary in GBP.
     *
     * @param SalaryGbpShape|null $salaryGbp
     */
    public function withSalaryGbp(float|string|null $salaryGbp): self
    {
        $self = clone $this;
        $self['salaryGbp'] = $salaryGbp;

        return $self;
    }

    /**
     * Memorable quotes from this character.
     *
     * @param list<string> $signatureQuotes
     */
    public function withSignatureQuotes(array $signatureQuotes): self
    {
        $self = clone $this;
        $self['signatureQuotes'] = $signatureQuotes;

        return $self;
    }

    /**
     * ID of the team they belong to.
     */
    public function withTeamID(?string $teamID): self
    {
        $self = clone $this;
        $self['teamID'] = $teamID;

        return $self;
    }
}
