<?php


//  `player_id` int UNSIGNED NOT NULL,
//  `matches_played`int UNSIGNED NOT NULL,
//  `successful_effort` int UNSIGNED NOT NULL,
//  `total_effort` int UNSIGNED NOT NULL,
//  `successful_freethrow`int UNSIGNED NOT NULL,
//  `total_freethrow`int UNSIGNED NOT NULL,
//  `successful_twopointer` int UNSIGNED NOT NULL,
//  `total_twopointer` int UNSIGNED NOT NULL,
//  `successful_threepointer` int UNSIGNED NOT NULL,
//  `total_threepointer` int UNSIGNED NOT NULL,
//  `steal` int UNSIGNED NOT NULL,
//  `assist` int UNSIGNED NOT NULL,
//  `block` int UNSIGNED NOT NULL,
//  `rebound` int UNSIGNED NOT NULL,
//  `foul` int UNSIGNED NOT NULL,
//  `turnover`int UNSIGNED NOT NULL,
//  `minutes`datetime NOT NULL

    class PlayerStatisticsCompleted {

        public $player_id;
        public $player_name;
        public $matches_played;
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
        public $minutes;

        public function __construct($player_id, $matches_played, $successful_effort, $total_effort, $successful_freethrow, $total_freethrow, $successful_twopointer, 
        $total_twopointer, $successful_threepointer, $total_threepointer, $steal, $assist, $block, $rebound, 
        $foul, $turnover, $minutes, $mysqli){
            $this->player_id = $player_id;
            $this->player_name = $this->get_player_name($mysqli);
            $this->matches_played = $matches_played;
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
            $this->minutes = $minutes;
        }

        //Getting the player surename by the id
        function get_player_name($mysqli) {
            $sql = "SELECT * FROM `player` WHERE `id` = $this->player_id";
            $result = $mysqli->query($sql);
            //Check if player with this id found
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row["surname"];
            }
            return null;
        }
    };

?>