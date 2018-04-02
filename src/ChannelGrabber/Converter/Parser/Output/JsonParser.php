<?php

namespace ChannelGrabber\Converter\Parser\Output;

use ChannelGrabber\Converter\Parser\OutputParserInterface;

/**
 * Class JsonParser
 * @package ChannelGrabber\Converter\Parser\Output
 */
class JsonParser implements OutputParserInterface
{
    /**
     * @param mixed $data
     * @return string $data
     */
    public function parse(array $data): string
    {
       return json_encode($data, JSON_PRETTY_PRINT);
    }
}