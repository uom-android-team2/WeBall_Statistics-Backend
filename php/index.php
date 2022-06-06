<?php

require_once "initialize.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to the login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <script type="module" src="../Js/controller.js"></script>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to WeBall-Statistics admin dashboard.</h1>
    <p>
        <a href="create-team.php" class="btn btn-success">Δημιουργία Ομάδων</a>
        <a href="create-player-page.php" class="btn btn-success">Δημιουργία παικτών </a>
        <a href="create-championship-page.php" class="btn btn-success">Δημιουργία Πρωταθλήματος</a>
        <a href="create-random-championship-page.php" class="btn btn-success">Κλήρωση Πρωταθλήματος</a>
        <br>
        <br>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        <br>
        <br>
        <a class="btn btn-success" id="btn-load-data" title="Generate teams and players for DB, easy, from JSON">Load data from JSON</a>
    </p>
</body>
</html>