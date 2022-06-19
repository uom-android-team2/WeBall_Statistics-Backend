<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create championship randomly</title>
    <link rel="icon" type="image/x-icon" href="./photos/favicon.ico">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../style/css/create-random-championship-page.css">
    <script 
        defer 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
        crossorigin="anonymous">
    </script>
    <style>
        #message-wait {
          color: red;
          text-align: center;
        }
    </style>
    <script defer src="../Js/createRandomChampionship.js"></script>
  </head>
    <body>
        <header >
            <div id="container">
                <a id="back" href="dashboard.php" class="btn btn-info">Back</a>
                <h1 id="title">Create the championship randomly!</h1>
            </div>
            <h5 id="message-wait">Please wait on this page after pressing the button for 5 seconds for data to load and then you can go back</h5>
        </header>
        <div >
            <div id="no-teams-section"></div>
            <div id="not-enough-teams-section"></div>
        </div>
        <div id="button-div">
        <button id='create-button' type="submit" >Create randomly</button>
        </div>
    </body>
</html>