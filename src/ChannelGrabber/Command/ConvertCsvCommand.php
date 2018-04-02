<?php

namespace App\Command;

use ChannelGrabber\Converter\Input\CsvParser;
use ChannelGrabber\Converter\Output\JsonFormatter;
use ChannelGrabber\Converter\Output\XmlFormatter;
use ChannelGrabber\Converter\OutputFormatterInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertCsvCommand extends Command
{

    /** @var CsvParser */
    protected $csvParser;

    /** @var JsonFormatter */
    protected $jsonFormatter;

    /** @var XmlFormatter */
    protected $xmlFormatter;

    /** @var OutputFormatterInterface */
    protected $activeFormatter;

    public function __construct(CsvParser $csvParser, JsonFormatter $jsonFormatter, XmlFormatter $xmlFormatter)
    {
        $this->csvParser = $csvParser;
        $this->jsonFormatter = $jsonFormatter;
        $this->xmlFormatter = $xmlFormatter;
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $format = strtoupper($input->getOption('format'));

        switch ($format) {
            case 'XML':
                $this->activeFormatter = &$this->xmlFormatter;
                break;
            case 'JSON':
            default:
                $format = 'JSON';
                $this->activeFormatter = &$this->jsonFormatter;
        }

        if (!file_exists($input->getArgument('csv_path'))) {
            $output->writeln('<error>Unable to locate file specified.</error>');
            return 1;
        }

        $contents = file_get_contents($input->getArgument('csv_path'));
        if (false === $contents) {
            $output->writeln('<error>Unable to open file for writing or the data is corrupt.</error>');
            return 1;
        }

        $input = $this->csvParser->parse($contents);
        $retval = $this->activeFormatter->format($input);
        $output->writeln("<info>===== Begin {$format} =====</info>");
        $output->writeln($retval);
        $output->writeln("<info>===== End {$format} =====</info>");
    }
}