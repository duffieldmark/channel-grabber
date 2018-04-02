<?php

namespace ChannelGrabber\Converter;

interface OutputFormatterInterface
{
    /**
     * @param array $data
     * @return string $data
     */
    public function format(array $data): string;
}