<?php
    
    require_once "../index/config.php";
    include_once "models/coach.php";

    include "service/coachService.php";
    include "utils/validation.php";

    $mysqli->select_db("championship");
    $coachService = new CoachService("coach", $mysqli);

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $data = "";
        $id = "";
        if(isset($_GET["id"]) ){
            $id = test_input($_GET["id"]);
        }
        
        if($id){
            $data = $coachService->findCoachById($id);
        }else{
            $data = $coachService->findAllCoaches();
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
            $data = $coachService->deleteCoachById($id);
        }else{
            $data = $coachService->deleteAllCoaches();
        }
        
        header("Content-Type: application/json");
        echo json_encode($data);
        
    }else if($_SERVER['REQUEST_METHOD'] == "PUT"){

        $entityBody = file_get_contents('php://input');
        
        $coachProvided = json_decode($entityBody);

        $data = $coachService->updateCoach($coachProvided);
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){

        $entityBody = file_get_contents('php://input');
        
        $coachProvided = json_decode($entityBody);

        $data = $coachService->saveCoach($coachProvided);
        
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    $mysqli->close();
?>