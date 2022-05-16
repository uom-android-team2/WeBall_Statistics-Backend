<?php
//     `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     `teamlandlord_id`int(12) UNSIGNED NOT NULL,
//     `teamguest_id`int(12) UNSIGNED NOT NULL,
//     `date`date NOT NULL,
//     `progress`BIT(1) NOT NULL,
//     `completed`BIT(1) NOT NULL
//   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

class BasketballMatch {

    public $id;
    public $teamlandlord_id;
    public $teamlandlord_name;
    public $teamguest_id;
    public $teamguest_name;
    public $date;
    public $progress; //0 || 1
    public $completed; //0 || 1


    public function __construct($id, $teamlandlord_id, $teamguest_id, $date, $progress, $completed, $mysqli){
        $this->id = $id;
        $this->teamlandlord_id = $teamlandlord_id;
        $this->teamlandlord_name = $this->get_team_name($mysqli, $this->teamlandlord_id);
        $this->teamguest_id = $teamguest_id;
        $this->teamguest_name = $this->get_team_name($mysqli, $this->teamguest_id);
        $this->date = $date;
        $this->progress = $progress;
        $this->completed = $completed;
    }

    //Getting the team name by the id
    function get_team_name($mysqli, $teamid) {
        $sql = "SELECT * FROM `team` WHERE `id` = $teamid";
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