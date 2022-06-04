<?php
    //     `team_id` int(12) UNSIGNED NOT NULL,
    //     `total_matches`int(24) UNSIGNED NOT NULL,
    //     `win` int UNSIGNED NOT NULL,
    //     `lose` int UNSIGNED NOT NULL,
    //     `successful_effort` int UNSIGNED NOT NULL,
    //     `total_effort` int UNSIGNED NOT NULL,
    //     `successful_freethrow`int UNSIGNED NOT NULL,
    //     `total_freethrow` int UNSIGNED NOT NULL,
    //     `successful_twopointer` int UNSIGNED NOT NULL,
    //     `total_twopointer` int UNSIGNED NOT NULL,
    //     `successful_threepointer` int UNSIGNED NOT NULL,
    //     `total_threepointer` int UNSIGNED NOT NULL,
    //     `steal` int UNSIGNED NOT NULL,
    //     `assist` int UNSIGNED NOT NULL,
    //     `block` int UNSIGNED NOT NULL,
    //     `rebound` int UNSIGNED NOT NULL,
    //     `foul` int UNSIGNED NOT NULL,
    //     `turnover`int UNSIGNED NOT NULL
    //   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    class TeamStatisticsCompleted {

        public $team_id;
        public $team_name;
        public $total_matches;
        public $win;
        public $lose;
        public $successful_effort;
        public $total_effort;
        public $successful_freethrow;
        public $total_freethrow;
        public $successful_twopointer;
        public $total_twopointer;
        public $successful_threepointer;
        public $total_threepointer;
        public $steal;
        public $assist;
        public $block;
        public $rebound;
        public $foul;
        public $turnover;

        public function __construct($team_id, $total_matches, $win, $lose, $successful_effort, $total_effort, $successful_freethrow, 
        $total_freethrow, $successful_twopointer, $total_twopointer, $successful_threepointer, $total_threepointer, $steal, $assist, 
        $block, $rebound, $foul, $turnover, $mysqli){
            $this->team_id = $team_id;
            $this->team_name = $this->get_team_name($mysqli);
            $this->total_matches = $total_matches;
            $this->win = $win;
            $this->lose = $lose;
            $this->successful_effort = $successful_effort;
            $this->total_effort = $total_effort;
            $this->successful_freethrow = $successful_freethrow;
            $this->total_freethrow = $total_freethrow;
            $this->successful_twopointer = $successful_twopointer;
            $this->total_twopointer = $total_twopointer;
            $this->successful_threepointer = $successful_threepointer;
            $this->total_threepointer = $total_threepointer;
            $this->steal = $steal;
            $this->assist = $assist;
            $this->block = $block;
            $this->rebound = $rebound;
            $this->foul = $foul;
            $this->turnover = $turnover;
        }

        //Getting the team name by the id
        function get_team_name($mysqli) {
            $sql = "SELECT * FROM `team` WHERE `id` = $this->team_id";
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