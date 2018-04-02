<?php

use ChannelGrabber\Converter\Input\CsvParser;
use ChannelGrabber\Converter\Output\JsonFormatter;
use ChannelGrabber\Converter\Output\XmlFormatter;

require_once __DIR__ . '/vendor/autoload.php';

$csvParser = new CsvParser();
$jsonFormatter = new JsonFormatter();
$xmlFormatter = new XmlFormatter();

return [
    'csvParser' => $csvParser,
    'jsonFormatter' => $jsonFormatter,
    'xmlFormatter' => $xmlFormatter,
];