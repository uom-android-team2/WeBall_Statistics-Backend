<?php
    // Todo:  to complete this file 
    // this file is an expiriemnt
    require_once "config.php";

    // select correct database
    $mysqli -> select_db("championship");

    // prepare statment
    $sql = "CREATE TABLE IF NOT EXISTS team (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        teamName VARCHAR(50) NOT NULL UNIQUE,
        city VARCHAR(50) NOT NULL,
        imageUrl VARCHAR(255) NOT NULL
    );";

    // execute statment
    if($mysqli->query($sql) === true){
        // do nothing
    }else{
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;   
    }
    
    $mysqli->close();
?>