<?php

require __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\ServerRequestFactory;

$request = ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;

$router->map('GET', '/', 'Spacex\Controller\Launches::nextLaunch');
$router->map('GET', '/last-launch', 'Spacex\Controller\Launches::lastLaunch');
$router->map('GET', '/past-launches', 'Spacex\Controller\Launches::pastLaunches');

$response = $router->dispatch($request);
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);