<?php

    include_once "../index/config.php";
    include "service/playerStatisticsCompletedService.php";
    include "utils/validation.php";

    $mysqli->select_db("championship");
    $playerCompletedStatsService = new PlayerStatisticsCompletedService("player_championship_statistics", $mysqli);
        
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $data = "";
        $player_id = "";
        if(isset($_GET["player_id"]) ){
            $player_id = test_input($_GET["player_id"]);
        }
        
        if($player_id){
            $data = $playerCompletedStatsService->findPlayerCompletedStatsByPlayerId($player_id);
        }else{
            $data = $playerCompletedStatsService->findAllPlayerCompletedStats();
        }
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }else if($_SERVER['REQUEST_METHOD'] == "DELETE"){
        $data = "";
        $player_id = "";
        
        if(isset($_GET["player_id"]) ){
            $player_id = test_input($_GET["player_id"]);
        }

        if($player_id){
            $data = $playerCompletedStatsService->deletePlayerCompletedStatsById($player_id);
        }else{
            $data = $playerCompletedStatsService->deleteAllPlayerCompletedStats();
        }
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }else if($_SERVER['REQUEST_METHOD'] == "PUT"){
        
        $entityBody = file_get_contents('php://input');
        
        $playerStatsProvided = json_decode($entityBody);

        $data = $playerCompletedStatsService->updatePlayerCompletedStats($playerStatsProvided);
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $entityBody = file_get_contents('php://input');
        
        $playerStatsProvided = json_decode($entityBody);

        $data = $playerCompletedStatsService->savePlayerCompletedStats($playerStatsProvided);
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    $mysqli->close();

?>
