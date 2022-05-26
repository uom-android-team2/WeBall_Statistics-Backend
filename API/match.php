<?php

    include_once "../php/config.php";
    include_once "models/match.php";

    include "service/matchService.php";
    include "utils/validation.php";

    $mysqli->select_db("championship");
    $matchService = new MatchService("match", $mysqli);

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $data = "";
        $id = "";
        $live = "";
        $completed = "";
        $upcoming = "";

        if(isset($_GET["id"]) ){
            $id = test_input($_GET["id"]);
        }

        if(isset($_GET["live"]) ){
            $live = test_input($_GET["live"]);
        }

        if(isset($_GET["completed"]) ){
            $completed = test_input($_GET["completed"]);
        }

        if(isset($_GET["upcoming"]) ){
            $upcoming = test_input($_GET["upcoming"]);
        }
        
        if($id){
            $data = $matchService->findMatchById($id);
        }else{
            $data = $matchService->findAllMatches();
        }

        if(strcmp($live, "true") === 0){
            $data = $matchService->findLiveMatches();
        }

        if(strcmp($completed, "true") === 0){
            $data = $matchService->findCompletedMatches();
        }
        if(strcmp($upcoming, "true") === 0){
            $data = $matchService->findUpComingMatches();
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
            $data = $matchService->deleteMatchById($id);
        }else{
            $data = $matchService->deleteAllMatches();
        }
        
        header("Content-Type: application/json");
        echo json_encode($data);
        
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){

        $entityBody = file_get_contents('php://input');
        
        $matchProvided = json_decode($entityBody);

        $data = $matchService->updateMatch($matchProvided);
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    $mysqli->close();
?>