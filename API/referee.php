<?php

include_once "../php/config.php";
include_once "models/referee.php";
include_once "service/refereeService.php";
include_once "utils/validation.php";

$mysqli->select_db("championship");
$refereeService = new RefereeService("referee", $mysqli);

if($_SERVER['REQUEST_METHOD'] == "GET"){

    $data = "";
    $id = "";
    if(isset($_GET["id"]) ){
        $id = test_input($_GET["id"]);
    }
    

    if($id){
        $data = $refereeService->findRefereeById($id);
    }else{
        $data = $refereeService->findAllReferees();
    }
    
    header("Content-Type: application/json");
    echo json_encode($data);

}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){
    $data = "";
    $id = "";
    
    if(isset($_GET["id"]) ){
        $id = test_input($_GET["id"]);
    }

    if($id){
        $data = $refereeService->deleteRefereeById($id);
    }else{
        $data = $refereeService->deleteAllReferees();
    }
    
    header("Content-Type: application/json");
    echo json_encode($data);
    
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $entityBody = file_get_contents('php://input');
    
    $refereeProvided = json_decode($entityBody);

    $data = $refereeService->updateReferee($refereeProvided);
    
    header("Content-Type: application/json");
    echo json_encode($data);
}




$mysqli->close();
?>