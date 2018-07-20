<?php

namespace App\Readers;

class ReaderFile extends Reader
{
    public function read()
    {
        if (file_exists($this->source)) {
            return file_get_contents($this->source);
        }

        return '';
    }
}