<?php

namespace App;

use App\Wrappers\Storage;

class LocalDB
{
    private \SQLite3 $client;

    public function __construct()
    {
        $this->client = new \SQLite3(Storage::path('data.db'));
    }

    public function login(string $username, string $password): bool
    {
        $stmt = $this->client->prepare('SELECT username, password FROM users WHERE username=:username');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);

        $res = $stmt->execute();
        $user = $res->fetchArray();

        if ($user === false) {
            return false;
        }


        return password_verify($user['password'], $password);
    }
}