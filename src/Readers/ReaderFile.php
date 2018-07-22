<?php

namespace App\Readers;

class ReaderFile implements Reader
{
    public function read($source)
    {
        if (file_exists($source)) {
            return file_get_contents($source);
        }

        return '';
    }
}