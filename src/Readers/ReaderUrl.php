<?php

namespace App\Readers;

use App\Tools\Http;

class ReaderUrl implements Reader
{
    protected $http;

    public function __construct(Http $http) {
        $this->http = $http;
    }

    public function getContent($source)
    {
        return $this->http->get($source);
    }
}
