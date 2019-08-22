<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/api/tours/{tour_id}[/]', function (Request $request, Response $response, $args) {

    $data = [
      "tour_id" => intval($args["tour_id"]),
      "name" => "tour".$args["tour_id"],
      "price" => 100*intval($args["tour_id"])
    ];

    //dd($this);

    $res = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    // Render index view
    return $this->response->withHeader("Content-Type", "application/json")->withStatus(200)->write($res);
});
