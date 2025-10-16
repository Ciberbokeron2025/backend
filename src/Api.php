<?php

namespace App;

use App\Wrappers\Env;
use GuzzleHttp\Client;

class Api
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => Env::db_url(),
            'timeout' => 5.0,
        ]);
    }

    public function admissionsAll(): object
    {
        $res = $this->client->get('admissions');
        return json_decode($res->getBody());
    }

    public function login(): bool
    {
        return true;
    }
}
