<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload;

use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload\Data\MemberType;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload\Data\TransferType;

/**
  * Event data
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
  *
 */
final class Data implements BaseModel
{
  /** @use SdkModel<DataShape> */
  use SdkModel;

  /**
  * ID of the character (links to /characters)
  *
  * @var string $characterID
 */
  #[Required('character_id')]
  public string $characterID;

  /**
  * Name of the character
  *
  * @var string $characterName
 */
  #[Required('character_name')]
  public string $characterName;

  /**
  * Type of team member
  *
  * @var value-of<MemberType> $memberType
 */
  #[Required('member_type', enum: MemberType::class)]
  public string $memberType;

  /**
  * ID of the team involved
  *
  * @var string $teamID
 */
  #[Required('team_id')]
  public string $teamID;

  /**
  * ID of the team member
  *
  * @var string $teamMemberID
 */
  #[Required('team_member_id')]
  public string $teamMemberID;

  /**
  * Name of the team involved
  *
  * @var string $teamName
 */
  #[Required('team_name')]
  public string $teamName;

  /**
  * Ted's reaction to the transfer
  *
  * @var string $tedReaction
 */
  #[Required('ted_reaction')]
  public string $tedReaction;

  /**
  * Whether the member joined or departed
  *
  * @var value-of<TransferType> $transferType
 */
  #[Required('transfer_type', enum: TransferType::class)]
  public string $transferType;

  /**
  * Previous team ID (for joins from another team)
  *
  * @var string|null $previousTeamID
 */
  #[Optional('previous_team_id', nullable: true)]
  public ?string $previousTeamID;

  /**
  * Previous team name (for joins from another team)
  *
  * @var string|null $previousTeamName
 */
  #[Optional('previous_team_name', nullable: true)]
  public ?string $previousTeamName;

  /**
  * Transfer fee in GBP (for players)
  *
  * @var string|null $transferFeeGbp
 */
  #[Optional('transfer_fee_gbp', nullable: true)]
  public ?string $transferFeeGbp;

  /**
  * Years spent with previous team
  *
  * @var int|null $yearsWithPreviousTeam
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
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $characterID
  * @param string $characterName
  * @param MemberType|value-of<MemberType> $memberType
  * @param string $teamID
  * @param string $teamMemberID
  * @param string $teamName
  * @param string $tedReaction
  * @param TransferType|value-of<TransferType> $transferType
  * @param string|null $previousTeamID
  * @param string|null $previousTeamName
  * @param string|null $transferFeeGbp
  * @param int|null $yearsWithPreviousTeam
  *
  * @return self
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
  * ID of the character (links to /characters)
  *
  * @param string $characterID
  *
  * @return self
 */
  public function withCharacterID(string $characterID): self {
    $self = clone $this;
    $self['characterID'] = $characterID;
    return $self;
  }

  /**
  * Name of the character
  *
  * @param string $characterName
  *
  * @return self
 */
  public function withCharacterName(string $characterName): self {
    $self = clone $this;
    $self['characterName'] = $characterName;
    return $self;
  }

  /**
  * Type of team member
  *
  * @param MemberType|value-of<MemberType> $memberType
  *
  * @return self
 */
  public function withMemberType(MemberType|string $memberType): self {
    $self = clone $this;
    $self['memberType'] = $memberType;
    return $self;
  }

  /**
  * ID of the team involved
  *
  * @param string $teamID
  *
  * @return self
 */
  public function withTeamID(string $teamID): self {
    $self = clone $this;
    $self['teamID'] = $teamID;
    return $self;
  }

  /**
  * ID of the team member
  *
  * @param string $teamMemberID
  *
  * @return self
 */
  public function withTeamMemberID(string $teamMemberID): self {
    $self = clone $this;
    $self['teamMemberID'] = $teamMemberID;
    return $self;
  }

  /**
  * Name of the team involved
  *
  * @param string $teamName
  *
  * @return self
 */
  public function withTeamName(string $teamName): self {
    $self = clone $this;
    $self['teamName'] = $teamName;
    return $self;
  }

  /**
  * Ted's reaction to the transfer
  *
  * @param string $tedReaction
  *
  * @return self
 */
  public function withTedReaction(string $tedReaction): self {
    $self = clone $this;
    $self['tedReaction'] = $tedReaction;
    return $self;
  }

  /**
  * Whether the member joined or departed
  *
  * @param TransferType|value-of<TransferType> $transferType
  *
  * @return self
 */
  public function withTransferType(TransferType|string $transferType): self {
    $self = clone $this;
    $self['transferType'] = $transferType;
    return $self;
  }

  /**
  * Previous team ID (for joins from another team)
  *
  * @param string|null $previousTeamID
  *
  * @return self
 */
  public function withPreviousTeamID(?string $previousTeamID): self {
    $self = clone $this;
    $self['previousTeamID'] = $previousTeamID;
    return $self;
  }

  /**
  * Previous team name (for joins from another team)
  *
  * @param string|null $previousTeamName
  *
  * @return self
 */
  public function withPreviousTeamName(?string $previousTeamName): self {
    $self = clone $this;
    $self['previousTeamName'] = $previousTeamName;
    return $self;
  }

  /**
  * Transfer fee in GBP (for players)
  *
  * @param string|null $transferFeeGbp
  *
  * @return self
 */
  public function withTransferFeeGbp(?string $transferFeeGbp): self {
    $self = clone $this;
    $self['transferFeeGbp'] = $transferFeeGbp;
    return $self;
  }

  /**
  * Years spent with previous team
  *
  * @param int|null $yearsWithPreviousTeam
  *
  * @return self
 */
  public function withYearsWithPreviousTeam(?int $yearsWithPreviousTeam): self {
    $self = clone $this;
    $self['yearsWithPreviousTeam'] = $yearsWithPreviousTeam;
    return $self;
  }
}