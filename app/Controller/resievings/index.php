<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/tours/{tour_id}/resieving[/]', function (Request $request, Response $response) {

    $data = [];
    $resieving = $args["tour_id"];

    // Render index view
    return $this->view->render($response, 'resievings/qr.twig', $data);
});

$app->get('/tours/{tour_id}/resieving/edit[/]', function (Request $request, Response $response) {

    $data = [];
    $resieving = $args["tour_id"];

    // Render index view
    return $this->view->render($response, 'resievings/edit.twig', $data);
});

$app->post('tours/{tour_id}/reserving/update[/]', function (Request $request, Response $response) {

    $data = [];
    $resieving = $args["tour_id"];

    // Render index view
    return $this->view->render($response, 'resievings/completed.twig', $data);
});