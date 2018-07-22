<?php

namespace App\Readers;

use App\Tools\Http;

class ReaderUrl implements Reader
{
    protected $http;

    public function __construct($source) {
        // FIXME: inject App\Tools\Http somehow
        $this->http = new Http();
    }

    public function read($source)
    {
        return $this->http->get($source);
    }
}
