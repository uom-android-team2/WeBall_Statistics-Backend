import { loadData } from "./Services/loadFromJSON.js";
import { DATA_PLAYERS_PATH } from "./config.js";
import { DATA_TEAMS_PATH } from "./config.js";
import { postToDB } from "./Services/storeToDB.js";
import { PLAYER_API_PATH } from "./config.js";
import { TEAM_API_PATH } from "./config.js";

const btnLoadData = document.querySelector("#btn-load-data");

const controlData = function () {
  loadData(DATA_PLAYERS_PATH).then(function (dataArr) {
    dataArr.forEach(async function (player) {
      const playerObj = {
        //as id will have the default auto increment
        name: player.name,
        surname: player.surname,
        number: Math.floor(Math.random() * 100), //0 - 99
        position: "Undefined",
        team: player.team, //team id
        photo: "Undefined",
      };
      await postToDB(playerObj, PLAYER_API_PATH);
    });
  });

  loadData(DATA_TEAMS_PATH).then(function (dataArr) {
    dataArr.forEach(async function (team) {
      const teamObj = {
        id: team.id, // 10 digits id
        name: team.name,
        city: team.city,
        badge: "Undefined",
      };
      await postToDB(teamObj, TEAM_API_PATH);
    });
  });
};

btnLoadData.addEventListener("click", function (evt) {
  evt.preventDefault();
  controlData();
});
