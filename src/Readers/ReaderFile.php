<?php

namespace App\Readers;

class ReaderFile implements Reader
{
    public function getContent($source)
    {
        if (file_exists($source)) {
            return file_get_contents($source);
        }

        return '';
    }
}