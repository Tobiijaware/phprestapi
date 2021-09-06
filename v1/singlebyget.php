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

//http://127.0.0.1:8009/v1/singlebyget.php?id=2
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $id = isset($_GET['id']) ? intval($_GET['id']) : "";

    if(!empty($id)){
        $student->id = $id;
        $student_data = $student->getSingle();

        if(!empty($student_data)){
            http_response_code(200);
            echo json_encode([
                "message" => $student_data
            ]);
        }else{
            http_response_code(404);
            echo json_encode([
                "message" => "No records found"
            ]);
        }
    }
}else{
    http_response_code(503);
    echo json_encode([
        "message"=>"Access Denied"
    ]);
}

