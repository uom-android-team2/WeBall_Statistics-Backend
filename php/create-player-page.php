
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Player</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <style>
      #container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 1rem 0.5rem 1rem;
      }
      #teams-message {
          color: red;
          text-align: center;
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
      .select-form {
          height: 30px;
          padding: 2px 2px 2px 2px;
      }
      .custom-button-css {
          margin-left: 2rem;
          margin-bottom: 1rem;
      }
      .h2-display {
        padding: 1rem; 
        margin: 1rem 1rem 0 1rem;
      }
      /*Should remove this classes when teams are availabe*/
      .select-no-teams {
          border: 2px solid red;
      }
      .btn-disabled {
        opacity: 0.5;
        pointer-events: none;;
      }
      /*---------------------------------------*/
      /*add this class when teams are available*/
      .message-hidden {
          opacity: 0;
          font-size: 0px;
      }
    </style>
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
            <a id="back" href="index.php" class="btn btn-info">Back</a>
            <h1 id="title">Add new player to the championship</h1>
        </div>
        <h5 id="teams-message">No teams available to add players</h5> <!-- class="message-hidden" -->
    </header>
    <section>
      <form action="" class="table-responsive">
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
                        <input type="number" name="playerNumber" min="0"/>
                    </td>
                    <td>
                        <select name="positions" class="select-form">
                            <option value="select">Select Position</option>
                            <option value="Point guard">Point guard</option>
                            <option value="Shooting guard">Shooting guard</option>
                            <option value="Small forward">Small forward</option>
                            <option value="Power forward">Power forward</option>
                            <option value="Center">Center</option>
                        </select>
                    </td>
                    <td>
                        <select name="teams" class="select-form select-no-teams">
                            <option value="select">Select Team</option>
                            <?php 
                            //code to fill the select for the team from db
                                //foreach($release as $i => $r){
                                    //echo"<option value = '$r->title' > $r->title ($r->release_year) </option>";
                                //}
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="file" name="playerPhoto" id="badge" />
                        </td>
                    <td>
                        <input
                        class="btn btn-primary btn-disabled"
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
                <tr>
                    <th scope="row">1</th>
                    <td>1</td>
                    <td>Derrick</td>
                    <td>Rose</td>
                    <td>24</td>
                    <td>Point guard</td>
                    <td><b>New York Knicks</b></td>
                    <td>
                        <img
                            class="img"
                            src="../resources/player_images/derrick-rose.png"
                            alt="image"
                        />
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
  </body>
</html>