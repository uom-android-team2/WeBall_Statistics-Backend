<?php

    include_once "../index/config.php";

    include "service/playerLiveStatisticsService.php";
    include "utils/validation.php";

    $mysqli->select_db("championship");

    $playerLiveStatisticsService = new PlayerLivestatisticsService("player_live_statistics", $mysqli);

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $data = "";


        $matchId = "";
        $playerId = "";
        
        if(isset($_GET["match_id"])){
            $matchId = test_input($_GET['match_id']);
        }

        if(isset($_GET["player_id"])){
            $playerId = test_input($_GET['player_id']);
        }

        // check if matchId and playerId are not "" WITH STRCMP
        if(strcmp($matchId, "") != 0 && strcmp($playerId, "") != 0){
            $data = $playerLiveStatisticsService->findByMatchAndPlayerId($matchId, $playerId);
        }else if(strcmp($matchId, "") != 0){
            $data = $playerLiveStatisticsService->findByMatchId($matchId);
        }else{
            $data = $playerLiveStatisticsService->findAllPlayerLiveStatistics();
        }
        
        header("Content-Type: application/json");
        echo json_encode($data);

    }else if($_SERVER['REQUEST_METHOD'] == "DELETE"){
        $data = "";
        $matchId = "";
        
        if(isset($_GET["matchId"]) ){
            $matchId = test_input($_GET["matchId"]);
        }

        if($matchId){
            $data = $playerLiveStatisticsService->deletePlayerLiveStatistics($matchId);
        }else{
            $data = $playerLiveStatisticsService->deleteAllPlayerLiveStatistics();
        }
        
        header("Content-Type: application/json");
        echo json_encode($data);
        
    }else if($_SERVER['REQUEST_METHOD'] == "PUT"){

        $entityBody = file_get_contents('php://input');
        
        $matchProvided = json_decode($entityBody);

        $data = $playerLiveStatisticsService->updatePlayerLiveStatistics($matchProvided);
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){

        $entityBody = file_get_contents('php://input');
        
        $matchProvided = json_decode($entityBody);

        $data = $playerLiveStatisticsService->savePlayerLiveStatistics($matchProvided);
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    $mysqli->close();
?>