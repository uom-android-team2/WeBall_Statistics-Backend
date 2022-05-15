<?php
	$data = array();

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "championship";
	
	$dbh = mysqli_connect($servername, $username, $password) or die("cannot connect");
	mysqli_select_db($dbh, $dbname);
			
	$sql = "SELECT * FROM ";
	$result = mysqli_query($dbh, $sql);
	while ($row = mysqli_fetch_array($result)) { 
		$data[$row['brand']] = $row['grouped_models'];
	}

	header("Content-Type: application/json");
	echo json_encode($data);
	mysqli_close($dbh);
?>