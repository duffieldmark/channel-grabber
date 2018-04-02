<?php

namespace ChannelGrabber\Parser\Output\JsonParser;

use ChannelGrabber\Converter\Output\JsonFormatter;
use PHPUnit\Framework\TestCase;

class ProductParserTest extends TestCase
{
    /** @var JsonFormatter */
    protected $jsonParser;

    public function setUp()
    {
        parent::setUp();
        $this->jsonParser = new JsonFormatter();
    }

    public function testParseOneLine()
    {
        $data = [
            'name' => 'Dave',
            'address' => [
                'line1' => 'Street',
                'line2' => 'Town'
            ]
        ];

        $expectedOutput = '{"name":"Dave","address":{"line1":"Street","line2":"Town"}}';

        $output = $this->jsonParser->format($data);
        $this->assertEquals($expectedOutput, json_encode(json_decode($output)));
    }

    public function testParseTwoLine()
    {
        $data = [
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

        $expectedOutput = '[{"name":"Dave","address":{"line1":"Street","line2":"Town"}},{"name":"Mark","address":{"line1":"Street2","line2":"Town2"}}]';

        $output = $this->jsonParser->format($data);
        $this->assertEquals($expectedOutput, json_encode(json_decode($output)));
    }
}