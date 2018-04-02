<?php

namespace ChannelGrabber\Converter\Parser;

interface InputParserInterface
{
    /**
     * @param mixed $data
     * @return array $data
     */
    public function parse(string $data): array;
}