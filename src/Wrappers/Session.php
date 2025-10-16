<?php

namespace App\Wrappers;

class Session
{
    public static function start(): void
    {
        session_start([
            'cookie_secure' => 1,
            'cookie_httponly' => 1,
        ]);
    }

    public static function destroy(): void
    {
        session_destroy();
    }

    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }

    public static function login(string $username): void
    {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
    }
}
