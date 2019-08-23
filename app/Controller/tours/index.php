<?php

use Model\Dao\Tours;
use Slim\Http\Request;
use Slim\Http\Response;


/**
 * 旅行単体を出すコントローラです
 *
 * {item_id}の中身は$argsに入ります。
 * 取得する時は、$args["item_id"]で取得できます。
 */

$app->get('/tours/{tour_id}[/]', function (Request $request, Response $response, $args) {
    $data = [];
    $host_name = $this->request->getServerParams()["HTTP_HOST"];

    //URLパラメータのitem_idを取得します。
    $tour_id = $args["tour_id"];

    //アイテムDAOをインスタンス化します。
    $tour = new Tours($this->db);
    $data['tour'] = $tour->getTour($tour_id);
    if($data['tour'] == null){
        return $this->view->render($response->withStatus(405), 'error/404.twig', [
            "myMagic" => "Let's roll"
        ]);
    }
    $data['tour']['reviews'] = $tour->reviews($tour_id);
    $data['qr_path'] = 'http://'.$host_name."/tours/".$tour_id."/reserving";

    
    // Render index view
    return $this->view->render($response, 'tours/index.twig', $data);
    // return $this['render]->write('aaaa');
});