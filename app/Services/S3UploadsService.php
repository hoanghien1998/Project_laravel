<?php

namespace App\Services;

use App\Dto\UploadFileToS3Data;
use Carbon\Carbon;
use Exception;
use File;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Ramsey\Uuid\Uuid;

/**
 * Uploads service. Allows to perform read, store, delete files and retrieve url to file.
 */
class S3UploadsService
{
    /**
     * Filesystem abstraction.
     *
     * @var FilesystemAdapter
     */
    private $filesystem;

    /**
     * Uploads service. Allows to perform read, store, delete files and retrieve url to file.
     */
    public function __construct()
    {
        $this->filesystem = Storage::cloud();
    }

    /**
     * Get upload tmp file to S3.
     *
     * @param string $name file name
     *
     * @return UploadFileToS3Data
     *
     * @throws Exception
     */
    public function getUploadTmpFileToS3Data(string $name): UploadFileToS3Data
    {
        $file = $this->generateTmpFilePath($name);
        return $this->getUploadFileToS3Data($file);
    }

    /**
     * Return data for upload file to s3.
     *
     * @param string $filePath Name and path of uploaded file
     *
     * @throws Exception
     *
     * @return UploadFileToS3Data
     */
    public function getUploadFileToS3Data(string $filePath): UploadFileToS3Data
    {
        $expires = config('filesystems.disks.s3.expires');

        return new UploadFileToS3Data([
            UploadFileToS3Data::UPLOAD_URL => $this->getPreSignedURL($filePath, $expires),
            UploadFileToS3Data::VALID_UNTIL => Carbon::now()->addMinutes((int) $expires)->format(Carbon::ISO8601),
            UploadFileToS3Data::URL => $this->getUrl($filePath),
        ]);
    }

    /**
     * Generate file path for upload file to temporary directory.
     *
     * @param string $name file name
     *
     * @throws Exception
     *
     * @return string
     */
    private function generateTmpFilePath(string $name): string
    {
        return config('media.temp_path') . Uuid::uuid4()->toString() . '.' . File::extension($name);
    }

    /**
     * Get pre-signed url for upload file.
     *
     * @param string $filePath path to upload file
     * @param string $expire expired from config for upload url
     *
     * @return string
     */
    public function getPreSignedURL(string $filePath, string $expire): string
    {
        $adapter = $this->getAdapter();
        $client = $adapter->getClient();

        $command = $client->getCommand('PutObject', array_merge([
            'Bucket' => $adapter->getBucket(),
            'Key' => $adapter->getPathPrefix() . $filePath,
            'ACL'    => 'public-read',
        ]));

        return (string)$client->createPresignedRequest($command, $expire)->getUri();
    }

    /**
     * Return Aws S3 adapter.
     *
     * @return AwsS3Adapter
     */
    public function getAdapter(): AwsS3Adapter
    {
        return $this->filesystem->getDriver()->getAdapter();
    }

    /**
     * Returns public url to given file path.
     *
     * @param string $filePath File path to retrieve url
     *
     * @return string
     */
    public function getUrl(string $filePath): string
    {
        return $this->filesystem->url(ltrim($filePath, '/'));
    }
}
