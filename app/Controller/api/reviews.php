<?php

use Slim\Http\Request;
use Slim\Http\Response;

use Model\Dao\Reviews;

$app->get('/api/reviews[/]', function(Request $request, Response $response){
    $getParams = $request->getQueryParams();
    
    $seats_available = intval($getParams['member']);
    $page = ($getParams['page']) ? intval($getParams['page'])-1 : 0;
    // dd($seats_available);
    if($seats_available == null){
        $data = [];
        $res = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
        // Render index view
        return $this->response->withHeader("Content-Type", "application/json")->withStatus(200)->write($res);
    }

    $review = new Reviews($this->db);
    $reviews = $review->get_reviews($seats_available, $page);

    $res = json_encode($reviews, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    // Render index view
    return $this->response->withHeader("Content-Type", "application/json")->withStatus(200)->write($res);
    // $data = [];
    // for($i = 1; $i < 11 ; $i++){
    //     $data[] = [ 'id' => $i, 'image_path' => 'http://placehold.jp/250x250.png?text='.$i.'req人数='.$seats_available.'だよ'];
    // }
    $res = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    // Render index view
    return $this->response->withHeader("Content-Type", "application/json")->withStatus(200)->write($res);
});

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
