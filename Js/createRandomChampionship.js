'use strict';


const teams = ["Boston Celtics", "Golden State Warriors", "Miami Heat", "Denver Nuggets", "Chicago Bulls", "Charlotte Hornets", "Wizards", "Orlando Magic"];


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

            this.addTeams([team1, team2])
            this.#listOfMatches.push(match);
        }

    }


    getListOfMacthes() {
        return this.#listOfMatches;
    }

    getMaxMatches() {
        return this.#maxMatches;
    }

}

const allPossibleMatches = [];
const tempMatches = [];

for (let i = 0; i < teams.length; i++) {  //For each team


    for (let j = 0; j < teams.length; j++) {  //For each oppenent

        if (teams[i] !== teams[j]) { //Excluding self
            const id = teams[i] + "-" + teams[j];
            tempMatches.push(new Match(id, [i, j]));
        }


    }
}

const revertId = function (stringId) {
    let team1;
    let team2;

    [team1, team2] = stringId.split('-')

    return `${team2}-${team1}`;
}


const allPossibleMatchesId = new Set();

const putIdInSet = function (stringId) {

    if (!allPossibleMatchesId.has(stringId) && !allPossibleMatchesId.has(revertId(stringId))) {
        allPossibleMatchesId.add(stringId)
    }

}


tempMatches.forEach(tm => putIdInSet(...tm.getGame().keys()))



tempMatches.forEach(tm => {

    if (allPossibleMatchesId.has(...tm.getGame().keys())) {
        allPossibleMatches.push(tm);
    }
})


console.log(allPossibleMatches);


const championship = [];

for (let i = 0; i < teams.length - 1; i++) { // For all week
    const week = new Week(i + 1);
    allPossibleMatches.forEach(m => {
        if (week.getListOfMacthes.length <= week.getMaxMatches()) {
            week.addMatch(m);
        }
    })

    championship.push(week)

}

console.log(championship);












