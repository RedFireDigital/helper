<?php

namespace RedFireDigital\Helper\Service\AWS\Model;

use RedFireDigital\Helper\Service\AWS\Service\AWSConfig;

class UploadedS3
{
    private string $publicUrl;
    private string $awsS3Path;
    private string $fileName;
    private AWSConfig $awsConfig;

    private string $awsBucketKey;

    /**
     * @return string
     */
    public function getPublicUrl(): string
    {
        return $this->publicUrl;
    }

    /**
     * @param string $publicUrl
     */
    public function setPublicUrl(string $publicUrl): void
    {
        $this->publicUrl = $publicUrl;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * @return AWSConfig
     */
    public function getAwsConfig(): AWSConfig
    {
        return $this->awsConfig;
    }

    /**
     * @param AWSConfig $awsConfig
     */
    public function setAwsConfig(AWSConfig $awsConfig): void
    {
        $this->awsConfig = $awsConfig;
    }

    /**
     * @return string
     */
    public function getAwsS3Path(): string
    {
        return $this->awsS3Path;
    }

    /**
     * @param string $awsS3Path
     */
    public function setAwsS3Path(string $awsS3Path): void
    {
        $this->awsS3Path = $awsS3Path;
    }

    /**
     * @return string
     */
    public function getAwsBucketKey(): string
    {
        return $this->awsBucketKey;
    }

    /**
     * @param string $awsBucketKey
     */
    public function setAwsBucketKey(string $awsBucketKey): void
    {
        $this->awsBucketKey = $awsBucketKey;
    }




}