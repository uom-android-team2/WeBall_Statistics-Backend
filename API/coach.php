<?php

include_once "../php/config.php";
include_once "../php/models/coach.php";

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$data = array();

$id = "";

if(isset($_GET["id"])){
    $id = test_input($_GET["id"]);
}

$mysqli->select_db("championship");

if($id != null){
    $sql = "SELECT * FROM `coach` WHERE `id` = $id";
}else{
    $sql = "SELECT * FROM `coach`";
}

try {

    $result = $mysqli->query($sql);
    //Check if data exists
    if ($result->num_rows > 0) {

        if($id){
            $row = $result->fetch_assoc();
            $player = new Coach($row["id"], $row["teamid"], $row["firstname"], $row["surname"], $row["headcoach"], $row["image"], $mysqli);
            $data = $player;
        }else{
            while($row = $result->fetch_assoc()) {
                $player = new Coach($row["id"], $row["teamid"], $row["firstname"], $row["surname"], $row["headcoach"], $row["image"], $mysqli);
                array_push($data, $player);
            }
        }
    }
        
    header("Content-Type: application/json");
    echo json_encode($data);

} catch (\Throwable $th) {
    echo $mysqli->error;
}


$mysqli->close();
?>