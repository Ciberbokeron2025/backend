<?php

namespace App\Cache;

/**
 * Cache using APCu. Recommended for small instances.
 *
 * @link https://www.php.net/manual/en/book.apcu.php
 */
class ApcuCache implements ICache
{
    public function __construct()
    {
        if (!(extension_loaded('apcu') && apcu_enabled())) {
            throw new \Exception('APCu not enabled');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $cache_key): ?object
    {
        $data = apcu_fetch($cache_key);
        if ($data) {
            return json_decode($data);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function exists(string $cache_key): bool
    {
        return apcu_exists($cache_key);
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $cache_key, string $data, int $timeout = 3600): void
    {
        apcu_store($cache_key, $data, $timeout);
    }
}
