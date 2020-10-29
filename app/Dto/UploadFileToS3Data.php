<?php

namespace App\Dto;

/**
 * The model contains data for upload file on S3.
 */
class UploadFileToS3Data extends CaseInsensitiveDto
{
    public const UPLOAD_URL = 'upload_url';
    public const VALID_UNTIL = 'valid_until';
    public const URL = 'url';

    /**
     * PreSigned file upload url.
     *
     * @var string
     */
    public $upload_url;

    /**
     * Expired date for upload url.
     *
     * @var string
     */
    public $valid_until;

    /**
     * File url on S3.
     *
     * @var string
     */
    public $url;
}
