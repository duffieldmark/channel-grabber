<?php

namespace tests\ChannelGrabber\Converter\Input;

use ChannelGrabber\Converter\Input\CsvParser;
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

    public function testParseOneLine()
    {
        $csv = "name,address_line1,address_line2\nDave,Street,Town";

        $expectedOutput = $array = [
            [
                'name' => 'Dave',
                'address' => [
                    'line1' => 'Street',
                    'line2' => 'Town'
                ]
            ]
        ];

        $output = $this->csvParser->parse($csv);
        $this->assertEquals($expectedOutput, $output);
    }

    public function testParseTwoLine()
    {
        $csv = "name,address_line1,address_line2\nDave,Street,Town\nMark,Street2,Town2";

        $expectedOutput = [
            [
                'name' => 'Dave',
                'address' => [
                    'line1' => 'Street',
                    'line2' => 'Town'
                ]
            ],
            [
                'name' => 'Mark',
                'address' => [
                    'line1' => 'Street2',
                    'line2' => 'Town2'
                ]
            ]
        ];

        $output = $this->csvParser->parse($csv);
        $this->assertEquals($expectedOutput, $output);
    }
}