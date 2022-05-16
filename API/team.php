<?php

include_once "../php/config.php";
include_once "../php/models/team.php";

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$data = array();
$id = "";

if(isset($_GET["id"]) ){
    $id = test_input($_GET["id"]);
}

$mysqli->select_db("championship");


if($id != null){
    $sql = "SELECT * FROM `team` WHERE `id` = $id";
}else{
    $sql = "SELECT * FROM `team`";
}

// execute statment
try {

    $result = $mysqli->query($sql);
    //Check if data exists
    if ($result->num_rows > 0) {
        if($id){
            $row = $result->fetch_assoc();
            $team = new team($row["id"], $row["name"], $row["city"], $row["badge"]);
            $data = $team;
        }else{
            while($row = $result->fetch_assoc()) {
                $team = new team($row["id"], $row["name"], $row["city"], $row["badge"]);
                array_push($data, $team);
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
