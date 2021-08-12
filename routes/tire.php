<?php
/**
 * 컨트롤러-타이어
 * User: holic
 * Date: 2021-08-11
 */

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

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

$app->get('/tire/{part_no}', function (Request $request, Response $response, array $args) {
    $part_no = trim($args['part_no']);
    $sql = "select * from g5_shop_item_option where io_part_no = $part_no";

    try {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->query($sql);
        $tire = $stmt->fetch(PDO::FETCH_OBJ);
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
