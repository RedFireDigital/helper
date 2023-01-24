<?php
/**
 * Created by Graham Owens (gra@redfiredigital.uk)
 * Company: RedFire Digital Ltd (www.redfiredigital.uk)
 * Console: Snowdon
 *
 * User:    gra
 * Date:    17/January/2023
 * Time:    13:44
 * Project: iservo-admin
 * File:    AWSBase.php
 * IDE:     PhpStorm
 *
 **/

namespace RedFireDigital\Helper\Service\AWS\Service;

use Aws\Sdk;

class AWSBase
{
    public function __construct(
        protected AWSConfig $awsConfig,
    )
    {}

    protected function getSDK() : Sdk
    {
        return new Sdk([
            'region' => $this->awsConfig->getAwsRegion(),
            'version' => $this->awsConfig->getAwsVersion(),
            'credentials' => [
                'key'    => $this->awsConfig->getAwsAccessKeyId(),
                'secret' => $this->awsConfig->getAwsSecreteAccessKey(),
            ]
        ]);
    }

    public function getAWSConfig() : AWSConfig
    {
        return $this->awsConfig;
    }
}