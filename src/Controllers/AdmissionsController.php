<?php

namespace App\Controllers;

use App\Api;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Auth Controller.
 */
class AdmissionsController extends Controller
{
    public static function index(ServerRequestInterface $request): Response
    {
        $api = new Api();
        $admissions = $api->admissionsAll();
        return new JsonResponse($admissions);
    }
}
