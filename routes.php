<?php
use App\Controllers\AuthController;
use League\Route\RouteGroup;

$router->group('/auth', function (RouteGroup $route) {
    // -- Auth -- //
    $route->post('/login', [AuthController::class, 'post']);
    $route->get('/logout', [AuthController::class, 'logout']);
});
