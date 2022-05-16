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

$mysqli->select_db("championship");

$id = test_input($_GET["id"]);

if($id != null){
    $sql = "SELECT * FROM `team` WHERE `id` = $id";
}else{
    $sql = "SELECT * FROM `team`";
}

// execute statment
try {

    $result = $mysqli->query($sql) ;
    while($row = $result->fetch_assoc()) {
        $team = new team($row["id"], $row["name"], $row["city"], $row["badge"]);
        array_push($data, $team);
    }
    
    header("Content-Type: application/json");
	echo json_encode($data);

} catch (\Throwable $th) {
    echo $mysqli->error;
}


// }else{
//     echo "ERROR: Could not able to execute $sql. ". $mysqli->error;
// }
$mysqli->close();
?>
