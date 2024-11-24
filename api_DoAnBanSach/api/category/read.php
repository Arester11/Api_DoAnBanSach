<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../model/category.php';

    $db = new db();
    $connect = $db->connect();

    $category = new Category($connect);
    $read = $category->read();

    $num = $read->rowCount();

    if($num > 0) {
        $category_arr = [];
        $category_arr['TheLoai'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $category_item = [
                'idTL' => $idTL,
                'tenTL' => $tenTL,
                'trangthai' => $trangthai
            ];
            array_push($category_arr['TheLoai'], $category_item);
        }
        echo json_encode($category_arr, JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['message' => 'No category found'], JSON_PRETTY_PRINT);
    }
?>