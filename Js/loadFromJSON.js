"use strict";

fetch("../resources/data/player_data/players.json")
  .then((response) => response.json())
  .then((json) => console.log(json));
