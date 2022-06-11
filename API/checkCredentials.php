<?php

 require_once "../index/config.php";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $password = $_POST['password'];


   $sql =  "SELECT `username`, `password` FROM `users` WHERE `username` = $username";

     $result = mysqli_query($mysqli, $sql);

    if ($row = mysqli_fetch_array($result)) { 

      $passwordHash = $row['password'];

     if(password_verify($password, $passwordHash)){
        echo 'true';
      }else{
         echo 'false';
      }

    }else{
       echo "false";
    }

   header("Content-Type: text/plane");
	
    
		
	}


?>