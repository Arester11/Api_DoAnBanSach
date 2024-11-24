<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../model/discount.php';

    $db = new db();
    $connect = $db->connect();

    $discount = new Discount($connect);
    $read = $discount->read();

    $num = $read->rowCount();

    if($num > 0) {
        $discount_arr = [];
        $discount_arr['Magiamgia'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $discount_item = [
                'idMGG' => $idMGG,
                'phantram' => $phantram,
                'ngaybatdau' => $ngaybatdau,
                'ngayketthuc' => $ngayketthuc,
                'trangthai' => $trangthai
            ];
            array_push($discount_arr['Magiamgia'], $discount_item);
        }
        echo json_encode($discount_arr, JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['message' => 'No discount found'], JSON_PRETTY_PRINT);
    }
?>