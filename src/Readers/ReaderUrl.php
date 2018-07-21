<?php

namespace App\Readers;

use App\Tools\Http;

class ReaderUrl extends Reader
{
    protected $http;

//    public function __construct($source, Http $http) {
//        $this->http = $http;
//        parent::__construct($source);
//    }

    public function __construct($source) {
        // FIXME: inject App\Tools\Http somehow
        $this->http = new Http();
        parent::__construct($source);
    }

    public function read()
    {
        return $this->http->get($this->source);
    }
}
