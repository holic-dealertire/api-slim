<?php
/**
 * 메인
 * User: holic
 * Date: 2021-08-11
 */

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/db.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("hello, world");
    return $response;
});

$app->get('/{name}', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("hello, world" . $args['name']);
    return $response;
});

// tire routes
require __DIR__ . '/../routes/tire.php';

$app->run();
?>
