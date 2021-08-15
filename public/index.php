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

$app->get('/openapi', function ($request, $response, $args) {
    $swagger = scan(__DIR__ . '/document/document.yaml');
    $response->getBody()->write(json_encode($swagger));
    return $response->withHeader('Content-Type', 'application/json');
});

$_url = parse_url($_SERVER['REQUEST_URI']);
$_routes = explode('/', $_url['path']);
$_baseRoute = $_routes[1];

switch ($_baseRoute) {
    case 'order':
        $_routeFile = __DIR__ . '/../routes/order.php';
        break;
    default:
        $_routeFile = __DIR__ . '/../routes/tire.php';
        break;
}

if (file_exists($_routeFile)) {
    require $_routeFile;
} else {
    die('Invalid API request');
}

$app->run();
?>
