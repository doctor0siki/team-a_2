<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/tours/{tour_id}/reserving[/]', function (Request $request, Response $response, $args) {

    $data = [
      "tour_id" => $args["tour_id"],
      "reserving_record" => $args["tour_id"] * 10,
      "host_name" => 'http://team-a4.2021.local',
    ];
    $reserving = $args["tour_id"];

    // Render index view
    return $this->view->render($response, 'reservings/qr.twig', $data);
});

$app->get('/tours/{tour_id}/reserving/edit[/]', function (Request $request, Response $response, $args) {

    $data = [
      "tour_id" => $args["tour_id"],
    ];
    $reserving = $args["tour_id"];
    // Render index view
    return $this->view->render($response, 'reservings/edit.twig', $data);
});

$app->post('/tours/{tour_id}/reserving/update[/]', function (Request $request, Response $response, $args) {

    //POSTされた内容を取得します
    $received = $request->getParsedBody();

    $data = [
      "cs_name" => $received["cs_name"],
      "departure_date" =>  $received["departure_date"],
      "tell" =>  $received["tell"],
      "refund_method" =>  $received["refund_method"],
      "refund_amount" =>  $received["refund_amount"],
      "agent_store_id" =>  $received["agent_store_id"],
      "tour_id" => $args["tour_id"],
      "reserving_record" => $args["tour_id"] * 10,
      "host_name" => 'http://'.$this->request->getServerParams()["HTTP_HOST"],
    ];
    $reserving = $args["tour_id"];

    //dd($received, $data);

    // Render index view
    return $this->view->render($response, 'reservings/completed.twig', $data);
});
