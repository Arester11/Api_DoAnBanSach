<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../model/category.php';

    $db = new db();
    $connect = $db->connect();

    $category = new Category($connect);

    $data = json_decode(file_get_contents("php://input"));

    $category->idTL = $data->idTL;
    $category->tenTL = $data->tenTL;

    if($category->update()) {
        echo json_encode(['message' => 'Category updated'], JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['message' => 'Category not updated'], JSON_PRETTY_PRINT);
    }
?>