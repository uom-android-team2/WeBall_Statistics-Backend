<?php

    include_once "../php/config.php";
    include "service/teamStatisticsCompletedService.php";
    include "utils/validation.php";

    $mysqli->select_db("championship");
    $teamCompletedStatsService = new TeamStatisticsCompletedService("team_championship_statistics", $mysqli);
        
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $data = "";
        $id = "";
        if(isset($_GET["id"]) ){
            $id = test_input($_GET["id"]);
        }
        
        if($id){
            $data = $teamCompletedStatsService->findTeamCompletedStatsByTeamId($id);
        }else{
            $data = $teamCompletedStatsService->findAllTeamCompletedStats();
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
            $data = $teamCompletedStatsService->deleteTeamCompletedStatsById($id);
        }else{
            $data = $teamCompletedStatsService->deleteAllTeamCompletedStats();
        }
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $entityBody = file_get_contents('php://input');
        
        $teamStatsProvided = json_decode($entityBody);

        $data = $teamCompletedStatsService->updateTeamCompletedStats($teamStatsProvided);
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    $mysqli->close();

?>
