<?php

namespace App\Controllers;

use AltchaOrg\Altcha\Altcha;
use App\Wrappers\Env;
use App\Wrappers\Session;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Auth Controller.
 */
class AuthController extends Controller
{
    /**
     * Login check.
     *
     * - Route: `/auth/login`
     * - Method: `POST`
     */
    public static function post(ServerRequestInterface $request): Response
    {
        $body = $request->getParsedBody();

        if (!isset($body['username'], $body['password'], $body['altcha'])) {
            throw self::__invalidBody();
        }

        $username = trim($body['username']);
        $password = trim($body['password']);

        // Check captcha
        $altcha = new Altcha(Env::app_key());
        if (!$altcha->verifySolution($body['altcha'], true)) {
            throw self::__invalidBody();
        }

        // TODO: Do login
        // ...

        Session::login($username);

        return new JsonResponse([]);
    }

    /**
     * Logout user
     *
     * Route: `/staff/logout`
     * Method: `GET`
     */
    public static function logout(ServerRequestInterface $request): Response
    {
        Session::destroy();
        return new JsonResponse([]);
    }
}
