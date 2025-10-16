<?php

namespace App\Wrappers;

use App\Enums\CacheEnum;

/**
 * Wrapper for Environment Variables.
 */
class Env
{
    public static function parse(string $path): void
    {
        $arr = @parse_ini_file($path, false, INI_SCANNER_TYPED);

        if ($arr === false) {
            return;
        }

        foreach ($arr as $key => $val) {
            putenv("$key=$val");
            $_ENV[$key] = $val;
        }
    }

    /**
     * Get app's debugging state.
     */
    public static function app_debug(): bool
    {
        return $_ENV['APP_DEBUG'] ?? false;
    }

    /**
     * Get app's encryption key.
     */
    public static function app_key(): string
    {
        return $_ENV['APP_KEY'] ?? '';
    }

    /**
     * Get cache engine to be used.
     */
    public static function api_cache(): ?CacheEnum
    {
        $value = $_ENV['API_CACHE'] ?? null;
        return $value !== null ? CacheEnum::tryFrom($value) : null;
    }

    /**
     * Get Redis credentials.
     */
    public static function redis(): array
    {
        $host = $_ENV['REDIS_HOST'] ?? null;
        $port = $_ENV['REDIS_PORT'] ?? null;
        $password = $_ENV['REDIS_PASSWORD'] ?? null;

        return [
            'host' => $host,
            'port' => $port,
            'password' => $password,
        ];
    }
}
