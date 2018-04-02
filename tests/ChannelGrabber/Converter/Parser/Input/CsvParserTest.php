<?php

namespace tests\ChannelGrabber\Converter\Parser\Input;

use ChannelGrabber\Converter\Parser\Input\CsvParser;
use PHPUnit\Framework\TestCase;

class ProductParserTest extends TestCase
{
    /** @var CsvParser */
    protected $csvParser;

    public function setUp()
    {
        parent::setUp();
        $this->csvParser = new CsvParser();
    }

    public function testParse()
    {
        $csv = "name,address_line1,address_line2\nDave,Street,Town";

        $expectedOutput = $array = [
            'name' => 'Dave',
            'address' => [
                'line1' => 'Street',
                'line2' => 'Town'
            ]
        ];

        $output = $this->csvParser->parse($csv);
        $this->assertEquals($expectedOutput, $output);
    }
}