<?php
// CREATE TABLE championship.`player_live_statistics`(
//     `player_id` int(144) UNSIGNED NOT NULL,
//     `match_id`int(12) UNSIGNED NOT NULL,
//     `successful_effort` int  UNSIGNED NOT NULL,
//     `total_effort`int UNSIGNED NOT NULL,
//     `successful_freethrow`int UNSIGNED NOT NULL,
//     `total_freethrow` int UNSIGNED NOT NULL,
//     `successful_twopointer` int UNSIGNED NOT NULL,
//     `total_twopointer` int UNSIGNED NOT NULL,
//     `successful_threepointer` int UNSIGNED NOT NULL,
//     `total_threepointer` int UNSIGNED NOT NULL,
//     `steel` int UNSIGNED NOT NULL,
//     `assist` int UNSIGNED NOT NULL,
//     `block` int UNSIGNED NOT NULL,
//     `rebound` int UNSIGNED NOT NULL,
//     `foul` int UNSIGNED NOT NULL,
//     `turnover`int UNSIGNED NOT NULL,
//     `minutes`datetime NOT NULL
//   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

class playerStatsLive {

    public $player_id;
    public $match_id;
    public $successful_effort;
    public $total_effort;
    public $successful_freethrow;
    public $total_freethrow;
    public $successful_twopointer;
    public $total_twopointer;
    public $successful_threepointer;
    public $total_threepointer;
    public $steel;
    public $assist;
    public $block;
    public $rebound;
    public $foul;
    public $turnover;
    public $minutes;
    


    public function __construct($player_id, $match_id, $successful_effort, $total_effort, $successful_freethrow, $total_freethrow, $successful_twopointer, $total_twopointer, $successful_threepointer, $total_threepointer, $steel, $assist, $block, $rebound, $foul, $turnover, $minutes){
        $this->player_id = $player_id;
        $this->match_id = $match_id;
        $this->successful_effort = $successful_effort;
        $this->total_effort = $total_effort;
        $this->successful_freethrow = $successful_freethrow;
        $this->total_freethrow = $total_freethrow;
        $this->successful_twopointer = $successful_twopointer; 
        $this->total_twopointer = $total_twopointer;
        $this->successful_threepointer = $successful_threepointer;
        $this->total_threepointer = $total_threepointer;
        $this->steel = $steel;
        $this->assist = $assist;
        $this->block = $block;
        $this->rebound = $rebound;
        $this->foul = $foul;
        $this->turnover = $turnover;
        $this->minutes = $minutes;
    }

    public function print_info(){
        echo "Player id: ". $this->player_id . " Match id: " . $this->match_id . " Successful effort: " . $this->successful_effort . " Total efort: " . $this->total_effort . " Successful freethrow: " . $this->successful_freethrow . " Total freethrow : " . $this->total_freethrow . " Successful two pointer: " . $this->successful_twopointer . " Total two pointer:" . $this->total_twopointer . " Successful three pointer:" . $this->successful_threepointer . " Total three pointer:" . $this->total_threepointer . " Steel:" . $this->steel . " Assist:" . $this->assist . " Block:" . $this->block . "Rebound:" . $this->rebound . " Foul:" . $this->foul . " Turnover:" . $this->turnover . " Minutes" . $this->minutes;
        echo "<br>";
    }
    
};

?>