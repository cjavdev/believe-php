<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Characters\EmotionalStats;
use Believe\Characters\CharacterRole;
use Believe\Characters\GrowthArc;
use Believe\Characters\Character;
use Believe\Core\Exceptions\APIException;

/**
  * @phpstan-import-type SalaryGbpShape from \Believe\Characters\CharacterCreateParams\SalaryGbp
  * @phpstan-import-type SalaryGbpShape from \Believe\Characters\CharacterUpdateParams\SalaryGbp as SalaryGbpShape1
  * @phpstan-import-type EmotionalStatsShape from \Believe\Characters\EmotionalStats
  * @phpstan-import-type GrowthArcShape from \Believe\Characters\GrowthArc
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface CharactersContract{

    /**
  * @api
  *
  * @param string $background Character background and history
  * @param EmotionalStats|EmotionalStatsShape $emotionalStats Emotional intelligence stats
  * @param string $name Character's full name
  * @param list<string> $personalityTraits Key personality traits
  * @param CharacterRole|value-of<CharacterRole> $role Character's role
  * @param string|null $dateOfBirth Character's date of birth
  * @param string|null $email Character's email address
  * @param list<GrowthArc|GrowthArcShape> $growthArcs Character development across seasons
  * @param float|null $heightMeters Height in meters
  * @param string|null $profileImageURL URL to character's profile image
  * @param SalaryGbpShape|null $salaryGbp Annual salary in GBP
  * @param list<string> $signatureQuotes Memorable quotes from this character
  * @param string|null $teamID ID of the team they belong to
  * @param RequestOpts|null $requestOptions
  *
  * @return Character
  *
  * @throws APIException
 */
    public function create(
      string $background,
      EmotionalStats|array $emotionalStats,
      string $name,
      array $personalityTraits,
      CharacterRole|string $role,
      ?string $dateOfBirth = null,
      ?string $email = null,
      array $growthArcs = null,
      ?float $heightMeters = null,
      ?string $profileImageURL = null,
      float|string|null $salaryGbp = null,
      array $signatureQuotes = null,
      ?string $teamID = null,
      null|RequestOptions|array $requestOptions = null,
    ): Character;

    /**
  * @api
  *
  * @param string $characterID
  * @param RequestOpts|null $requestOptions
  *
  * @return Character
  *
  * @throws APIException
 */
    public function retrieve(
      string $characterID, null|RequestOptions|array $requestOptions = null
    ): Character;

    /**
  * @api
  *
  * @param string $characterID
  * @param string|null $background
  * @param string|null $dateOfBirth
  * @param string|null $email
  * @param null|EmotionalStats|EmotionalStatsShape $emotionalStats Emotional intelligence statistics for a character.
  * @param list<GrowthArc|GrowthArcShape>|null $growthArcs
  * @param float|null $heightMeters
  * @param string|null $name
  * @param list<string>|null $personalityTraits
  * @param string|null $profileImageURL
  * @param null|CharacterRole|value-of<CharacterRole> $role Roles characters can have.
  * @param SalaryGbpShape1|null $salaryGbp
  * @param list<string>|null $signatureQuotes
  * @param string|null $teamID
  * @param RequestOpts|null $requestOptions
  *
  * @return Character
  *
  * @throws APIException
 */
    public function update(
      string $characterID,
      ?string $background = null,
      ?string $dateOfBirth = null,
      ?string $email = null,
      null|EmotionalStats|array $emotionalStats = null,
      ?array $growthArcs = null,
      ?float $heightMeters = null,
      ?string $name = null,
      ?array $personalityTraits = null,
      ?string $profileImageURL = null,
      null|CharacterRole|string $role = null,
      float|string|null $salaryGbp = null,
      ?array $signatureQuotes = null,
      ?string $teamID = null,
      null|RequestOptions|array $requestOptions = null,
    ): Character;

    /**
  * @api
  *
  * @param int $limit Maximum number of items to return (max: 100)
  * @param int|null $minOptimism Minimum optimism score
  * @param null|CharacterRole|value-of<CharacterRole> $role Filter by role
  * @param int $skip Number of items to skip (offset)
  * @param string|null $teamID Filter by team ID
  * @param RequestOpts|null $requestOptions
  *
  * @return SkipLimitPage<Character>
  *
  * @throws APIException
 */
    public function list(
      int $limit = 20,
      ?int $minOptimism = null,
      null|CharacterRole|string $role = null,
      int $skip = 0,
      ?string $teamID = null,
      null|RequestOptions|array $requestOptions = null,
    ): SkipLimitPage;

    /**
  * @api
  *
  * @param string $characterID
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
    public function delete(
      string $characterID, null|RequestOptions|array $requestOptions = null
    ): mixed;

    /**
  * @api
  *
  * @param string $characterID
  * @param RequestOpts|null $requestOptions
  *
  * @return list<string>
  *
  * @throws APIException
 */
    public function getQuotes(
      string $characterID, null|RequestOptions|array $requestOptions = null
    ): array;

}