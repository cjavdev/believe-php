<?php

declare(strict_types=1);

namespace Believe\Teams\Logo;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
 * Response model for file uploads.
 *
 * @phpstan-type FileUploadShape = array{
 *   checksumSha256: string,
 *   contentType: string,
 *   fileID: string,
 *   filename: string,
 *   sizeBytes: int,
 *   uploadedAt: \DateTimeInterface,
 * }
 */
final class FileUpload implements BaseModel
{
    /** @use SdkModel<FileUploadShape> */
    use SdkModel;

    #[Required('checksum_sha256')]
    public string $checksumSha256;

    #[Required('content_type')]
    public string $contentType;

    #[Required('file_id')]
    public string $fileID;

    #[Required]
    public string $filename;

    #[Required('size_bytes')]
    public int $sizeBytes;

    #[Required('uploaded_at')]
    public \DateTimeInterface $uploadedAt;

    /**
     * `new FileUpload()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileUpload::with(
     *   checksumSha256: ...,
     *   contentType: ...,
     *   fileID: ...,
     *   filename: ...,
     *   sizeBytes: ...,
     *   uploadedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileUpload)
     *   ->withChecksumSha256(...)
     *   ->withContentType(...)
     *   ->withFileID(...)
     *   ->withFilename(...)
     *   ->withSizeBytes(...)
     *   ->withUploadedAt(...)
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
    public static function with(
        string $checksumSha256,
        string $contentType,
        string $fileID,
        string $filename,
        int $sizeBytes,
        \DateTimeInterface $uploadedAt,
    ): self {
        $self = new self;

        $self['checksumSha256'] = $checksumSha256;
        $self['contentType'] = $contentType;
        $self['fileID'] = $fileID;
        $self['filename'] = $filename;
        $self['sizeBytes'] = $sizeBytes;
        $self['uploadedAt'] = $uploadedAt;

        return $self;
    }

    public function withChecksumSha256(string $checksumSha256): self
    {
        $self = clone $this;
        $self['checksumSha256'] = $checksumSha256;

        return $self;
    }

    public function withContentType(string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    public function withUploadedAt(\DateTimeInterface $uploadedAt): self
    {
        $self = clone $this;
        $self['uploadedAt'] = $uploadedAt;

        return $self;
    }
}
