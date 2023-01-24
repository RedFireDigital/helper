<?php
/**
 * Created by Graham Owens (gra@redfiredigital.uk)
 * Company: RedFire Digital Ltd (www.redfiredigital.uk)
 * Console: Snowdon
 *
 * User:    gra
 * Date:    16/January/2023
 * Time:    12:45
 * Project: iservo-admin
 * File:    s3Service.php
 * IDE:     PhpStorm
 *
 **/

namespace RedFireDigital\Helper\Service\AWS\Service;

use App\Service\AWS\Model\UploadedS3;
use Aws\Result;
use Aws\S3\S3Client;

class s3Service extends AWSBase
{
    CONST FILE_SEPERATOR = "-";
    private S3Client $s3Client;

    public function __construct(AWSConfig $awsConfig)
    {
        parent::__construct($awsConfig);
        $this->s3Client = $this->getS3Client();
        $this->s3Client->registerStreamWrapper();
    }

    public function getListOfBuckets() : Result
    {
        return $this->s3Client->listBuckets();
    }

    public function putObject(?string $bucketFolder = null, string $nameOfFile, string $fileContents) : UploadedS3
    {
        $fileName = $nameOfFile;
        $folder = is_null($bucketFolder) ? '' : '/' . $bucketFolder ;
        $uploadedFileName = $this->getRandomFileName($fileName);
        $uploadedPath = $this->awsConfig->getAppEnv() . $folder . "/";
        $s3Path = 's3://' . $this->awsConfig->getAwsBucketName() . '/' . $uploadedPath . $uploadedFileName;
        file_put_contents($s3Path, $fileContents);

        $uploadedS3 = new UploadedS3();
        $uploadedS3->setFileName($nameOfFile);
        $uploadedS3->setAwsS3Path($s3Path);
        $uploadedS3->setAwsConfig($this->getAWSConfig());
        $uploadedS3->setAwsBucketKey($uploadedPath . $uploadedFileName);
        $uploadedS3->setPublicUrl('https://' . $this->getAWSConfig()->getAwsBucketName() . '.s3.' . $this->getAWSConfig()->getAwsRegion() . '.amazonaws.com/' . $uploadedPath . $uploadedFileName);

        //https://iservo.s3.eu-west-2.amazonaws.com/dev/test/0zCf0OTH8k-carl.jpg

        return $uploadedS3;
    }

    private function getRandomFileName(string $fileName) : string
    {
        return $this->generateRandomString() . self::FILE_SEPERATOR . $fileName;
    }

    private function generateRandomString(int $length = 10) : string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function getS3Client()
    {
        return $this->getSDK()->createS3();
    }

}