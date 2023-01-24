<?php
/**
 * Created by Graham Owens (gra@redfiredigital.uk)
 * Company: RedFire Digital Ltd (www.redfiredigital.uk)
 * Console: Snowdon
 *
 * User:    gra
 * Date:    16/January/2023
 * Time:    13:22
 * Project: iservo-admin
 * File:    AWSConfig.php
 * IDE:     PhpStorm
 *
 **/

namespace RedFireDigital\Helper\Service\AWS\Service;

class AWSConfig
{
    public function __construct(
        private string $awsRegion,
        private string $awsVersion,
        private string $awsAccessKeyId,
        private string $awsSecreteAccessKey,
        private string $awsBucketName,
        private string $appEnv,
    ){}

    /**
     * @return string
     */
    public function getAwsRegion(): string
    {
        return $this->awsRegion;
    }

    /**
     * @return string
     */
    public function getAwsVersion(): string
    {
        return $this->awsVersion;
    }

    /**
     * @return string
     */
    public function getAwsAccessKeyId(): string
    {
        return $this->awsAccessKeyId;
    }

    /**
     * @return string
     */
    public function getAwsSecreteAccessKey(): string
    {
        return $this->awsSecreteAccessKey;
    }

    /**
     * @return string
     */
    public function getAwsBucketName(): string
    {
        return $this->awsBucketName;
    }

    /**
     * @return string
     */
    public function getAppEnv(): string
    {
        return $this->appEnv;
    }


}