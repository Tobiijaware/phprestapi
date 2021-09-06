<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once("../config/database.php");
include_once("../classes/student.php");

$db = new Database();
$connection = $db->connect();

$student = new Student($connection);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = json_decode(file_get_contents("php://input"));

    $student->name = $data->name;
    $student->email = $data->email;
    $student->mobile = $data->mobile;

    if(!empty($data->name) && !empty($data->email) && !empty($data->mobile)){
        if($student->createData()){
            http_response_code(200);
            echo json_encode([
                "message" => "Student has been created"
            ]);
        }else{
            echo json_encode([
                "message" => "Failed to insert"
            ]);
        }
    }else{
        http_response_code(500);
        echo json_encode([
            "message" => "Fields cannot be empty"
        ]);
    }

}else{
    http_response_code(503);
    echo json_encode([
        "message" => "Access Denied"
    ]);
}
