<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\S3UploadsService;
use Dingo\Api\Http\Response;
use Exception;
use Illuminate\Http\Request;
use Saritasa\LaravelControllers\Api\BaseApiController;

/**
 * Class UploadController Upload file to s3
 *
 * @package App\Http\Controllers\Api\v1
 */
class UploadController extends BaseApiController
{
    /**
     * Manages uploads to S3
     *
     * @var S3UploadsService
     */
    private $uploadsService;

    /**
     * Controller for handling uploading file.
     *
     * @param S3UploadsService $uploadsService Manages uploads to S3
     */
    public function __construct(S3UploadsService $uploadsService)
    {
        parent::__construct();
        $this->uploadsService = $uploadsService;
    }

    /**
     * Receive file's signed url from s3
     *
     * @param Request $request File
     *
     * @return Response
     *
     * @throws Exception
     */
    public function tmpFileUploadUrl(Request $request): Response
    {
        return $this->json($this->uploadsService->getUploadTmpFileToS3Data($request->fileName));
    }
}
