<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create championship manually</title>
    <link rel="icon" type="image/ico" href="https://lh3.googleusercontent.com/YJkZQ9JYWp6-caFc5c1NDjVtsDypBj3A7Qzkt46sX72ovnFBCQyd0UpTq3WTOaOd9ymJ5A=s85">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../style/css/create-championship-page.css">
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
    <script defer src="../Js/createChampionship.js"></script>
  </head>
    <body>
        <header >
            <div id="container">
                <a id="back" href="dashboard.php" class="btn btn-info">Back</a>
                <h1 id="title">Create the championship manually</h1>
            </div>
            <h5 id="message-wait">Please wait on this page after pressing the button for 5 seconds for data to load and then you can go back</h5>
            <div id="hyphen-exists-section"></div>
            <div id="no-teams-section"></div>
            <div id="not-enough-teams-section"></div>
        </header>
        <div id="week-container">
            <div id="team-container" ></div>
        </div>
        <div id="button-div">
        <button id='submit-button' type="submit" >Done</button>
        </div>

    </body>
</html>