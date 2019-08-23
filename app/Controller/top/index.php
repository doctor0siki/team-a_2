<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

    $data = [];

    //プルダウンに漢数字を出すために定義をする
    $data["kanji_num"] = array(
        1  => "壱",
        2  => "弐",
        3  => "参",
        4  => "四",
        5  => "伍",
        6  => "陸",
        7  => "漆",
        8  => "捌",
        9  => "玖",
        10 => "拾"
    );

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
});

