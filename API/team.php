<?php

    include_once "../index/config.php";
    include "service/teamService.php";
    include "utils/validation.php";

    $mysqli->select_db("championship");
    $teamService = new TeamService("team", $mysqli);
        
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $data = "";
        $id = "";
        $name = "";

        if(isset($_GET["name"])){
            $name = test_input($_GET["name"]);
        }
        

        if(isset($_GET["id"]) ){
            $id = test_input($_GET["id"]);
        }
        

        if($id){
            $data = $teamService->findTeamById($id);
        }else if($name){
            $data = $teamService->findTeamByName($name);
        }else{
            $data = $teamService->findAllTeams();
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
            $data = $teamService->deleteTeamById($id);
        }else{
            $data = $teamService->deleteAllTeams();
        }
        
        header("Content-Type: application/json");
        echo json_encode($data);
        
    }else if($_SERVER['REQUEST_METHOD'] == "PUT"){
        
        $entityBody = file_get_contents('php://input');
        
        $teamProvided = json_decode($entityBody);

        $data = $teamService->updateTeam($teamProvided);
        
        header("Content-Type: application/json");
        echo json_encode($data);
        
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $entityBody = file_get_contents('php://input');
        
        $teamProvided = json_decode($entityBody);

        $data = $teamService->saveTeam($teamProvided);
        
        header("Content-Type: application/json");
        echo json_encode($data);
        
    }

    $mysqli->close();
?>
