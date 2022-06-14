import { loadData } from "./Services/loadFromJSON.js";
import * as PATH from "./config.js";
import { postToDB } from "./Services/storeToDB.js";

const btnLoadData = document.querySelector("#btn-load-data");

const isPlayerExistInDB = function (fullname, array) {
  return array.some(function (element) {
    return element?.name + element?.surname === fullname;
  });
};

const isTeamExistInDB = function (name, array) {
  return array.some(function (element) {
    return element.name === name;
  });
};

const controlData = async function (teamsInDBArr, playersInDBArr) {
  let teamsAdded = 0;
  let playersAdded = 0;
  await loadData(PATH.DATA_PLAYERS_PATH).then(async function (dataArr) {
    await dataArr.forEach(async function (player) {
      const playerObj = {
        //as "id" will have the default auto increment
        name: player.name,
        surname: player.surname,
        number: Math.floor(Math.random() * 100), //0 - 99
        position: player.position,
        team: player.team,
        photo: player.photo,
      };
      //Insert only new players that aren't already in DB
      if (!isPlayerExistInDB(playerObj.name + playerObj.surname, playersInDBArr)) {
        playersAdded++;
        await postToDB(playerObj, PATH.PLAYER_API_PATH);
      }
    });
  });

  await loadData(PATH.DATA_TEAMS_PATH).then(async function (dataArr) {
    await dataArr.forEach(async function (team) {
      const teamObj = {
        //as "id" will have the default auto increment (1 - 8)
        name: team.name,
        city: team.city,
        badge: team.badge,
      };
      //Insert only new teams that aren't already in DB
      if (!isTeamExistInDB(teamObj.name, teamsInDBArr)) {
        teamsAdded++;
        await postToDB(teamObj, PATH.TEAM_API_PATH);
      }
    });
  });

  if (playersAdded === 0 && teamsAdded === 0) {
    alert("Teams and Players already added in Database!");
  } else {
    alert(`Successful registration of ${teamsAdded} teams and ${playersAdded} players in the database!`);
  }
};

const createTeamStatisticsTable = async (teamsInDBArr) => {
  const res = await fetch("http://localhost/WeBall_Statistics-Backend/API/team.php");

  const teams = await res.json();
  teams.forEach(async (team) => {
    if (!isTeamExistInDB(team.name, teamsInDBArr)) {
      const teamCompletedStats = {
        team_id: team.id,
        total_matches: "0",
        win: "0",
        lose: "0",
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
      };
      await postToDB(teamCompletedStats, PATH.TEAM_COMPLETED_STATISTICS);
    }
  });
};

const createPlayerStatisticsTable = async (playersInDBArr) => {
  const res = await fetch("http://localhost/WeBall_Statistics-Backend/API/player.php");

  const players = await res.json();
  players.forEach(async (player) => {
    if (!isPlayerExistInDB(player.name + player.surname, playersInDBArr)) {
      const playerCompletedStats = {
        player_id: player.id,
        matches_played: "0",
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
        minutes: "0",
      };
      await postToDB(playerCompletedStats, PATH.PLAYER_COMPLETED_STATISTICS);
    }
  });
};

btnLoadData.addEventListener("click", async function (evt) {
  evt.preventDefault();
  let teamsInDBArr = new Array();
  let playersInDBArr = new Array();
  //Retrieve the data that exist already in DB for players and teams
  try {
    await fetch(`${PATH.TEAM_API_PATH}`)
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        teamsInDBArr = data;
      });
  } catch (err) {
    console.error(err);
  }
  try {
    await fetch(`${PATH.PLAYER_API_PATH}`)
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        playersInDBArr = data;
      });
  } catch (err) {
    console.error(err);
  }

  await controlData(teamsInDBArr, playersInDBArr);
  await createTeamStatisticsTable(teamsInDBArr);
  await createPlayerStatisticsTable(playersInDBArr);
});
