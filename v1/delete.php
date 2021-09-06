<?php
ini_set("display_errors", 1);
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once("../config/database.php");
include_once("../classes/student.php");

$db = new Database();
$connection = $db->connect();

$student = new Student($connection);


if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";

    if(!empty($id)){
        $student->id = $id;
        $deleteStudent = $student->deleteStudent();

        if(!empty($deleteStudent)){
            http_response_code(200);
            echo json_encode([
                "message" => "Deleted Successfully"
            ]);
        }else{
            http_response_code(500);
            echo json_encode([
                "message" => "Failed to delete student"
            ]);
        }
    }
}else{
    http_response_code(503);
    echo json_encode([
        "message"=>"Access Denied"
    ]);
}


//http://127.0.0.1:8009/v1/delete.php?id=2