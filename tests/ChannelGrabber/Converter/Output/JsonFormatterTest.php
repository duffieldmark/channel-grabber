<?php

namespace tests\ChannelGrabber\Converter\Output;

use ChannelGrabber\Converter\Output\JsonFormatter;
use PHPUnit\Framework\TestCase;

class ProductFormatterTest extends TestCase
{
    /** @var JsonFormatter */
    protected $jsonFormatter;

    public function setUp()
    {
        parent::setUp();
        $this->jsonFormatter = new JsonFormatter();
    }

    public function testFormatOneLine()
    {
        $data = [
            'name' => 'Dave',
            'address' => [
                'line1' => 'Street',
                'line2' => 'Town'
            ]
        ];

        $expectedOutput = '{"name":"Dave","address":{"line1":"Street","line2":"Town"}}';

        $output = $this->jsonFormatter->format($data);

        // Json decode and re-encode to remove the pretty printing we do for the actual output, makes it easier to perform assertion
        $this->assertEquals($expectedOutput, json_encode(json_decode($output)));
    }

    public function testFormatTwoLine()
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

        $output = $this->jsonFormatter->format($data);

        // Json decode and re-encode to remove the pretty printing we do for the actual output, makes it easier to perform assertion
        $this->assertEquals($expectedOutput, json_encode(json_decode($output)));
    }
}