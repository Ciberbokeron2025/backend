<?php

namespace App\Enums;

/**
 * Enumerate all avilable cache engines.
 */
enum CacheEnum: string
{
    case FILE = "file";
    case APCU = "apcu";
    case REDIS = "redis";
}
