<?php

namespace App\Wrappers;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\JsonResponse;

class MsgHandler
{
    public static function error(int $status, string $code, string $body): Response
    {
        return new JsonResponse([
            'status' => $status,
            'code' => $code,
            'message' => $body,
        ]);
    }
}
