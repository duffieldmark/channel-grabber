<?php

namespace ChannelGrabber\Converter\Parser;

interface OutputParserInterface
{
    /**
     * @param array $data
     * @return string $data
     */
    public function parse(array $data): string;
}