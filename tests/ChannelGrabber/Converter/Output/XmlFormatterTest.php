<?php

namespace tests\ChannelGrabber\Converter\Output;

use ChannelGrabber\Converter\Output\JsonFormatter;
use ChannelGrabber\Converter\Output\XmlFormatter;
use PHPUnit\Framework\TestCase;

class XmlFormatterTest extends TestCase
{
    /** @var XmlFormatter */
    protected $xmlFormatter;

    public function setUp()
    {
        parent::setUp();
        $this->xmlFormatter = new XmlFormatter();
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

        $expectedOutput = '<?xml version="1.0"?><response><name>Dave</name><address><line1>Street</line1><line2>Town</line2></address></response>';

        $output = $this->xmlFormatter->format($data);
        $output = str_replace(PHP_EOL, '', $output);
        $this->assertEquals($expectedOutput, $output);
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

        $expectedOutput = '<?xml version="1.0"?><response><item key="0"><name>Dave</name><address><line1>Street</line1><line2>Town</line2></address></item><item key="1"><name>Mark</name><address><line1>Street2</line1><line2>Town2</line2></address></item></response>';


        $output = $this->xmlFormatter->format($data);
        $output = str_replace(PHP_EOL, '', $output);
        $this->assertEquals($expectedOutput, $output);
    }
}