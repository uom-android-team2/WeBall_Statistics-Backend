<?php

require_once "initialize.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to the login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/style.css">
    <script defer src="dashboard-script.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <script type = "module" defer src="../Js/controller.js"></script>


</head>

<body>

    <div class="box">
        <div class="header-div">
            <header>
                <a href="http://www.esake.gr/" target="_blank">
                    <img src="img/esakeLogo..png">
                </a>
                <ul class="menu">
                    <li><a href="#about" class="show-popup">Manual</a></li>
                    <li><a href="logout.php">Log out</a>
                    <li>

                </ul>
            </header>
        </div>

        <div>
            <div class="header-user">
                <h1 class="my-5">Hi, <b> <?php echo htmlspecialchars($_SESSION["username"]); ?> </b>. Welcome to WeBall-Statistics admin dashboard.<h1></h1>
            </div>

            <p>
            <div class="buttons-championship">
                <a href = "create-team.php" class="buttons button-same">Create Teams</a>
                <a href = "create-player-page.php" class="buttons button-same">Create Players</a>
                <a href = "create-championship-page.php" class="buttons button-same">Create Championship</a>
                <a href = "create-random-championship-page.php" class="buttons button-same">Championship Lottery</a>
            </div>
            <div class="buttons-account-json">
                <button class="buttons button-password">Reset Your Password</button>
                <button id = "btn-load-data" class="buttons button-json">Load data from JSON</button>
            </div>
            </p>

            <div class="popup hidden">
                <button class="close-popup">&times;</button>
                <h2 class="popup-header">instructions</h2>
                <p>
                <div class="popup-list">
                    <li>If you are loged in for the first time Create Teams</li>
                    <li>When you have already created teams is time to Create Players manually or create player
                        from button json</li>
                    <li>When you have already created players Create Championship manually or randomlly</li>
                </div>


                </p>
            </div>
            <div class="overlay hidden"></div>



        </div>
    </div>



</body>