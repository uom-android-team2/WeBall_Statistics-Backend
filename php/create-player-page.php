
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
    <header id="header">
      <a id="back" href="index.php" class="btn btn-info">Back</a>
      <h1 id="title">Add new player to the championship</h1>
    </header>
    <section>
      <form action="" class="table-responsive">
        <table class="table">
          <thead>
            <tr class="table-active">
              <th scope="col">#</th>
              <th scope="col">Name</th>
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
                <input type="text" name="teamName" placeholder="Enter a name" />
              </td>
              <td>
                <input type="text" name="city" placeholder="Enter a city" />
              </td>
              <td><input type="file" name="badge" id="badge" /></td>
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
    <section class="table-responsive" id="database">
      <h2 style="padding: 1rem; margin: 1rem">Teams in the database</h2>
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
          <tr>
            <th scope="row">1</th>
            <td>1</td>
            <td>Σικαγο Μπουλς</td>
            <td>Σικαγο</td>
            <td>
              <img
                class="img"
                src="../resources/team_images/bulls.png"
                alt="image"
              />
            </td>
          </tr>
        </tbody>
      </table>
    </section>
  </body>
</html>