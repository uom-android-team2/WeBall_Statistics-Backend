<?php
	$data = array();

	$host="localhost";
	$uname="root";
	$pass="";
	$dbname="championship";
	
	$dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
	mysqli_select_db($dbh, $dbname);
			
	$sql = "SELECT * FROM `match`";
	$result = mysqli_query($dbh, $sql);
	$i = 0;
	while ($row = mysqli_fetch_array($result)) { 
		$data[$i] = $row['grouped_models'];
		$i = $i + 1;
	}

	// header("Content-Type: application/json");
	// echo json_encode($data);
	// mysqli_close($dbh);
?>