<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../model/discount.php';

    $db = new db();
    $connect = $db->connect();

    $discount = new Discount($connect);
    $discount->idMGG = isset($_GET['idMGG']) ? $_GET['idMGG'] : die();
    $discount->show();

    $discount_item = array(
        'idMGG' => $discount->idMGG,
        'phantram' => $discount->phantram,
        'ngaybatdau' => $discount->ngaybatdau,
        'ngayketthuc' => $discount->ngayketthuc,
        'trangthai' => $discount->trangthai
    );
    print_r(json_encode($discount_item, JSON_PRETTY_PRINT));
?>
