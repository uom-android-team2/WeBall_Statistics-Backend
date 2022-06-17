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
                <h1 class="my-5">Hi, <b> <?php echo htmlspecialchars($_SESSION["username"]); ?> </b>.Welcome to the WeBall-Statistics admin dashboard.<h1></h1>
            </div>

            <p>
            <div class="buttons-championship">
                <a href = "create-team.php" class="buttons button-same">Create Teams</a>
                <a href = "create-player-page.php" class="buttons button-same">Create Players</a>
                <a href = "create-championship-page.php" class="buttons button-same">Create Championship</a>
                <a href = "create-random-championship-page.php" class="buttons button-same">Championship Lottery</a>
            </div>
            <div class="buttons-account-json">
                <a href = "reset-password.php" class="buttons button-password">Reset Your Password</a>
                <button id = "btn-load-data" class="buttons button-json">Load data from JSON</button>
            </div>
            </p>

            <div class="popup hidden">
                <button class="close-popup">&times;</button>
                <h1 class="popup-header">Instructions</h1>
                <p>
                <div class="popup-list">
                    <h3>Want to know how to use the WeBall Statistics App correctly?</h3>
                    <h5>Follow these steps in order.</h5><br>
                    <ul>
                        <li><span style="font-weight:bold;">Step 1: </span>Create Teams manually through the "Create Teams" button <span style="font-weight:bold;">OR</span> through the "Load data from JSON" button which creates Teams <span style="font-weight:bold;">AND</span> Players instantlly from a file we created!
                     </li><br>
                     <li><span style="font-weight:bold;">Step 2: </span>Create Players manually through the "Create Players" button. <span style="font-weight:bold; font-size:small;">Skip this step if you loaded data from JSON in Step 1.</span>
                     </li><br>
                     <li><span style="font-weight:bold;">Step 3: </span>Create the Championship manually through the "Create Championship" button which gives you the opportunity to manually arrange Matches between Teams <span style="font-weight:bold;">OR</span> create the championship randomly with a click of a button though the "Championship Lottery" button.
                     </li><br>
                     <li><span style="font-weight:bold;">Step 4: </span>Open the WeBall Statistics App on your android and enjoy!
                     </li>
                    </ul> 
                </div>


                </p>
            </div>
            <div class="overlay hidden"></div>



        </div>
    </div>



</body>