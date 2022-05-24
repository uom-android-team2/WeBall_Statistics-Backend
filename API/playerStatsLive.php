<?php


include_once "../php/config.php";
include_once "models/playerStatsLive.php";

include "service/playerStatsLiveService.php";
include "utils/validation.php";

$mysqli->select_db("championship");
$playerService = new PlayerStatsLiveService("player_live_statistics", $mysqli);


if($_SERVER['REQUEST_METHOD'] == "GET"){
    $data = "";
    $id = "";
    if(isset($_GET["player_id"]) ){
        $id = test_input($_GET["player_id"]);
    }
    

    if($id){
        $data = $playerService->findPlayerById($id);
    }else{
        $data = $playerService->findAllPlayers();
    }
    
    header("Content-Type: application/json");
    echo json_encode($data);

}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){
    $data = "";
    $id = "";
    
    if(isset($_GET["player_id"]) ){
        $id = test_input($_GET["player_id"]);
    }

    if($id){
        $data = $playerService->deletePlayerById($id);
    }else{
        $data = $playerService->deleteAllPlayers();
    }
    
    header("Content-Type: application/json");
    echo json_encode($data);
    
}else if($_SERVER['REQUEST_METHOD'] == "POST"){

    $entityBody = file_get_contents('php://input');
    
    $playerProvided = json_decode($entityBody);

    $data = $playerService->updatePlayer($playerProvided);
    
    header("Content-Type: application/json");
    echo json_encode($data);

}

$mysqli->close();
?>