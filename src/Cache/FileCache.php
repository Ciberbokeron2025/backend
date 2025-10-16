<?php

namespace App\Cache;

use App\Wrappers\Storage;

/**
 * Cache using txt files. Should only be used when debugging!
 */
class FileCache implements ICache
{
    private string $cache_path;

    public function __construct()
    {
        if (isset($_ENV['API_CACHE_PATH']) && !empty($_ENV['API_CACHE_PATH'])) {
            $this->cache_path = $_ENV['API_CACHE_PATH'];
        } else {
            $this->cache_path = Storage::path('data');
            if (!is_dir($this->cache_path)) {
                $created = mkdir($this->cache_path, 0777, true);
                if (!$created) {
                    throw new \Exception('Error creating cache folder');
                }
            }
        }
    }

    public function get(string $cache_key): ?string
    {
        $filename = $this->cache_path . '/' . $cache_key . '.txt';
        if (is_file($filename)) {
            $json_string = file_get_contents($filename);
            return $json_string;
        }
        return null;
    }

    public function exists(string $cache_key): bool
    {
        $filename = $this->cache_path . '/' . $cache_key . '.txt';
        return is_file($filename);
    }

    public function set(string $cache_key, string $data, int $timeout = 3600): void
    {
        file_put_contents($this->cache_path . '/' . $cache_key . '.txt', $data);
    }
}
