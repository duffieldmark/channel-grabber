<?php

namespace ChannelGrabber\Parser\Output\JsonParser;

use ChannelGrabber\Converter\Parser\Output\JsonParser;
use PHPUnit\Framework\TestCase;

class ProductParserTest extends TestCase
{
    /** @var JsonParser */
    protected $jsonParser;

    public function setUp()
    {
        parent::setUp();
        $this->jsonParser = new JsonParser();
    }

    public function testParse()
    {
        $data = [
            'name' => 'Dave',
            'address' => [
                'line1' => 'Street',
                'line2' => 'Town'
            ]
        ];

        $expectedOutput =
            '{"name":"Dave","address":{"line1":"Street","line2":"Town"}}';

        $output = $this->jsonParser->parse($data);
        $this->assertEquals($expectedOutput, json_encode(json_decode($output)));
    }
}