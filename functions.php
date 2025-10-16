<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

if (!function_exists('logger')) {
    /** @var ?Logger */
    $logger = null;
    function logger(): Logger {
        global $logger;
        if ($logger !== null) {
            return $logger;
        }

        $logger = new Logger('malakathon');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/storage/malakathon.log'));

        return $logger;
    }
}
