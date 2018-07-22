<?php

namespace App\Readers;

class FeedReader
{
    protected $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function getContents($source)
    {
        return $this->reader->read($source);
    }
}