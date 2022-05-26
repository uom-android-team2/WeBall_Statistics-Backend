const teams = [
  "Boston Celtics",
  "Golden State Warriors",
  "Miami Heat",
  "Denver Nuggets",
  "Chicago Bulls",
  "Charlotte Hornets",
  "Washington Wizards",
  "Orlando Magic",
];

if (teams.length % 4 != 0) {
  for (let i = 0; i < teams.length % 4; i++) {
    teams.push("-");
  }
}
console.log(teams);
const numberOfMatches = teams.length / 2;

const numberOfWeeks = teams.length - 1;

const week_container = document.getElementById("week-container");

const createContainers = function () {
  for (let i = 0; i < numberOfWeeks; i++) {
    week_container.insertAdjacentHTML(
      "beforeend",
      `<h2>Week ${i + 1}</h2>
       <div class="team-container" id="team-container${i + 1}"></div>`
    );
  }
};
createContainers();

const createMatches = function (myContainer) {
  for (let i = 0; i < numberOfMatches; i++) {
    document.getElementById(`team-container${myContainer}`).insertAdjacentHTML(
      "beforeend",
      `<h3 class="matchTitle">Match ${i + 1}</h3>
    <div draggable="true" class="box"></div><h4 class="vsOperator"> VS </h4>
    <div draggable="true" class="box"></div>`
    );
  }
};

const createTeams = function (myContainer) {
  for (let i = 0; i < teams.length; i++) {
    document
      .getElementById(`team-container${myContainer}`)
      .insertAdjacentHTML(
        "beforeend",
        `<div draggable="true" class="box">${teams[i]}</div>`
      );
  }
};

const createWeeks = function () {
  for (let i = 0; i < numberOfWeeks; i++) {
    createTeams(i + 1);
    createMatches(i + 1);
  }
};

createWeeks();

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
