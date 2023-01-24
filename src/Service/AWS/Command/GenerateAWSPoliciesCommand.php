<?php
/**
 * Created by Graham Owens (gra@redfiredigital.uk)
 * Company: RedFire Digital Ltd (www.redfiredigital.uk)
 * Console: Snowdon
 *
 * User:    gra
 * Date:    17/January/2023
 * Time:    17:49
 * Project: iservo-admin
 * File:    GenerateAWSPoliciesCommand.php
 * IDE:     PhpStorm
 *
 **/

namespace RedFireDigital\Helper\Service\AWS\Command;

use RedFireDigital\Helper\Service\AWS\Service\s3Service;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'redfire:aws:generate-policies')]
class GenerateAWSPoliciesCommand extends Command
{
    public function __construct(protected s3Service $s3Service)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('Generate AWS Policies');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            '',
            '=====================',
            'AWS S3 Bucket ' . $this->s3Service->getAWSConfig()->getAwsBucketName() . ' in region ' . $this->s3Service->getAWSConfig()->getAwsRegion(),
            'Current Environment is ' . $this->s3Service->getAWSConfig()->getAppEnv(),
            '=====================',
            '',
            'BUCKET POLICY',
            '_____________________',
            $this->getBucketPolicy(),
            '',
            'USER POLICY',
            '_____________________',
            $this->getUserPolicy(),
        ]);


        $output->writeln([
            '=====================',

        ]);

        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }

    private function getBucketPolicy()
    {
        $awsConfig = $this->s3Service->getAWSConfig();
        $bucketName = $awsConfig->getAwsBucketName();
        return <<<EOT
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Sid": "{$bucketName}Statement1",
            "Effect": "Allow",
            "Principal": "*",
            "Action": "s3:GetObject",
            "Resource": "arn:aws:s3:::{$bucketName}/*"
        }
    ]
}
EOT;
    }

    private function getUserPolicy()
    {
        $awsConfig = $this->s3Service->getAWSConfig();
        $bucketName = $awsConfig->getAwsBucketName();

        return <<<EOT
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Sid": "{$bucketName}S3Bucket",
            "Effect": "Allow",
            "Action": [
                "s3:PutObject",
                "s3:GetObject",
                "s3:PutBucketAcl",
                "s3:ListBucket",
                "s3:PutBucketCORS",
                "s3:DeleteObject",
                "s3:PutObjectAcl"
            ],
            "Resource": [
                "arn:aws:s3:::{$bucketName}",
                "arn:aws:s3:::{$bucketName}/*"
            ]
        },
        {
            "Sid": "{$bucketName}VisualEditor1",
            "Effect": "Allow",
            "Action": "s3:ListAllMyBuckets",
            "Resource": "*"
        }
    ]
}
EOT;
    }

}