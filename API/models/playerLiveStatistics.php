<?php

    class PlayerLiveStatistics {
    
        public $match_id;
        public $player_id;
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

        public function __construct($match_id, $player_id, $successful_effort, $total_effort, $successful_freethrow, $total_freethrow, $successful_twopointer, $total_twopointer, $successful_threepointer, $total_threepointer, $steal, $assist, $block, $rebound, $foul, $turnover, $minutes)       {
            $this->match_id = $match_id;
            $this->player_id = $player_id;
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

        // print info function
        public function printInfo() {
            echo "Player ID: " . $this->player_id . "<br>";
            echo "Successful Effort: " . $this->successful_effort . "<br>";
            echo "Total Effort: " . $this->total_effort . "<br>";
            echo "Successful Freethrow: " . $this->successful_freethrow . "<br>";
            echo "Total Freethrow: " . $this->total_freethrow . "<br>";
            echo "Successful Twopointer: " . $this->successful_twopointer . "<br>";
            echo "Total Twopointer: " . $this->total_twopointer . "<br>";
            echo "Successful Threepointer: " . $this->successful_threepointer . "<br>";
            echo "Total Threepointer: " . $this->total_threepointer . "<br>";
            echo "Steal: " . $this->steal . "<br>";
            echo "Assist: " . $this->assist . "<br>";
            echo "Block: " . $this->block . "<br>";
            echo "Rebound: " . $this->rebound . "<br>";
            echo "Foul: " . $this->foul . "<br>";
            echo "Turnover: " . $this->turnover . "<br>";
            echo "Minutes: " . $this->minutes . "<br>";
        }

    }



?>