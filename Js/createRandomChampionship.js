fetch("http://localhost/WeBall_Statistics-Backend/API/team.php")
  .then((response) => response.json())
  .then((result) => {
    teamObjects = result;
    teams = result.map((team) => {
      return team.name; //return team.name;
    });

    start(teams, teamObjects);
  })
  .catch((error) => console.log("error", error));

const start = (teams) => {
  //console.log(teamObjects);

  class Match {
    #game = new Map();

    constructor(id, teams) {
      this.#game.set(id, teams);
    }

    getGame() {
      return this.#game;
    }
  }

  class Week {
    #teamsAdded = new Set();
    #listOfMatches = [];
    #number;
    #maxMatches = teams.length / 2;

    constructor(number) {
      this.#number = number;
    }

    addTeams(ts) {
      if (!this.#teamsAdded.has(ts[0]) && !this.#teamsAdded.has(ts[1])) {
        this.#teamsAdded.add(ts[0]);
        this.#teamsAdded.add(ts[1]);
      }
    }

    addMatch(match) {
      const [team1, team2] = match.getGame().get(...match.getGame().keys());
      if (!(this.#teamsAdded.has(team1) || this.#teamsAdded.has(team2))) {
        this.addTeams([team1, team2]);
        this.#listOfMatches.push(match);
      }
    }

    getListOfMatches() {
      return this.#listOfMatches;
    }

    getMaxMatches() {
      return this.#maxMatches;
    }
    getNumber() {
      return this.#number;
    }
  }

  const allPossibleMatches = [];
  const tempMatches = [];

  for (let i = 0; i < teams.length; i++) {
    //For each team

    for (let j = 0; j < teams.length; j++) {
      //For each oppenent

      if (teams[i] !== teams[j]) {
        //Excluding self
        const id = teams[i] + "-" + teams[j];
        tempMatches.push(new Match(id, [i, j]));
      }
    }
  }

  const revertId = function (stringId) {
    let team1;
    let team2;

    [team1, team2] = stringId.split("-");

    return `${team2}-${team1}`;
  };

  const allPossibleMatchesId = new Set();

  const putIdInSet = function (stringId) {
    if (
      !allPossibleMatchesId.has(stringId) &&
      !allPossibleMatchesId.has(revertId(stringId))
    ) {
      allPossibleMatchesId.add(stringId);
    }
  };

  tempMatches.forEach((tm) => putIdInSet(...tm.getGame().keys()));

  tempMatches.forEach((tm) => {
    if (allPossibleMatchesId.has(...tm.getGame().keys())) {
      allPossibleMatches.push(tm);
    }
  });

  //   console.log(allPossibleMatches);

  const championship = [];

  for (let i = 0; i < teams.length - 1; i++) {
    // For all weeks
    const week = new Week(i + 1);
    allPossibleMatches.forEach((m) => {
      if (week.getListOfMatches.length <= week.getMaxMatches()) {
        week.addMatch(m);
      }
    });

    championship.push(week);
  }
  //console.log(championship);
  //   console.log(championship);
  const no_teams_section = document.getElementById("no-teams-section");
  const not_enough_teams_section = document.getElementById(
    "not-enough-teams-section"
  );

  //no teams -> Works
  if (teams.length === 0) {
    no_teams_section.insertAdjacentHTML(
      "beforeend",
      `<h2>You currently have not created any teams.</h2>
        <h4>Head back to the Create Team Page!</h4>
        <a href="create-team.php" class="btn btn-success"> Create some teams</a>
       `
    );
    document.getElementById("create-button").classList.add("hidden");
  }

  //not enought teams code goes below
  if ((teams.length != 0 && teams.length < 4) || teams.length % 2 === 1) {
    not_enough_teams_section.insertAdjacentHTML(
      "beforeend",
      `<h2>In order to manually create the championship you need 4 or more (even number of teams).</h2>
        <h4>Head back to the Create Team Page</h4>
        <a href="create-team.php" class="btn btn-success"> Create some teams</a>
       `
    );
    document.getElementById("create-button").classList.add("hidden");
  }

  document
    .getElementById("create-button")
    .addEventListener("click", function () {
      //This function handles all actions that need to be done once the done button is clicked by the admin
      alert(
        `Congrats! You just randomly created a ${
          teams.length - 1
        }-week championship. 
    Check the app for results!`
      );

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
          this.progress = false;
          this.completed = false;
        }
      }
      //Connecting real team objects to text from drag and drop championship creation
      FinalListOfMatches = [];
      for (let i = 0; i < championship.length; i++) {
        var homeTeam = "";
        var awayTeam = "";
        var week = championship[i].getNumber();
        for (let j = 0; j < championship[i].getListOfMatches().length; j++) {
          var [key, value] = championship[i]
            .getListOfMatches()
            [j].getGame()
            .entries();
          var [team1, team2] = key[0].split("-");
          //console.log(team1, team2);
          for (let z = 0; z < teamObjects.length; z++) {
            if (team1 === teamObjects[z].name) {
              homeTeam = teamObjects[z];
              //console.log(homeTeam);
            }
            if (team2 === teamObjects[z].name) {
              awayTeam = teamObjects[z];
              //console.log(awayTeam);
            }
          }
          //Creating Match object from teams
          let dateTemp = new Date();

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
          `http://localhost/WeBall_Statistics-Backend/API/player.php?team=${team}`
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
            minutes: null,
          };

          await postToDb(
            playerStatistics,
            "http://localhost/WeBall_Statistics-Backend/API/playerLiveStatistics.php"
          );
        });
      };

      const createStatisticsTable = async () => {
        const res = await fetch(
          "http://localhost/WeBall_Statistics-Backend/API/match.php"
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
            "http://localhost/WeBall_Statistics-Backend/API/teamLiveStatistics.php"
          );

          await postToDb(
            team2Statistic,
            "http://localhost/WeBall_Statistics-Backend/API/teamLiveStatistics.php"
          );

          await createPlayerStatisticsTable(match.teamguest_name, match.id);

          await createPlayerStatisticsTable(match.teamlandlord_name, match.id);
        });
      };

      const insertMatches = async () => {
        FinalListOfMatches.forEach(async (m) => {
          await postToDb(
            m,
            "http://localhost/WeBall_Statistics-Backend/API/match.php"
          );
        });
        await createStatisticsTable();
      };

      insertMatches();
    });
};
