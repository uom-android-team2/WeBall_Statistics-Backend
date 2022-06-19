<?php
  // Initialize the session
  session_start();
  
  // Check if the user is logged in, if not then redirect him to the login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  require_once "../API/models/teamStatisticsCompleted.php";
  require_once "config.php";
  $mysqli->select_db("championship");

  $name  = $city = "";
  $name_err = $city_err = "";
  $file_err = "";


  $filename = "";
	$tempname = "";	
	$folder = "../resources/team_images/";

  $no_teams_text = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["name"])){
      $name_err = "Name is required";
    }else{
      $name = $_POST["name"];
    }

    if(empty($_POST["city"])){
      $city_err = "City is required";
    }else{
      $city = $_POST["city"];
    }

    if(empty($_FILES["badge"]["name"])){
      $file_err = "File is required";
    }else{
      $filename = $_FILES["badge"]["name"];
    }

    
    if(empty($tempname = $_FILES["badge"]["tmp_name"])){
      $file_err = "File is required";
    }else{
      $tempname = $_FILES["badge"]["tmp_name"];	
    }

    if(empty($name_err) && empty($city_err) && empty($file_err)){
      // Attempt insert query execution
      $sql = "INSERT INTO team (name, city, badge) VALUES ('$name', '$city', '$filename')";
        
      try {
          $mysqli->query($sql);
        
          // Now let's move the uploaded image into the folder: image
          if (move_uploaded_file($tempname, $folder.$filename)) {
            $temp = str_replace(' ', '%20', $name);
            $res = file_get_contents("http://localhost/WeBall_Statistics-Backend/API/team.php?name=$temp");
            $object = json_decode($res);
            $teamStats = new TeamStatisticsCompleted($object->id, 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0, $mysqli);

            // API URL
            $url = "http://localhost/WeBall_Statistics-Backend/API/teamStatisticsCompleted.php";

            // Create a new cURL resource
            $ch = curl_init($url);

            $payload = json_encode($teamStats);
            
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


          }else{
            echo "ERROR: Could not able to store the image";
          }

      } catch (\Throwable $th) {
        if($mysqli->errno == 1062){
          $name_err = "* Error: Team ".$name." already exists";
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
    <title>Create teams</title>
    <link rel="icon" type="image/x-icon" href="./photos/favicon.ico">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <style>
      #header {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
      }
      #title {
        text-align: center;
        margin-left: 2rem;
      }

      .img {
        width: 100%;
        height: auto;
        max-width: 35px;
      }
    </style>
  </head>
  <body>
    <Header id="header">
      <a id="back" href="dashboard.php" class="btn btn-info">Back</a>
      <h1 id="title">Create a team for the championship</h1>
    </Header>
    <section>
      <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="table-responsive">
        <table class="table">
          <thead>
            <tr class="table-active">
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">City</th>
              <th scope="col">Badge</th>
              <th scope="col">Submit</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>
                <input type="text" name="name" placeholder="Enter a name" required />
              </td>
              <td>
                <input type="text" name="city" placeholder="Enter a city" required />
              </td>
              <td><input type="file" name="badge" id="badge" required /></td>
              <td>
                <input
                  class="btn btn-primary"
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
    <hr />
    <?php
      if($name_err != ""){
        echo "<div class='alert alert-danger text-center' role='alert'>
              $name_err
        </div>" ;
      }
      if($city_err != ""){
        echo "<div class='alert alert-danger text-center' role='alert'>
              $city_err
        </div>" ;
      }
    ?>
    <section class="table-responsive" id="database">
      <h2  style="padding: 1rem; margin: 1rem; text-align: center;">Teams in the database</h2>
      <table class="table">
        <thead>
          <tr class="table-active">
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">City</th>
            <th scope="col">Badge</th>
          </tr>
        </thead>
        <tbody class="table-info">
          <?php
              $sql = "SELECT * FROM team";
              if($result = $mysqli->query($sql)){
                $index = 0;
                  while($row = $result->fetch_array()){
                    echo "<tr>";
                      echo "<th scope='row'>$index</th>";
                      echo "<td>$row[id]</td>";
                      echo "<td>$row[name]</td>";
                      echo "<td>$row[city]</td>";
                      echo "<td>";
                        echo "<img
                          class='img'
                          src='$folder/$row[badge]'
                          alt='image'
                        />";
                      echo "</td>";
                    echo "</tr>";
                    $index = $index + 1;
                  }
                  if($result->num_rows < 1){
                    $no_teams_text = "There are no teams in the database";
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
