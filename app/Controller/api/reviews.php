<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/api/tours/reviews/{review_id}[/]', function (Request $request, Response $response, $args) {

    $data = [
      "review_id" => intval($args["review_id"]),
      "age" => intval(30 * $args["review_id"]),
      "gender" => (intval($args["review_id"]) % 2)? "オス" : "メス",
      "visit_date" => date("Y/m/d"),
      "text" => intval($args["review_id"])."点でした。"
    ];

    //dd($this);

    $res = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    // Render index view
    return $this->response->withHeader("Content-Type", "application/json")->withStatus(200)->write($res);
});
