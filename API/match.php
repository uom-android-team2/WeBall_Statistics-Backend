<?php

include_once "../php/config.php";
include_once "../php/models/match.php";

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
    $sql = "SELECT * FROM `match` WHERE `id` = $id";
}else{
    $sql = "SELECT * FROM `match`";
}

try {

    $result = $mysqli->query($sql);
    //Check if data exists
    if ($result->num_rows > 0) {

        if($id){
            $row = $result->fetch_assoc();
            $match = new BasketballMatch($row["id"], $row["teamlandlord_id"], $row["teamguest_id"], $row["date"], $row["progress"], $row["completed"], $mysqli);
            $data = $match;
        }else{
            while($row = $result->fetch_assoc()) {
                $match = new BasketballMatch($row["id"], $row["teamlandlord_id"], $row["teamguest_id"], $row["date"], $row["progress"], $row["completed"], $mysqli);
                array_push($data, $match);
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