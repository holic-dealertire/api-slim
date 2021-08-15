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

$app->get('/tire/all', function (Request $request, Response $response) {
    $sql = "select * from g5_shop_item_option";

    try {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->query($sql);
        $tire = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        $response->getBody()->write(json_encode($tire));

        return $response
            ->withHeader('content-type', 'application/json;charset=utf-8')
            ->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response
            ->withHeader('content-type', 'application/json;charset=utf-8')
            ->withStatus(500);
    }
});

$app->run();
?>
