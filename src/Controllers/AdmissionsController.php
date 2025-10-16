<?php

namespace App\Controllers;

use App\Api;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\JsonResponse;
use League\Route\Http\Exception\BadRequestException;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Auth Controller.
 */
class AdmissionsController extends Controller
{
    public static function index(ServerRequestInterface $request): Response
    {
        $query = $request->getQueryParams();
        if (!isset($query['fecha_inicio'], $query['fecha_fin'])) {
            throw new BadRequestException();
        }

        $inicio = trim($query['fecha_inicio']);
        $fin = trim($query['fecha_fin']);
        
        $api = new Api();
        $admissions = $api->admissionsRange($inicio, $fin);
        return new JsonResponse($admissions);
    }
}
