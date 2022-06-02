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

$mysqli->select_db("championship");

$sql = "CREATE TABLE IF NOT EXISTS championship.`team`(
    `id` int(12) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name`  VARCHAR(32) NOT NULL UNIQUE,
    `city`varchar(32) NOT NULL,
    `badge` VARCHAR(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ";

// execute statment
if($mysqli->query($sql) === true){
    // do nothing
}else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

// SQL query to create the "player" array
$sql = "CREATE TABLE IF NOT EXISTS championship.`player`(
    `id` int(12) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name`  VARCHAR(32) NOT NULL,
    `surname`  VARCHAR(32) NOT NULL,
    `number` int(2) UNSIGNED NOT NULL,
    `position`varchar(32) NOT NULL,
    `team` varchar(32) NOT NULL,
    `photo` VARCHAR(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ";

// execute statment
if($mysqli->query($sql) === true){
    // do nothing
}else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$sql = "CREATE TABLE IF NOT EXISTS championship.`match`(
    `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `teamlandlord_id`int(12) UNSIGNED NOT NULL,
    `teamguest_id`int(12) UNSIGNED NOT NULL,
    `date`date NOT NULL,
    `progress`BIT(1) NOT NULL,
    `completed`BIT(1) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ";

// execute statment
if($mysqli->query($sql) === true){
    // do nothing
}else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$sql = " CREATE TABLE IF NOT EXISTS championship.`player_championship_statistics`(
    `player_id` int UNSIGNED NOT NULL,
    `matches_played`int UNSIGNED NOT NULL,
    `successful_effort` int UNSIGNED NOT NULL,
    `total_effort` int UNSIGNED NOT NULL,
    `successful_freethrow`int UNSIGNED NOT NULL,
    `total_freethrow`int UNSIGNED NOT NULL,
    `successful_twopointer` int UNSIGNED NOT NULL,
    `total_twopointer` int UNSIGNED NOT NULL,
    `successful_threepointer` int UNSIGNED NOT NULL,
    `total_threepointer` int UNSIGNED NOT NULL,
    `steal` int UNSIGNED NOT NULL,
    `assist` int UNSIGNED NOT NULL,
    `block` int UNSIGNED NOT NULL,
    `rebound` int UNSIGNED NOT NULL,
    `foul` int UNSIGNED NOT NULL,
    `turnover`int UNSIGNED NOT NULL,
    `minutes`datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

// execute statment
if($mysqli->query($sql) === true){
    // do nothing
}else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$sql = "CREATE TABLE IF NOT EXISTS championship.`player_live_statistics`(
    `player_id` int UNSIGNED NOT NULL,
    `match_id` int UNSIGNED NOT NULL,
    `successful_effort` int UNSIGNED NOT NULL,
    `total_effort` int UNSIGNED NOT NULL,
    `successful_freethrow`int UNSIGNED NOT NULL,
    `total_freethrow`int UNSIGNED NOT NULL,
    `successful_twopointer` int UNSIGNED NOT NULL,
    `total_twopointer` int UNSIGNED NOT NULL,
    `successful_threepointer` int UNSIGNED NOT NULL,
    `total_threepointer` int UNSIGNED NOT NULL,
    `steal` int UNSIGNED NOT NULL,
    `assist` int UNSIGNED NOT NULL,
    `block` int UNSIGNED NOT NULL,
    `rebound` int UNSIGNED NOT NULL,
    `foul` int UNSIGNED NOT NULL,
    `turnover`int UNSIGNED NOT NULL,
    `minutes`datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

// execute statment
if($mysqli->query($sql) === true){
    // do nothing
}else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$sql = "CREATE TABLE IF NOT EXISTS  championship.`team_live_statistics`(
  `match_id` int(6) UNSIGNED NOT NULL,
  `team_id`int(12) UNSIGNED NOT NULL,
  `successful_effort` int UNSIGNED NOT NULL,
  `total_effort`int UNSIGNED NOT NULL,
  `successful_freethrow`int UNSIGNED NOT NULL,
  `total_freethrow` int UNSIGNED NOT NULL,
  `succesful_twopointer` int UNSIGNED NOT NULL,
  `total_twopointer` int UNSIGNED NOT NULL,
  `succesful_threepointer` int UNSIGNED NOT NULL,
  `total_threepointer` int UNSIGNED NOT NULL,
  `steal` int UNSIGNED NOT NULL,
  `assist` int UNSIGNED NOT NULL,
  `block` int UNSIGNED NOT NULL,
  `rebound` int UNSIGNED NOT NULL,
  `foul` int UNSIGNED NOT NULL,
  `turnover`int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

// execute statment
if($mysqli->query($sql) === true){
    // do nothing
}else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$sql = "CREATE TABLE IF NOT EXISTS championship.`team_championship_statistics`(
    `team_id` int(12) UNSIGNED NOT NULL,
    `total_matches`int(24) UNSIGNED NOT NULL,
    `win` int UNSIGNED NOT NULL,
    `lose` int UNSIGNED NOT NULL,
    `succesful_effort` int UNSIGNED NOT NULL,
    `total_effort` int UNSIGNED NOT NULL,
    `successful_freethrow`int UNSIGNED NOT NULL,
    `total_freethrow` int UNSIGNED NOT NULL,
    `succesful_twopointer` int UNSIGNED NOT NULL,
    `total_twopointer` int UNSIGNED NOT NULL,
    `succesful_threepointer` int UNSIGNED NOT NULL,
    `total_threepointer` int UNSIGNED NOT NULL,
    `steal` int UNSIGNED NOT NULL,
    `assist` int UNSIGNED NOT NULL,
    `block` int UNSIGNED NOT NULL,
    `rebound` int UNSIGNED NOT NULL,
    `foul` int UNSIGNED NOT NULL,
    `turnover`int UNSIGNED NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ";

// execute statment
if($mysqli->query($sql) === true){
    // do nothing
}else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$sql = "CREATE TABLE IF NOT EXISTS championship.`coach`(
    `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `teamid`int(12) NOT NULL,
    `firstname`varchar(32) NOT NULL,
    `surname`varchar(32) NOT NULL,
    `headcoach` BIT(1) NOT NULL,
    `image` VARCHAR(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ";

// execute statment
if($mysqli->query($sql) === true){
    // do nothing
}else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$sql = "CREATE TABLE IF NOT EXISTS championship.`referee`(
    `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `firstname`varchar(32) NOT NULL,
    `surname`varchar(32) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ";

// execute statment
if($mysqli->query($sql) === true){
    // do nothing
}else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}


// Close connection
$mysqli->close();
?>