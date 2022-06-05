<?php


include_once "../php/config.php";
include_once "models/player.php";

include "service/playerService.php";
include "utils/validation.php";

$mysqli->select_db("championship");
$playerService = new PlayerService("player", $mysqli);


if($_SERVER['REQUEST_METHOD'] == "GET"){
    $data = "";
    $id = "";
    $teamName = "";

    if(isset($_GET["id"]) ){
        $id = test_input($_GET["id"]);
    }
    if(isset($_GET["team"]) ){
        $teamName = test_input($_GET["team"]);
    }
    

    if($id){
        $data = $playerService->findPlayerById($id);
    }else if($teamName){
        $data = $playerService->findByTeamName($teamName);
    }else{
        $data = $playerService->findAllPlayers();
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
        $data = $playerService->deletePlayerById($id);
    }else{
        $data = $playerService->deleteAllPlayers();
    }
    
    header("Content-Type: application/json");
    echo json_encode($data);
    
}else if($_SERVER['REQUEST_METHOD'] == "PUT"){

    $entityBody = file_get_contents('php://input');
    
    $playerProvided = json_decode($entityBody);

    $data = $playerService->updatePlayer($playerProvided);
    
    header("Content-Type: application/json");
    echo json_encode($data);

}else if($_SERVER['REQUEST_METHOD'] == "POST"){

    $entityBody = file_get_contents('php://input');
    
    $playerProvided = json_decode($entityBody);

    $data = $playerService->savePlayer($playerProvided);
    
    header("Content-Type: application/json");
    echo json_encode($data);

}

$mysqli->close();
?>