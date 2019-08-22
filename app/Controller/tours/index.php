<?php

use Model\Dao\Item;
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

    //URLパラメータのitem_idを取得します。
    $tour_id = $args["tour_id"];

    //アイテムDAOをインスタンス化します。
    $item = new Item($this->db);

    //URLパラメータのitem_id部分を引数として渡し、戻り値をresultに格納します
    // $data["result"] = $item->getItem($item_id);
    

    // Render index view
    return $this->view->render($response, 'tours/index.twig', $data);
    // return $this['render]->write('aaaa');
});