<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload\Data\MemberType;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload\Data\TransferType;

/**
 * Event data.
 *
 * @phpstan-type DataShape = array{
 *   characterID: string,
 *   characterName: string,
 *   memberType: MemberType|value-of<MemberType>,
 *   teamID: string,
 *   teamMemberID: string,
 *   teamName: string,
 *   tedReaction: string,
 *   transferType: TransferType|value-of<TransferType>,
 *   previousTeamID?: string|null,
 *   previousTeamName?: string|null,
 *   transferFeeGbp?: string|null,
 *   yearsWithPreviousTeam?: int|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * ID of the character (links to /characters).
     */
    #[Required('character_id')]
    public string $characterID;

    /**
     * Name of the character.
     */
    #[Required('character_name')]
    public string $characterName;

    /**
     * Type of team member.
     *
     * @var value-of<MemberType> $memberType
     */
    #[Required('member_type', enum: MemberType::class)]
    public string $memberType;

    /**
     * ID of the team involved.
     */
    #[Required('team_id')]
    public string $teamID;

    /**
     * ID of the team member.
     */
    #[Required('team_member_id')]
    public string $teamMemberID;

    /**
     * Name of the team involved.
     */
    #[Required('team_name')]
    public string $teamName;

    /**
     * Ted's reaction to the transfer.
     */
    #[Required('ted_reaction')]
    public string $tedReaction;

    /**
     * Whether the member joined or departed.
     *
     * @var value-of<TransferType> $transferType
     */
    #[Required('transfer_type', enum: TransferType::class)]
    public string $transferType;

    /**
     * Previous team ID (for joins from another team).
     */
    #[Optional('previous_team_id', nullable: true)]
    public ?string $previousTeamID;

    /**
     * Previous team name (for joins from another team).
     */
    #[Optional('previous_team_name', nullable: true)]
    public ?string $previousTeamName;

    /**
     * Transfer fee in GBP (for players).
     */
    #[Optional('transfer_fee_gbp', nullable: true)]
    public ?string $transferFeeGbp;

    /**
     * Years spent with previous team.
     */
    #[Optional('years_with_previous_team', nullable: true)]
    public ?int $yearsWithPreviousTeam;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   characterID: ...,
     *   characterName: ...,
     *   memberType: ...,
     *   teamID: ...,
     *   teamMemberID: ...,
     *   teamName: ...,
     *   tedReaction: ...,
     *   transferType: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withCharacterID(...)
     *   ->withCharacterName(...)
     *   ->withMemberType(...)
     *   ->withTeamID(...)
     *   ->withTeamMemberID(...)
     *   ->withTeamName(...)
     *   ->withTedReaction(...)
     *   ->withTransferType(...)
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
     * @param MemberType|value-of<MemberType> $memberType
     * @param TransferType|value-of<TransferType> $transferType
     */
    public static function with(
        string $characterID,
        string $characterName,
        MemberType|string $memberType,
        string $teamID,
        string $teamMemberID,
        string $teamName,
        string $tedReaction,
        TransferType|string $transferType,
        ?string $previousTeamID = null,
        ?string $previousTeamName = null,
        ?string $transferFeeGbp = null,
        ?int $yearsWithPreviousTeam = null,
    ): self {
        $self = new self;

        $self['characterID'] = $characterID;
        $self['characterName'] = $characterName;
        $self['memberType'] = $memberType;
        $self['teamID'] = $teamID;
        $self['teamMemberID'] = $teamMemberID;
        $self['teamName'] = $teamName;
        $self['tedReaction'] = $tedReaction;
        $self['transferType'] = $transferType;

        null !== $previousTeamID && $self['previousTeamID'] = $previousTeamID;
        null !== $previousTeamName && $self['previousTeamName'] = $previousTeamName;
        null !== $transferFeeGbp && $self['transferFeeGbp'] = $transferFeeGbp;
        null !== $yearsWithPreviousTeam && $self['yearsWithPreviousTeam'] = $yearsWithPreviousTeam;

        return $self;
    }

    /**
     * ID of the character (links to /characters).
     */
    public function withCharacterID(string $characterID): self
    {
        $self = clone $this;
        $self['characterID'] = $characterID;

        return $self;
    }

    /**
     * Name of the character.
     */
    public function withCharacterName(string $characterName): self
    {
        $self = clone $this;
        $self['characterName'] = $characterName;

        return $self;
    }

    /**
     * Type of team member.
     *
     * @param MemberType|value-of<MemberType> $memberType
     */
    public function withMemberType(MemberType|string $memberType): self
    {
        $self = clone $this;
        $self['memberType'] = $memberType;

        return $self;
    }

    /**
     * ID of the team involved.
     */
    public function withTeamID(string $teamID): self
    {
        $self = clone $this;
        $self['teamID'] = $teamID;

        return $self;
    }

    /**
     * ID of the team member.
     */
    public function withTeamMemberID(string $teamMemberID): self
    {
        $self = clone $this;
        $self['teamMemberID'] = $teamMemberID;

        return $self;
    }

    /**
     * Name of the team involved.
     */
    public function withTeamName(string $teamName): self
    {
        $self = clone $this;
        $self['teamName'] = $teamName;

        return $self;
    }

    /**
     * Ted's reaction to the transfer.
     */
    public function withTedReaction(string $tedReaction): self
    {
        $self = clone $this;
        $self['tedReaction'] = $tedReaction;

        return $self;
    }

    /**
     * Whether the member joined or departed.
     *
     * @param TransferType|value-of<TransferType> $transferType
     */
    public function withTransferType(TransferType|string $transferType): self
    {
        $self = clone $this;
        $self['transferType'] = $transferType;

        return $self;
    }

    /**
     * Previous team ID (for joins from another team).
     */
    public function withPreviousTeamID(?string $previousTeamID): self
    {
        $self = clone $this;
        $self['previousTeamID'] = $previousTeamID;

        return $self;
    }

    /**
     * Previous team name (for joins from another team).
     */
    public function withPreviousTeamName(?string $previousTeamName): self
    {
        $self = clone $this;
        $self['previousTeamName'] = $previousTeamName;

        return $self;
    }

    /**
     * Transfer fee in GBP (for players).
     */
    public function withTransferFeeGbp(?string $transferFeeGbp): self
    {
        $self = clone $this;
        $self['transferFeeGbp'] = $transferFeeGbp;

        return $self;
    }

    /**
     * Years spent with previous team.
     */
    public function withYearsWithPreviousTeam(?int $yearsWithPreviousTeam): self
    {
        $self = clone $this;
        $self['yearsWithPreviousTeam'] = $yearsWithPreviousTeam;

        return $self;
    }
}
