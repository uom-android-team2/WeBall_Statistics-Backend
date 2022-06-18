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

const start = async (teams, listOfTeams) => {
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
  let listOfPossibleMatches = [];
  let visited = new Map();
  let first = true;
  listOfTeams.forEach((teamLandord) => {
    listOfTeams.forEach((teamGuest) => {
      if (first && teamLandord.id !== teamGuest.id) {
        const match = new FinalMatch(-1, teamLandord.id, teamGuest.id, -1);
        const pair1 = {
          teamLandord: teamLandord.id,
          teamGuest: teamGuest.id,
        };
        const pair2 = {
          teamLandord: teamLandord.id,
          teamGuest: teamGuest.id,
        };
        visited.set(pair1, true);
        visited.set(pair2, true);

        listOfPossibleMatches.push(match);
        first = false;
      } else if (teamLandord.id !== teamGuest.id) {
        const pair1 = {
          teamLandord: teamLandord.id,
          teamGuest: teamGuest.id,
        };
        const pair2 = {
          teamLandord: teamLandord.id,
          teamGuest: teamGuest.id,
        };

        let unique = true;

        for (pair of visited.keys()) {
          if (pair.teamLandord === teamLandord.id) {
            if (pair.teamGuest === teamGuest.id) {
              unique = false;
            }
          }

          if (pair.teamLandord === teamGuest.id) {
            if (pair.teamGuest === teamLandord.id) {
              unique = false;
            }
          }
        }
        if (unique) {
          const match = new FinalMatch(-1, teamLandord.id, teamGuest.id, -1);
          visited.set(pair1, true);
          visited.set(pair2, true);
          listOfPossibleMatches.push(match);
        }
      }
    });
  });

  console.log(listOfPossibleMatches);

  function shuffle(array) {
    let currentIndex = array.length,
      randomIndex;

    // While there remain elements to shuffle.
    while (currentIndex != 0) {
      // Pick a remaining element.
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex--;

      // And swap it with the current element.
      [array[currentIndex], array[randomIndex]] = [
        array[randomIndex],
        array[currentIndex],
      ];
    }

    return array;
  }

  console.log(listOfPossibleMatches);

  let = week = 1;
  visited = new Map();
  visited.set(week, new Set());
  const finalMatches = [];

  while (listOfPossibleMatches.length > 0) {
    listOfPossibleMatches = shuffle(listOfPossibleMatches);
    for (let i = 0; i < listOfPossibleMatches.length; i++) {
      if (
        !visited.get(week).has(listOfPossibleMatches[i].teamlandlord_id) &&
        !visited.get(week).has(listOfPossibleMatches[i].teamguest_id)
      ) {
        const match = listOfPossibleMatches[i];
        match.date = week;
        visited.get(week).add(listOfPossibleMatches[i].teamlandlord_id);
        visited.get(week).add(listOfPossibleMatches[i].teamguest_id);
        finalMatches.push(match);
        listOfPossibleMatches.splice(i, 1);

        console.log("hereeee");
        console.log(listOfPossibleMatches.length);
        if (visited.get(week).size === 8) {
          week++;
          visited.set(week, new Set());
        }
        break;
      }
    }
  }

  // console.log(finalMatches);

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
    document.getElementById("button-div").style.display = "none";
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
    document.getElementById("button-div").style.display = "none";
  }

  // await document
  //   .getElementById("create-button")
  //   .addEventListener("click", async function () {
  //     //This function handles all actions that need to be done once the done button is clicked by the admin

  //     class FinalMatch {
  //       id;
  //       teamlandlord_id;
  //       teamguest_id;
  //       date;
  //       progress;
  //       completed;
  //       constructor(id, teamlandlord_id, teamguest_id, date) {
  //         this.id = id;
  //         this.teamlandlord_id = teamlandlord_id;
  //         this.teamguest_id = teamguest_id;
  //         this.date = date;
  //         this.progress = false;
  //         this.completed = false;
  //       }
  //     }
  //     //Connecting real team objects to text from drag and drop championship creation
  //     FinalListOfMatches = [];
  //     for (let i = 0; i < championship.length; i++) {
  //       var homeTeam = "";
  //       var awayTeam = "";
  //       var week = championship[i].getNumber();
  //       for (let j = 0; j < championship[i].getListOfMatches().length; j++) {
  //         var [key, value] = championship[i]
  //           .getListOfMatches()
  //           [j].getGame()
  //           .entries();
  //         var [team1, team2] = key[0].split("-");
  //         //console.log(team1, team2);
  //         for (let z = 0; z < teamObjects.length; z++) {
  //           if (team1 === teamObjects[z].name) {
  //             homeTeam = teamObjects[z];
  //             //console.log(homeTeam);
  //           }
  //           if (team2 === teamObjects[z].name) {
  //             awayTeam = teamObjects[z];
  //             //console.log(awayTeam);
  //           }
  //         }
  //         //Creating Match object from teams
  //         let dateTemp = new Date();

  //         FinalListOfMatches.push(
  //           new FinalMatch(
  //             FinalListOfMatches.length + 1,
  //             homeTeam.id,
  //             awayTeam.id,
  //             week
  //           )
  //         ); //id might need to be changed
  //         dateTemp = new Date();
  //       }
  //     }
  //     //Instead of console.log -> Pass all FinalListOfMatches elements into the db
  //     console.log(FinalListOfMatches);

  //     const postToDb = async (data, url) => {
  //       try {
  //         const res = await fetch(url, {
  //           method: "POST",
  //           headers: {
  //             Accept: "application/json",
  //             "Content-Type": "application/json",
  //           },
  //           body: JSON.stringify(data),
  //         });
  //       } catch (error) {
  //         console.log(error);
  //       }
  //     };

  //     createPlayerStatisticsTable = async (team, matchId) => {
  //       const res = await fetch(
  //         `http://localhost/WeBall_Statistics-Backend/API/player.php?team=${team}`
  //       );

  //       const data = await res.json();

  //       await data.forEach(async (player) => {
  //         const playerStatistics = {
  //           match_id: matchId,
  //           player_id: player.id,
  //           successful_effort: "0",
  //           total_effort: "0",
  //           successful_freethrow: "0",
  //           total_freethrow: "0",
  //           successful_twopointer: "0",
  //           total_twopointer: "0",
  //           successful_threepointer: "0",
  //           total_threepointer: "0",
  //           steal: "0",
  //           assist: "0",
  //           block: "0",
  //           rebound: "0",
  //           foul: "0",
  //           turnover: "0",
  //           minutes: 0,
  //         };

  //         await postToDb(
  //           playerStatistics,
  //           "http://localhost/WeBall_Statistics-Backend/API/playerLiveStatistics.php"
  //         );
  //       });
  //     };

  //     const createStatisticsTable = async () => {
  //       const res = await fetch(
  //         "http://localhost/WeBall_Statistics-Backend/API/match.php"
  //       );

  //       const data = await res.json();

  //       await data.forEach(async (match) => {
  //         const team1Statistic = {
  //           match_id: match.id,
  //           team_id: match.teamlandlord_id,
  //           successful_effort: "0",
  //           total_effort: "0",
  //           successful_freethrow: "0",
  //           total_freethrow: "0",
  //           succesful_twopointer: "0",
  //           total_twopointer: "0",
  //           succesful_threepointer: "0",
  //           total_threepointer: "0",
  //           steal: "0",
  //           assist: "0",
  //           block: "0",
  //           rebound: "0",
  //           foul: "0",
  //           turnover: "0",
  //         };

  //         const team2Statistic = {
  //           match_id: match.id,
  //           team_id: match.teamguest_id,
  //           successful_effort: "0",
  //           total_effort: "0",
  //           successful_freethrow: "0",
  //           total_freethrow: "0",
  //           succesful_twopointer: "0",
  //           total_twopointer: "0",
  //           succesful_threepointer: "0",
  //           total_threepointer: "0",
  //           steal: "0",
  //           assist: "0",
  //           block: "0",
  //           rebound: "0",
  //           foul: "0",
  //           turnover: "0",
  //         };

  //         await postToDb(
  //           team1Statistic,
  //           "http://localhost/WeBall_Statistics-Backend/API/teamLiveStatistics.php"
  //         );

  //         await postToDb(
  //           team2Statistic,
  //           "http://localhost/WeBall_Statistics-Backend/API/teamLiveStatistics.php"
  //         );

  //         await createPlayerStatisticsTable(match.teamguest_name, match.id);

  //         await createPlayerStatisticsTable(match.teamlandlord_name, match.id);
  //       });
  //     };

  //     const insertMatches = async () => {
  //       await FinalListOfMatches.forEach(async (m) => {
  //         await postToDb(
  //           m,
  //           "http://localhost/WeBall_Statistics-Backend/API/match.php"
  //         );
  //       });
  //       await createStatisticsTable();
  //     };

  //     await insertMatches();
  //     await alert(
  //       `Congrats! You just randomly created a ${
  //         teams.length - 1
  //       }-week championship.
  //       Check the app for results!`
  //     );
  //   });
};
