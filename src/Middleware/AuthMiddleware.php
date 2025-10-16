<?php

namespace App\Middleware;

use App\Wrappers\Env;
use App\Wrappers\Session;
use League\Route\Http\Exception\UnauthorizedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Check if admin is logged in before entering restricted routes.
 */
class AuthMiddleware implements MiddlewareInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getUri()->getPath();
        $method = $request->getMethod();

        if (!Env::app_debug() && !(str_starts_with($path, '/login') && $method === 'POST') && !Session::isLoggedIn()) {
            throw new UnauthorizedException();
        }

        return $handler->handle($request);
    }
}
