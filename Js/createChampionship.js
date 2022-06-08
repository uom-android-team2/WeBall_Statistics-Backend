fetch("http://localhost/WeBall_Statistics-Backend/API/team.php") //fetch("http://localhost/backend/API/team.php")
  .then((response) => response.json())
  .then((result) => {
    teams = result.map((team) => {
      return team; //return team.name;
    });
    start(teams);
  })
  .catch((error) => console.log("error", error));

const start = (teams) => {
  if (teams.length % 4 != 0) {
    for (let i = 0; i < teams.length % 4; i++) {
      teams.push("-");
    }
  }

  //Removing "-" from teams list for later error handling
  var filteredListOfTeams = teams.filter(function (el) {
    return el != "-";
  });

  const hyphen_exists_section = document.getElementById(
    "hyphen-exists-section"
  );

  if (teams.includes("-")) {
    hyphen_exists_section.insertAdjacentHTML(
      "beforeend",
      `<h3 style="padding-top:40px;">If you are seeing Hypens at the end of the teams list (This -> "-"). Please put them together on match 4 and they will not count as a match...</h3>
       `
    );
    document.getElementById("submit-button").classList.add("hidden");
  }

  const no_teams_section = document.getElementById("no-teams-section");
  const not_enough_teams_section = document.getElementById(
    "not-enough-teams-section"
  );

  //no teams
  if (teams.length === 0) {
    no_teams_section.insertAdjacentHTML(
      "beforeend",
      `<h2>You currently have not created any teams.</h2>
        <h4>Head back to the Create Team Page!</h4>
        <a href="create-team.php" class="btn btn-success"> Create some teams</a>
       `
    );
    document.getElementById("submit-button").classList.add("hidden");
  }

  //not enought teams code goes below
  if (
    (teams.length !== 0 && filteredListOfTeams.length < 4) ||
    filteredListOfTeams.length % 2 === 1
  ) {
    not_enough_teams_section.insertAdjacentHTML(
      "beforeend",
      `<h2>In order to manually create the championship you need 4 or more (even number of teams).</h2>
        <h4>Head back to the Create Team Page</h4>
        <a href="create-team.php" class="btn btn-success"> Create some teams</a>
       `
    );
    document.getElementById("submit-button").classList.add("hidden");
  }
  const numberOfMatches = teams.length / 2;
  const numberOfWeeks = filteredListOfTeams.length - 1;
  const week_container = document.getElementById("week-container");

  //createContainers creates the containers for each week so that later function can just append elements and not create
  const createContainers = function () {
    for (let i = 0; i < numberOfWeeks; i++) {
      week_container.insertAdjacentHTML(
        "beforeend",
        `<h2 style="text-align:center; padding-top: 10px;">Week ${i + 1}</h2>
         <div class="team-container" id="team-container${i + 1}"></div>`
      );
    }
  };
  if (filteredListOfTeams.length >= 4 && filteredListOfTeams.length % 2 === 0) {
    createContainers();
  }
  //createTeams creates the fields that receive the matches
  const createMatches = function (myContainer) {
    for (let i = 0; i < numberOfMatches; i++) {
      document
        .getElementById(`team-container${myContainer}`)
        .insertAdjacentHTML(
          "beforeend",
          `<h3 class="matchTitle">Match ${i + 1}</h3>
      <div draggable="true" class="box"></div>
      <div class="res-circle">
        <div class="circle-txt">VS</div>
      </div>
      <div draggable="true" class="box"></div>`
        );
    }
  };

  //createTeams creates the box with the drag and drop functionallity for easy match customizing by the admin
  const createTeams = function (myContainer) {
    for (let i = 0; i < teams.length; i++) {
      document
        .getElementById(`team-container${myContainer}`)
        .insertAdjacentHTML(
          "beforeend",
          `<div draggable="true" class="box">${teams[i].name}</div>`
        );
    }
  };

  //createWeeks function calls the two essential funtions that create the UI
  const createWeeks = function () {
    for (let i = 0; i < numberOfWeeks; i++) {
      createTeams(i + 1);
      createMatches(i + 1);
    }
  };

  if (filteredListOfTeams.length >= 4 && filteredListOfTeams.length % 2 === 0) {
    createWeeks();
  }
  //Implementing the drap and drop feature
  function handleDragStart(e) {
    this.style.opacity = "0.4";
    dragSrcEl = this;
    e.dataTransfer.effectAllowed = "move";
    e.dataTransfer.setData("text/html", this.innerHTML);
  }

  function handleDragEnd(e) {
    this.style.opacity = "1";

    items.forEach(function (item) {
      item.classList.remove("over");
    });
  }

  function handleDragOver(e) {
    e.preventDefault();
    return false;
  }

  function handleDragEnter(e) {
    this.classList.add("over");
  }

  function handleDragLeave(e) {
    this.classList.remove("over");
  }
  function handleDrop(e) {
    e.stopPropagation(); // stops the browser from redirecting.
    if (dragSrcEl !== this) {
      dragSrcEl.innerHTML = this.innerHTML;
      this.innerHTML = e.dataTransfer.getData("text/html");
    }

    return false;
  }

  let items = document.querySelectorAll(".team-container .box");
  items.forEach(function (item) {
    item.addEventListener("dragstart", handleDragStart);
    item.addEventListener("dragover", handleDragOver);
    item.addEventListener("dragenter", handleDragEnter);
    item.addEventListener("dragleave", handleDragLeave);
    item.addEventListener("dragend", handleDragEnd);
    item.addEventListener("drop", handleDrop);
  });

  const listOfMatches = []; //This will later contain all the Match objects that will later be stored in the DB

  //This class represents the entity of a Match between two teams
  class Match {
    constructor(homeTeam, awayTeam, week) {
      this.homeTeam = homeTeam;
      this.awayTeam = awayTeam;

      this.week = week;
    }
  }
  function splitArrayIntoChunksOfLen(arr, len) {
    let chunks = [],
      i = 0,
      n = arr.length;
    while (i < n) {
      chunks.push(arr.slice(i, (i += len)));
    }
    return chunks;
  }
  //Done button clicked
  document
    .getElementById("submit-button")
    .addEventListener("click", function () {
      //This function handles all actions that need to be done once the done button is clicked by the admin
      alert(
        `Congrats! You just manually created a ${numberOfWeeks}-week championship.`
      );
      array = document.getElementsByClassName("box");
      let data = [];
      for (let i = 0; i < array.length; i++) {
        data.push(array[i].innerHTML);
      }
      data = data.filter((entry) => entry.trim() != "");
      const dataIn2d = splitArrayIntoChunksOfLen(data, teams.length);
      for (let i = 0; i < dataIn2d.length; i++) {
        for (let j = 0; j < dataIn2d[0].length; j = j + 2) {
          listOfMatches.push(
            new Match(dataIn2d[i][j], dataIn2d[i][j + 1], i + 1)
          );
        }
      }
      //need to remove matches that have "-" as a team name
      var filteredListOfMatches = listOfMatches.filter(function (el) {
        return el.homeTeam != "-";
      });

      class FinalMatch {
        id;
        teamlandlord_id;
        teamguest_id;
        date;
        progress;
        completed;
        constructor(id, teamlandlord_id, teamguest_id, date) {
          this.id = id;
          this.teamlandlord_id = teamlandlord_id;
          this.teamguest_id = teamguest_id;
          this.date = date;
          this.progress = 0;
          this.completed = 0;
        }
      }
      //Connecting real team objects to text from drag and drop championship creation
      FinalListOfMatches = [];
      for (let i = 0; i < filteredListOfMatches.length; i++) {
        var homeTeam = "";
        var awayTeam = "";
        var week = filteredListOfMatches[i].week;
        for (let j = 0; j < teams.length; j++) {
          if (filteredListOfMatches[i].homeTeam === teams[j].name) {
            homeTeam = teams[j];
          }
          if (filteredListOfMatches[i].awayTeam === teams[j].name) {
            awayTeam = teams[j];
          }
        }
        let dateTemp = new Date();
        //Creating Match object from teams
        FinalListOfMatches.push(
          new FinalMatch(
            FinalListOfMatches.length + 1,
            homeTeam.id,
            awayTeam.id,
            week
          )
        ); //id might need to be changed
        dateTemp = new Date();
      }
      //Instead of console.log -> Pass all FinalListOfMatches elements into the db
      console.log(FinalListOfMatches);

      const postToDb = async (data, url) => {
        try {
          const res = await fetch(url, {
            method: "POST",
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
          });
        } catch (error) {
          console.log(error);
        }
      };

      createPlayerStatisticsTable = async (team, matchId) => {
        const res = await fetch(
          `http://localhost/WeBall_Statistics-Backend/API/player.php?team=${team}` //`http://localhost/backend/API/player.php?team=${team}`
        );

        const data = await res.json();

        data.forEach(async (player) => {
          const playerStatistics = {
            match_id: matchId,
            player_id: player.id,
            successful_effort: "0",
            total_effort: "0",
            successful_freethrow: "0",
            total_freethrow: "0",
            successful_twopointer: "0",
            total_twopointer: "0",
            successful_threepointer: "0",
            total_threepointer: "0",
            steal: "0",
            assist: "0",
            block: "0",
            rebound: "0",
            foul: "0",
            turnover: "0",
            minutes: 0,
          };

          await postToDb(
            playerStatistics,
            "http://localhost/WeBall_Statistics-Backend/API/playerLiveStatistics.php" //"http://localhost/backend/API/playerLiveStatistics.php"
          );
        });
      };

      const createStatisticsTable = async () => {
        const res = await fetch(
          "http://localhost/WeBall_Statistics-Backend/API/match.php" //"http://localhost/backend/API/match.php"
        );

        const data = await res.json();

        data.forEach(async (match) => {
          const team1Statistic = {
            match_id: match.id,
            team_id: match.teamlandlord_id,
            successful_effort: "0",
            total_effort: "0",
            successful_freethrow: "0",
            total_freethrow: "0",
            succesful_twopointer: "0",
            total_twopointer: "0",
            succesful_threepointer: "0",
            total_threepointer: "0",
            steal: "0",
            assist: "0",
            block: "0",
            rebound: "0",
            foul: "0",
            turnover: "0",
          };

          const team2Statistic = {
            match_id: match.id,
            team_id: match.teamguest_id,
            successful_effort: "0",
            total_effort: "0",
            successful_freethrow: "0",
            total_freethrow: "0",
            succesful_twopointer: "0",
            total_twopointer: "0",
            succesful_threepointer: "0",
            total_threepointer: "0",
            steal: "0",
            assist: "0",
            block: "0",
            rebound: "0",
            foul: "0",
            turnover: "0",
          };

          await postToDb(
            team1Statistic,
            "http://localhost/WeBall_Statistics-Backend/API/teamLiveStatistics.php" //"http://localhost/backend/API/teamLiveStatistics.php"
          );

          await postToDb(
            team2Statistic,
            "http://localhost/WeBall_Statistics-Backend/API/teamLiveStatistics.php" //"http://localhost/backend/API/teamLiveStatistics.php"
          );

          await createPlayerStatisticsTable(match.teamguest_name, match.id);

          await createPlayerStatisticsTable(match.teamlandlord_name, match.id);
        });
      };

      const insertMatches = async () => {
        FinalListOfMatches.forEach(async (m) => {
          await postToDb(
            m,
            "http://localhost/WeBall_Statistics-Backend/API/match.php" //"http://localhost/backend/API/match.php"
          );
        });
        await createStatisticsTable();
      };

      insertMatches();
    });
};
