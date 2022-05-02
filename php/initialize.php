<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$mysqli = new mysqli("localhost", "root", "");
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 
// Attempt create database query execution
$sql = "CREATE DATABASE IF NOT EXISTS user";

if($mysqli->query($sql) === true){
    // do nothing 
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$mysqli -> select_db("user");

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if($mysqli->query($sql) === true){
    // do nothing
}else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

// prepare statment for creating the championship database
$sql = "CREATE DATABASE IF NOT EXISTS championship";

// execute statment

if($mysqli->query($sql) === true){
    // do nothing
}else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

// Close connection
$mysqli->close();
?>