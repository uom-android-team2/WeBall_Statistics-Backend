<?php

    include_once "../index/config.php";

    include "service/teamLiveStatisticsService.php";
    include "utils/validation.php";

    $mysqli->select_db("championship");

    $teamLiveStatisticsService = new TeamLivestatisticsService("team_live_statistics", $mysqli);

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $data = "";


        $matchId = "";
        $teamId = "";
        
        if(isset($_GET["match_id"])){
            $matchId = test_input($_GET['match_id']);
        }

        if(isset($_GET["team_id"])){
            $teamId = test_input($_GET['team_id']);
        }

        // check if matchId and teamId are not "" WITH STRCMP
        if(strcmp($matchId, "") != 0 && strcmp($teamId, "") != 0){
            $data = $teamLiveStatisticsService->findByMatchIdAndTeamId($matchId, $teamId);
        }else{
            $data = $teamLiveStatisticsService->findAllTeamLiveStatistics();
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
            $data = $teamLiveStatisticsService->deleteByMatchId($matchId);
        }else{
            $data = $teamLiveStatisticsService->deleteAll();
        }
        
        header("Content-Type: application/json");
        echo json_encode($data);
        
    }else if($_SERVER['REQUEST_METHOD'] == "PUT"){

        $entityBody = file_get_contents('php://input');
        
        $matchProvided = json_decode($entityBody);

        $data = $teamLiveStatisticsService->updateTeamLiveStatistics($matchProvided);
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){

        $entityBody = file_get_contents('php://input');
        
        $matchProvided = json_decode($entityBody);

        $data = $teamLiveStatisticsService->saveTeamLiveStatistics($matchProvided);
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    $mysqli->close();
?>