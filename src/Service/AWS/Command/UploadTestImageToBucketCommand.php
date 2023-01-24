<?php
/**
 * Created by Graham Owens (gra@redfiredigital.uk)
 * Company: RedFire Digital Ltd (www.redfiredigital.uk)
 * Console: Snowdon
 *
 * User:    gra
 * Date:    17/January/2023
 * Time:    15:59
 * Project: iservo-admin
 * File:    UploadTestImageToBucketCommand.php
 * IDE:     PhpStorm
 *
 **/

namespace RedFireDigital\Helper\Service\AWS\Command;

use RedFireDigital\Helper\Service\AWS\Service\s3Service;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


#[AsCommand(name: 'redfire:aws:test-file-upload')]
class UploadTestImageToBucketCommand extends Command
{
    CONST TEST_IMAGE_URL = "https://redfiredigital.uk/build/img/carl1.768ae4f8.jpg";
    public function __construct(protected s3Service $s3Service)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('Upload a picture of Carl to bucket');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fileContents = file_get_contents(self::TEST_IMAGE_URL);
        $output->writeln([
            '',
            '=====================',
            'Sending test image to AWS S3 Bucket ' . $this->s3Service->getAWSConfig()->getAwsBucketName() . ' in region ' . $this->s3Service->getAWSConfig()->getAwsRegion(),
            'Current Environment is ' . $this->s3Service->getAWSConfig()->getAppEnv(),
            '=====================',
            'Sending image ' . self::TEST_IMAGE_URL . '...',
            'File size ' . strlen($fileContents) . ' bytes',
        ]);


        $uploadedS3 = $this->s3Service->putObject(
            'test',
            'carl.jpg',
            $fileContents
        );


        $output->writeln([
            '=====================',
            'Uploaded to ' . $uploadedS3->getFileName(),
            's3 URL ' . $uploadedS3->getAwsS3Path(),
            's3 Key ' . $uploadedS3->getAwsBucketKey(),
            'Public URL ' . $uploadedS3->getPublicUrl(),
            '',
        ]);

        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }


}