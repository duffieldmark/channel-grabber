<?php

namespace ChannelGrabber\Converter;

interface InputParserInterface
{
    /**
     * @param mixed $data
     * @return array $data
     */
    public function parse(string $data): array;
}