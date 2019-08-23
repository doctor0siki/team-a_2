<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Reservings;

$app->get('/tours/{tour_id}/reserving[/]', function (Request $request, Response $response, $args) {

    $data = [
      "tour_id" => $args["tour_id"],
      "host_name" => 'http://'. $host_name = $this->request->getServerParams()["HTTP_HOST"]
    ];

    // Render index view
    return $this->view->render($response, 'reservings/qr.twig', $data);
});

$app->get('/tours/{tour_id}/reserving/edit[/]', function (Request $request, Response $response, $args) {

    $data = [
      "tour_id" => $args["tour_id"],
    ];
    // Render index view
    return $this->view->render($response, 'reservings/edit.twig', $data);

});

$app->post('/tours/{tour_id}/reserving/update[/]', function (Request $request, Response $response, $args) {

    //POSTされた内容を取得します
    $received = $request->getParsedBody();

    $data = [
      "reserving"=>[
        "cs_name" => $received["cs_name"],
        "departure_date" =>  $received["departure_date"],
        "tell" =>  $received["tell"],
        "refund_method" => $received["refund_method"],
        "refund_amount" => $received["refund_amount"],
        "agent_store_id" => $received["agent_store_id"],
        "tour_id" => $args["tour_id"],
      ],
      "host_name" => 'http://'.$this->request->getServerParams()["HTTP_HOST"],
    ];

    //dd($data);

    $reserving = new Reservings($this->db);
    if($reserving->validate($data["reserving"])){//データに不備があった場合
      //return $this->view->render($response, 'reservings/edit.twig', $data);
      //dd($data);
      return $response->withRedirect('/tours/'.$data["reserving"]["tour_id"]."/reserving/edit");
    }else{//不備がなかった場合挿入
      $data["reserving"]["id"] = $reserving->insert($data["reserving"]);
    }

    // Render index view
    return $this->view->render($response, 'reservings/completed.twig', $data);
});
