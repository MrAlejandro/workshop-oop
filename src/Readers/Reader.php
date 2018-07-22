<?php

namespace App\Readers;

interface Reader
{
    public function getContent($source);
}