<?php

namespace App;

use App\Wrappers\Crypto;
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
            'fecha_inicio' => $inicio,
            'fecha_fin' => $fin,
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
            $data = $this->cache->get($key);
            return json_decode(Crypto::decrypt($data));
        }

        $res = $this->client->get($endpoint, [
            'query' => $query,
        ]);

        $body = $res->getBody();

        $this->cache->set($key, Crypto::encrypt($body));
        return json_decode($body);
    }
}
