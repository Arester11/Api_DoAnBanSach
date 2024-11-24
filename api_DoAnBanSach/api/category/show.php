<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../model/category.php';

    $db = new db();
    $connect = $db->connect();

    $category = new Category($connect);
    $category->idTL = isset($_GET['idTL']) ? $_GET['idTL'] : die();
    $category->show();

    $category_item = array(
        'idTL' => $category->idTL,
        'tenTL' => $category->tenTL,
        'trangthai' => $category->trangthai
    );
    print_r(json_encode($category_item, JSON_PRETTY_PRINT));
?>