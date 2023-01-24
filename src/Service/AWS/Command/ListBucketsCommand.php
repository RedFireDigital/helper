<?php
/**
 * Created by Graham Owens (gra@redfiredigital.uk)
 * Company: RedFire Digital Ltd (www.redfiredigital.uk)
 * Console: Snowdon
 *
 * User:    gra
 * Date:    17/January/2023
 * Time:    14:11
 * Project: iservo-admin
 * File:    ListBucketsCommand.php
 * IDE:     PhpStorm
 *
 **/

namespace RedFireDigital\Helper\Service\AWS\Command;

use RedFireDigital\Helper\Service\AWS\Service\s3Service;
use RedFireDigital\Helper\Service\GitInformation;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'redfire:aws:list-buckets')]
class ListBucketsCommand extends Command
{
    public function __construct(protected s3Service $s3Service)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('Command to list AWS Buckets');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $buckets = $this->s3Service->getListOfBuckets();
        $output->writeln([
            '',
            '=====================',
            'Listing AWS Buckets..',
            '=====================',
        ]);
        foreach ($buckets['Buckets'] as $bucket) {
            $output->writeln( $bucket['Name']);
        }

        $output->writeln([
            '=====================',
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