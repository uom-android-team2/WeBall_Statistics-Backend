<?php
  // Initialize the session
  session_start();
  
  // Check if the user is logged in, if not then redirect him to the login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  require_once "config.php";
  require_once "../API/models/playerStatisticsCompleted.php";
  $mysqli->select_db("championship");

  // initialize values
  $name = $surname = $number = $position = $team = "";
  // initialize error messages
  $name_error = $surname_error = $number_error = $position_error = $team_error = "";
  $file_error = "";


  $filename = "";
    $tempname = "";	
    $folder = "../resources/player_images/";

  $no_teams_text = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["playerName"]))){
        $name_error = "Name is required";
    }else{
        $name = $_POST["playerName"];
    }

    if(empty(trim($_POST["playerSurname"]))){
        $surname_error = "Surname is required";
    }else{
        $surname = $_POST["playerSurname"];
    }

    if(empty(trim($_POST["playerNumber"]))){
      $number_error = "Player number is required";
    }else{
      $number = $_POST["playerNumber"];
    }
    
    if(empty(trim($_POST["position"])) || $_POST["position"] == "select"){
        $position_error = "Player position is required";
    }else{
        $position = $_POST["position"];
    }

    if(empty(trim($_POST["team"])) || $_POST["team"] == "select"){
        $team_error = "Player team is required";
    }else{
        $team = $_POST["team"];
    }

    if(empty($_FILES["playerPhoto"]["name"])){
      $file_error = "File is required";
    }else{
      $filename = $_FILES["playerPhoto"]["name"];
    }

    
    if(empty($tempname = $_FILES["playerPhoto"]["tmp_name"])){
      $file_err = "File is required";
    }else{
      $tempname = $_FILES["playerPhoto"]["tmp_name"];	
    }

    if(empty($name_error) && empty($surname_error) && empty($number_error) && empty($position_error) && empty($team_error) && empty($file_error)){
      // Attempt insert query execution
      $sql = "INSERT INTO player (name, surname, number, position, team, photo) VALUES ('$name', '$surname', '$number', '$position', '$team', '$filename')";
        
      try {
          $mysqli->query($sql);
          // Move the uploaded image into the folder: image
          $stored = move_uploaded_file($tempname, $folder.$filename);
          $res = file_get_contents("http://localhost/WeBall_Statistics-Backend/API/player.php?name=$name");
        
          $object = json_decode($res);
          // API URL

          echo $object->id;

          $url = "http://localhost/WeBall_Statistics-Backend/API/playerStatisticsCompleted.php";
          // Create a new cURL resource
          $ch = curl_init($url);

          $playerStats = new PlayerStatisticsCompleted($object->id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, $mysqli);

          $payload = json_encode($playerStats);
          
          // Attach encoded JSON string to the POST fields
          curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

          // Set the content type to application/json
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

          // Return response instead of outputting
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

          // Execute the POST request
          $result = curl_exec($ch);

          // Close cURL resource
          curl_close($ch);

          if (!$stored) {
            echo "ERROR: Could not able to store the image";
          }
      } catch (\Throwable $th) {
        if($mysqli->errno == 1062){
          $name_err = "* Error: Player ".$name." already exists";
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Players</title>
    <link rel="icon" type="image/x-icon" href="/photos/favicon.ico">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../style/css/create-player-page.css">
    <script 
        defer 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
        crossorigin="anonymous">
    </script>
  </head>
  <body>
    <header>
        <div id="container">
            <a id="back" href="dashboard.php" class="btn btn-info">Back</a>
            <h1 id="title">Add new player to the championship</h1>
        </div>
        <!--<h5 id="teams-message">No teams available to add players</h5> --> <!-- class="message-hidden" -->
    </header>
    <section>
      <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="table-responsive">
        <table class="table">
            <thead>
                <tr class="table-active">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Number</th>
                    <th scope="col">Position</th>
                    <th scope="col">Team</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Submit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>
                        <input type="text" name="playerName" placeholder="Enter name..." />
                    </td>
                    <td>
                        <input type="text" name="playerSurname" placeholder="Enter surname..." />
                    </td>
                    <td>
                        <input type="number" name="playerNumber" min="0" max="99"/>
                    </td>
                    <td>
                        <select name="position" class="select-form">
                            <option value="select">Select Position</option>
                            <option value="Point guard">Point guard</option>
                            <option value="Shooting guard">Shooting guard</option>
                            <option value="Small forward">Small forward</option>
                            <option value="Power forward">Power forward</option>
                            <option value="Center">Center</option>
                        </select>
                    </td>
                    <td>
                        <select name="team" class="select-form">
                            <option value="select">Select Team</option>
                            <?php 
                                $sql = "SELECT * FROM team";
                                if($result = $mysqli->query($sql)){
                                    while($row = $result->fetch_array()){
                                        echo "<option value='$row[name]'>$row[name]</option>";
                                    }
                                    $result->free();
                                } else{
                                    echo "<h3> Error retrieving data from databse</h3>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="file" name="playerPhoto" id="badge" />
                        </td>
                    <td>
                        <input
                        class="btn btn-primary"
                        id="submit-button"
                        type="submit"
                        name="submit"
                        value="Submit"
                        />
                    </td>
                </tr>
            </tbody>
        </table>
      </form>
    </section>
    <?php
      if($name_error != ""){
        echo 
        "<div class='alert alert-danger text-center' role='alert'>
              $name_error
        </div>";
      }
      if($surname_error != ""){
        echo 
        "<div class='alert alert-danger text-center' role='alert'>
              $surname_error
        </div>";
      }
      if($number_error != ""){
        echo 
        "<div class='alert alert-danger text-center' role='alert'>
              $number_error
        </div>";
      }
      if($position_error != ""){
        echo 
        "<div class='alert alert-danger text-center' role='alert'>
              $position_error
        </div>";
      }
      if($team_error != ""){
        echo 
        "<div class='alert alert-danger text-center' role='alert'>
              $team_error
        </div>";
      }
      if($file_error != ""){
        echo 
        "<div class='alert alert-danger text-center' role='alert'>
              $file_error
        </div>";
      }
    ?>
    <hr />
    <section class="table-responsive" id="database">
        <h2 class="h2-display">Players in the database</h2>
        <div class="btn-group">
            <button class="btn btn-secondary btn-sm dropdown-toggle custom-button-css" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sort by
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-item">ID</li>
                <li class="dropdown-item">Name</li>
                <li class="dropdown-item">Team</li>
                <li class="dropdown-item">Position</li>
            </ul>
        </div>
        <table class="table">
            <thead>
                <tr class="table-active">
                    <th scope="col">#</th>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Number</th>
                    <th scope="col">Position</th>
                    <th scope="col">Team</th>
                    <th scope="col">Photo</th>
                </tr>
            </thead>
            <tbody class="table-info">
                <?php
                    $sql = "SELECT * FROM player";
                    if($result = $mysqli->query($sql)){
                        $index = 0;
                        while($row = $result->fetch_array()){
                            echo "<tr>";
                            echo "<th scope='row'>$index</th>";
                            echo "<td>$row[id]</td>";
                            echo "<td>$row[name]</td>";
                            echo "<td>$row[surname]</td>";
                            echo "<td>$row[number]</td>";
                            echo "<td>$row[position]</td>";
                            echo "<td>$row[team]</td>";
                            echo "<td>";
                                echo "<img
                                class='img'
                                src='$folder/$row[photo]'
                                alt='image'
                                />";
                            echo "</td>";
                            echo "</tr>";
                            $index = $index + 1;
                        }
                        if($result->num_rows < 1){
                            $no_teams_text = "There are no players in the database";
                        }
                        $result->free();
                    } else{
                        echo "<h3> Error retrieving data from databse</h3>";
                    }
                ?>
            </tbody>
        </table>
        <h3 class="text-danger" style="text-align: center;"><?php echo $no_teams_text; ?></h3>
    </section>
  </body>
</html>