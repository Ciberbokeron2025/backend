<?php

namespace App;

use GuzzleHttp\Client;

class Api
{
    private const string BASE_URL = "";

    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => self::BASE_URL,
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
    }

    public static function login(): bool
    {
        return true;
    }
}
