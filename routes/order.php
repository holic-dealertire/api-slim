<?php
/**
 * 컨트롤러-주문
 * User: holic
 * Date: 2021-08-11
 */

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->post('/order/add', function (Request $request, Response $response, array $args) {
    $od_id = $request->getParam('odid');
    $od_name = $request->getParam('odname');
    $od_tel = $request->getParam('odtel');
    $odzip = $request->getParam('odzip');
    $od_zip1 = substr($odzip, 0, 3);
    $od_zip2 = substr($odzip, 3);
    $od_addr1 = $request->getParam('odaddr1');
    $od_addr2 = $request->getParam('odaddr2');
    $od_addr3 = $request->getParam('odaddr3');
    $od_memo = $request->getParam('odmemo');

    $sql = "insert into g5_shop_order (od_id, od_name, od_tel, od_hp, od_zip1, od_zip2, od_addr1, od_addr2, od_addr3, od_memo) value (:od_id, :od_name, :od_tel, :od_tel, :od_zip1, :od_zip2, :od_addr1, :od_addr2, :od_addr3, :od_memo)";

    try {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':od_id', $od_id);
        $stmt->bindParam(':od_name', $od_name);
        $stmt->bindParam(':od_tel', $od_tel);
        $stmt->bindParam(':od_zip1', $od_zip1);
        $stmt->bindParam(':od_zip2', $od_zip2);
        $stmt->bindParam(':od_addr1', $od_addr1);
        $stmt->bindParam(':od_addr2', $od_addr2);
        $stmt->bindParam(':od_addr3', $od_addr3);
        $stmt->bindParam(':od_memo', $od_memo);

        $result = $stmt->execute();

        $db = null;

        $response->getBody()->write(json_encode($result));

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
?>
