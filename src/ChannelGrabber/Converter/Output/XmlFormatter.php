<?php

namespace ChannelGrabber\Converter\Output;

use ChannelGrabber\Converter\OutputFormatterInterface;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

/**
 * Class JsonParser
 * @package ChannelGrabber\Converter\Output
 */
class XmlFormatter implements OutputFormatterInterface
{
    /**
     * @param array $data
     * @return string $data
     */
    public function format(array $data): string
    {
        $encoder = new XmlEncoder();
        return $encoder->encode($data, 'xml');
    }
}