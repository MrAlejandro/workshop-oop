<?php

namespace App\Tools;

use GuzzleHttp\Client;

class Http
{
    private $http;

    public function __construct()
    {
        $this->http = new Client();
    }

    public function get($url)
    {
        $response = $this->http->request('GET', $url);
        return $response->getBody();
    }
}