<?php

include_once "../php/config.php";
include_once "../php/models/referee.php";

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
    $sql = "SELECT * FROM `referee` WHERE `id` = $id";
}else{
    $sql = "SELECT * FROM `referee`";
}

// execute statment
try {

    $result = $mysqli->query($sql);
    //Check if data exists
    if ($result->num_rows > 0) {
        if($id){
            $row = $result->fetch_assoc();
            $referee = new Referee($row["id"], $row["firstname"], $row["surname"]);
            $data = $referee;
        }else{
            while($row = $result->fetch_assoc()) {
                $referee = new Referee($row["id"], $row["firstname"], $row["surname"]);
                array_push($data, $referee);
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