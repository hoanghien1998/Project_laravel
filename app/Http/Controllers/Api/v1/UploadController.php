<?php

namespace App\Http\Controllers\Api\v1;

use Config;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Saritasa\LaravelControllers\Api\BaseApiController;
use Storage;

/**
 * Class UploadController Upload file to s3
 *
 * @package App\Http\Controllers\Api\v1
 */
class UploadController extends BaseApiController
{
    /**
     * Receive file's signed url from s3
     *
     * @param Request $request File
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $fileName = $request->fileName;

        $s3 = Storage::disk('s3');
        $client = $s3->getDriver()->getAdapter()->getClient();
        $expiry = "+10 minutes";

        $command = $client->getCommand('GetObject', [
            'Bucket' => Config::get('filesystems.disks.s3.bucket'),
            'Key'    => $fileName,
        ]);

        $request = $client->createPresignedRequest($command, $expiry);

        return response()->json(['uploadUrl' => (string) $request->getUri(), ], 200);
    }
}
