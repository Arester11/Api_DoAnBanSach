<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../model/discount.php';

    $db = new db();
    $connect = $db->connect();

    $discount = new Discount($connect);

    $data = json_decode(file_get_contents("php://input"));

    $discount->idMGG = $data->idMGG;

    if($discount->delete()) {
        echo json_encode(['message' => 'Discount deleted'], JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['message' => 'Discount not deleted'], JSON_PRETTY_PRINT);
    }
?>