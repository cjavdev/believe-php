<?php

declare(strict_types=1);

namespace Believe\Teams;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
 * Geographic coordinates for a location.
 *
 * @phpstan-type GeoLocationShape = array{latitude: float, longitude: float}
 */
final class GeoLocation implements BaseModel
{
    /** @use SdkModel<GeoLocationShape> */
    use SdkModel;

    /**
     * Latitude in degrees.
     */
    #[Required]
    public float $latitude;

    /**
     * Longitude in degrees.
     */
    #[Required]
    public float $longitude;

    /**
     * `new GeoLocation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GeoLocation::with(latitude: ..., longitude: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GeoLocation)->withLatitude(...)->withLongitude(...)
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
     */
    public static function with(float $latitude, float $longitude): self
    {
        $self = new self;

        $self['latitude'] = $latitude;
        $self['longitude'] = $longitude;

        return $self;
    }

    /**
     * Latitude in degrees.
     */
    public function withLatitude(float $latitude): self
    {
        $self = clone $this;
        $self['latitude'] = $latitude;

        return $self;
    }

    /**
     * Longitude in degrees.
     */
    public function withLongitude(float $longitude): self
    {
        $self = clone $this;
        $self['longitude'] = $longitude;

        return $self;
    }
}
