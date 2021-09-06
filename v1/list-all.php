<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once("../config/database.php");
include_once("../classes/student.php");

$db = new Database();
$connection = $db->connect();

$student = new Student($connection);

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $data = $student->getAllData();

    if($data->num_rows > 0){
        $students = [];
        while($row = $data->fetch_assoc()){
            array_push($students,[
                "id" => $row['id'],
                "name" => $row['name'],
                "email"=>$row['mobile']
            ]);
        }
        http_response_code(200);
        echo json_encode([
            "data" => $students
        ]);
    }else{
        echo json_encode([
            "message" => "No records found"
        ]);
    }
}else{
    http_response_code(503);
    echo json_encode([
        "message"=>"Access Denied"
    ]);
}

