<?php

namespace ChannelGrabber\Converter\Output;

use ChannelGrabber\Converter\OutputFormatterInterface;

/**
 * Class JsonParser
 * @package ChannelGrabber\Converter\Output
 */
class JsonFormatter implements OutputFormatterInterface
{
    /**
     * @param mixed $data
     * @return string $data
     */
    public function format(array $data): string
    {
       return json_encode($data, JSON_PRETTY_PRINT);
    }
}