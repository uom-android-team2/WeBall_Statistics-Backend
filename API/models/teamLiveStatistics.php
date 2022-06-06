<?php

    class TeamLiveStatistics
    {

        public $match_id;
        public $team_id;
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

        
        public function __construct($match_id, $team_id, $successful_effort, $total_effort, $successful_freethrow, $total_freethrow, $successful_twopointer, $total_twopointer, $successful_threepointer, $total_threepointer, $steal, $assist, $block, $rebound, $foul, $turnover)
        {
            $this->match_id = $match_id;
            $this->team_id = $team_id;
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

        // print_info
        public function print_info()
        {
            echo "TeamLiveStatistics: ";
            echo "match_id: " . $this->match_id . " ";
            echo "team_id: " . $this->team_id . " ";
            echo "successful_effort: " . $this->successful_effort . " ";
            echo "total_effort: " . $this->total_effort . " ";
            echo "successful_freethrow: " . $this->successful_freethrow . " ";
            echo "total_freethrow: " . $this->total_freethrow . " ";
            echo "successful_twopointer: " . $this->successful_twopointer . " ";
            echo "total_twopointer: " . $this->total_twopointer . " ";
            echo "successful_threepointer: " . $this->successful_threepointer . " ";
            echo "total_threepointer: " . $this->total_threepointer . " ";
            echo "steal: " . $this->steal . " ";
            echo "assist: " . $this->assist . " ";
            echo "block: " . $this->block . " ";
            echo "rebound: " . $this->rebound . " ";
            echo "foul: " . $this->foul . " ";
            echo "turnover: " . $this->turnover . " ";
            echo "<br>";
        }

    }




?>
