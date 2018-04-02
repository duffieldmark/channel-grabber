<?php

namespace ChannelGrabber\Converter\Parser;

interface OutputParserInterface
{
    /**
     * @param array $data
     * @return mixed $data
     */
    public function parse(array $data): mixed;
}