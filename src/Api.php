<?php

namespace App;

use App\Wrappers\Env;
use GuzzleHttp\Client;

class Api
{
    private Client $client;
    private Cache $cache;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => Env::db_url(),
            'timeout' => 5.0,
        ]);

        $this->cache = new Cache();
    }

    public function admissionsRange(string $inicio, string $fin): object
    {
        return $this->__request('stats/daterange', [
            'fecha_inicio' => '2016-01-01',
            'fecha_fin' => '2016-01-15',
        ]);
    }

    public function login(): bool
    {
        return true;
    }

    private function __request(string $endpoint, array $query = []): object
    {
        $key = str_replace('/', '-', $endpoint);
        if ($this->cache->exists($key)) {
            return $this->cache->get($key);
        }

        $res = $this->client->get($endpoint, [
            'query' => $query,
        ]);

        $body = $res->getBody();

        $this->cache->set($key, $body);
        return json_decode($body);
    }
}
