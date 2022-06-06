import { loadData } from "./Services/loadFromJSON.js";
import * as PATH from "./config.js";
import { postToDB } from "./Services/storeToDB.js";

const btnLoadData = document.querySelector("#btn-load-data");

const controlData = function () {
  loadData(PATH.DATA_PLAYERS_PATH).then(function (dataArr) {
    dataArr.forEach(async function (player) {
      const playerObj = {
        //as "id" will have the default auto increment
        name: player.name,
        surname: player.surname,
        number: Math.floor(Math.random() * 100), //0 - 99
        position: "Undefined",
        team: Math.floor(Math.random() * 8) + 1, //team id (1 - 8) cause we got 8 teams
        photo: "Undefined",
      };
      await postToDB(playerObj, PATH.PLAYER_API_PATH);
    });
  });

  loadData(PATH.DATA_TEAMS_PATH).then(function (dataArr) {
    dataArr.forEach(async function (team) {
      const teamObj = {
        //as "id" will have the default auto increment (1 - 8)
        name: team.name,
        city: team.city,
        badge: "Undefined",
      };
      await postToDB(teamObj, PATH.TEAM_API_PATH);
    });
  });

  alert("Successful registration of data in the database!");
};

btnLoadData.addEventListener("click", function (evt) {
  evt.preventDefault();
  controlData();
});
