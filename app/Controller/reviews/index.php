<?php

use Model\Dao\Item;
use Slim\Http\Request;
use Slim\Http\Response;

use Model\Dao\Reviews;
use Slim\Http\UploadedFile;



$app->get('/tours/{tour_id}/reviews/new[/]', function (Request $request, Response $response, $args) {

    //ツアー参加者にわたされたレビュー書き込み用QRコードから入れる画面
    //実際はGETパラメータでツアー予約IDを持っていて、旅行代理店側と同様の顧客情報と紐付けられるようにする

    $data = [];
    $tour_id = $args["tour_id"];
    $data["reserving_id"] = $request->getQueryParams()["reserving_id"];

    if(intval($data["reserving_id"]) == 0){
        return $this->view->render($response->withStatus(400), 'error/404.twig', [
            "myMagic" => "Let's roll"
        ]);
    }

    $data["create_path"] = 'http://'.$this->request->getServerParams()["HTTP_HOST"].'/tours/'.$tour_id.'/reviews/create';
    // Render index view
    return $this->view->render($response, 'reviews/new.twig', $data);
});

$app->post('/tours/{tour_id}/reviews/create[/]', function (Request $request, Response $response, $args) {
    //送信されたレビューを受け取ってありがとうございましたと表示する
    $data = [];
    $tour_id = $args['tour_id'];
    $review = new Reviews($this->db);
    $new_review = $request->getParsedBody();
    $new_review['tour_id'] = $tour_id;
    $new_review["file"] = $request->getUploadedFiles()['file'];
    if($review->validate($new_review)){
        return $response->withRedirect('/tours/'.$tour_id.'/reviews/new');
    }


    // file upload
    $upload_directory = "/opt/intern/app/team-a/project/public/assets/img/uploads";

    $uploadedFile = $request->getUploadedFiles()['file'];
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);
    $uploadedFile->moveTo($upload_directory . DIRECTORY_SEPARATOR . $filename);

    // db insert and get last insert id
    $new_review['image_url'] = 'http://'. $this->request->getServerParams()["HTTP_HOST"].'/assets/img/uploads/'.$filename;
    unset($new_review['file']);
    // dd($new_review);
    $review->insert($new_review);
    //response
    return $this->view->render($response, 'reviews/create.twig', $data);
});



function moveUploadedFile($directory, UploadedFile $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}
