import { loadData } from "./Services/loadFromJSON.js";
import * as PATH from "./config.js";
import { postToDB } from "./Services/storeToDB.js";

const btnLoadData = document.querySelector("#btn-load-data");

const isExistInDB = function (name, array) {
  return array.some(function (element) {
    return element.name === name;
  });
};

const controlData = async function (teamsInDBArr, playersInDBArr) {
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
      if (!isExistInDB(playerObj.name, playersInDBArr)) {
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
      if (!isExistInDB(teamObj.name, teamsInDBArr)) {
        await postToDB(teamObj, PATH.TEAM_API_PATH);
      }
    });
  });
  alert("Successful registration of data in the database!");
};

const createTeamStatisticsTable = async () => {
  const res = await fetch("http://localhost/WeBall_Statistics-Backend/API/team.php");

  const teams = await res.json();
  teams.forEach(async (team) => {
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
  });
};

const createPlayerStatisticsTable = async () => {
  const res = await fetch("http://localhost/WeBall_Statistics-Backend/API/player.php");

  const players = await res.json();
  players.forEach(async (player) => {
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
  });
};

btnLoadData.addEventListener("click", async function (evt) {
  evt.preventDefault();
  let teamsInDBArr = new Array();
  let playersInDBArr = new Array();
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
  await createTeamStatisticsTable();
  await createPlayerStatisticsTable();
});
