<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

class ConvertCsvCommand extends Command
{

    protected $csvParser;
    protected $jsonFormatter;

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        // Command info / description
        $this
            ->setName('converter:convert-csv')
            ->setDescription('Converts a CSV file to a specified format.')
            ->setHelp('Allows you to convert a CSV to a specified format which is returned to the console');

        // Command arguments
        $this
            ->addArgument('csv_path', InputArgument::REQUIRED, 'The path to the CSV file you wish to convert.')
            ->addOption('format', 'f', InputArgument::OPTIONAL, 'The format you wish to output for the result i.e. JSON, XML (defaults to JSON)');
    }
}