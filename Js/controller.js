import { loadData } from "./Services/loadFromJSON.js";
import { DATA_PLAYERS_PATH } from "./config.js";
import { DATA_TEAMS_PATH } from "./config.js";

const btnLoadData = document.querySelector("#btn-load-data");

const controlData = function () {
  //Retrieve data from json
  loadData(DATA_PLAYERS_PATH).then(function (dataArr) {
    console.log(dataArr);
  });
  loadData(DATA_TEAMS_PATH).then(function (dataArr) {
    console.log(dataArr);
  });
  //Store the data to the DB
};

btnLoadData.addEventListener("click", function (evt) {
  evt.preventDefault();
  controlData();
});
