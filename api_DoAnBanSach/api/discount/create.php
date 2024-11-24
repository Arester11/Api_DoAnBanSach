<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../model/discount.php';

    $db = new db();
    $connect = $db->connect();

    $discount = new Discount($connect);

    $data = json_decode(file_get_contents("php://input"));

    $discount->phantram = $data->phantram;
    $discount->ngaybatdau = $data->ngaybatdau;
    $discount->ngayketthuc = $data->ngayketthuc;

    if($discount->create()) {
        echo json_encode(['message' => 'Discount created'], JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['message' => 'Discount not created'], JSON_PRETTY_PRINT);
    }
?>