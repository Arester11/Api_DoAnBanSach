<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../model/discount.php';

    $db = new db();
    $connect = $db->connect();

    $discount = new Discount($connect);

    $data = json_decode(file_get_contents("php://input"));

    $discount->idMGG = $data->idMGG;
    $discount->phantram = $data->phantram;
    $discount->ngaybatdau = $data->ngaybatdau;
    $discount->ngayketthuc = $data->ngayketthuc;

    if($discount->update()) {
        echo json_encode(['message' => 'Discount updated'], JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['message' => 'Discount not updated'], JSON_PRETTY_PRINT);
    }
?>