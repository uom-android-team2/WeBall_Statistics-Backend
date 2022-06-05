<?php

 require_once "../php/config.php";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql =  "SELECT `username`, `password` FROM `users` WHERE `username` = $username AND `password` = $password";

    $result = mysqli_query($mysqli, $sql);


    if ($row = mysqli_fetch_array($result)) { 
      
      echo "true";
       
    }else{
       echo "false";
    }

   header("Content-Type: text/plane");
	
    
		
	}


?>