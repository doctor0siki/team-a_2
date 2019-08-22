<?php

use Model\Dao\Item;
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/tours/{tour_id}/reviews/new[/]', function (Request $request, Response $response, $args) {

    //ツアー参加者みわたされたレビュー書き込み用QRコードから入れる画面
    //実際はGETパラメータでツアー予約IDを持っていて、旅行代理店側と同様の顧客情報と紐付けられるようにする

    $data = [];

    //URLパラメータのitem_idを取得します。
    //getでurlに入力されている{tour_id}の数値をtour_idに代入
    $tour_id = $args["tour_id"];

    // //アイテムDAOをインスタンス化します。
    // $item = new Item($this->db);
    //
    // //URLパラメータのitem_id部分を引数として渡し、戻り値をresultに格納します
    // $data["result"] = $item->getItem($item_id);

    // Render index view
    return $this->view->render($response, 'reviews/new.twig', $data);
});

$app->post('/tours/{tour_id}/reviews/create[/]', function (Request $request, Response $response, $args) {
    //送信されたレビューを受け取ってありがとうございましたと表示する

    $data = [];

    //URLパラメータのitem_idを取得します。
    //getでurlに入力されている{tour_id}の数値をtour_idに代入
    $tour_id = $args["tour_id"];

    // //アイテムDAOをインスタンス化します。
    // $item = new Item($this->db);
    //
    // //URLパラメータのitem_id部分を引数として渡し、戻り値をresultに格納します
    // $data["result"] = $item->getItem($item_id);

    // Render index view
    return $this->view->render($response, 'reviews/thanks.twig', $data);
});
