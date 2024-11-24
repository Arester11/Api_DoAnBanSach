<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../model/category.php';
    
    $db = new db();
    $connect = $db->connect();

    $category = new Category($connect);

    $data = json_decode(file_get_contents("php://input"));

    $category->idTL = $data->idTL;

    if($category->delete()) {
        echo json_encode(['message' => 'Category deleted'], JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['message' => 'Category not deleted'], JSON_PRETTY_PRINT);
    }
?>
