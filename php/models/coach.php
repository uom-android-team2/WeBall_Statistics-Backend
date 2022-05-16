<?php
//   `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
//   `teamid`int(12) NOT NULL,
//   `firstname`varchar(32) NOT NULL,
//   `surname`varchar(32) NOT NULL,
//   `headcoach` BIT(1) NOT NULL,
//   `image` VARBINARY(100) NOT NULL

class Coach {

    public $id;
    public $teamid;
    public $teamname;
    public $firstname;
    public $surname;
    public $headcoach;
    public $image;

    public function __construct($id, $teamid, $firstname, $surname, $headcoach, $image, $mysqli){
        $this->id = $id;
        $this->teamid = $teamid;
        $this->teamname = $this->get_team_name($mysqli);
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->headcoach = $headcoach;
        $this->image = $image;
    }

    //Getting the team name by the id
    function get_team_name($mysqli) {
        $sql = "SELECT * FROM `team` WHERE `id` = $this->teamid";
        $result = $mysqli->query($sql);
        //Check if team with this id found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["name"];
        }
        return null;
    }
};

?>