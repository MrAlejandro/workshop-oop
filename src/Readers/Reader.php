<?php

namespace App\Readers;

abstract class Reader
{
    protected $source;

    public function __construct($source)
    {
        $this->source = $source;
    }

    abstract public function read();
}