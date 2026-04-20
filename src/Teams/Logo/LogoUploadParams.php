<?php

declare(strict_types=1);

namespace Believe\Teams\Logo;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;
use Believe\Core\FileParam;

/**
 * Upload a logo image for a team. Accepts image files (jpg, png, gif, webp).
 *
 * @see Believe\Services\Teams\LogoService::upload()
 *
 * @phpstan-type LogoUploadParamsShape = array{file: string|FileParam}
 */
final class LogoUploadParams implements BaseModel
{
    /** @use SdkModel<LogoUploadParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Logo image file.
     */
    #[Required]
    public string $file;

    /**
     * `new LogoUploadParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LogoUploadParams::with(file: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LogoUploadParams)->withFile(...)
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
    public static function with(string|FileParam $file): self
    {
        $self = new self;

        $self['file'] = $file;

        return $self;
    }

    /**
     * Logo image file.
     */
    public function withFile(string|FileParam $file): self
    {
        $self = clone $this;
        $self['file'] = $file;

        return $self;
    }
}
