<?php 

    require_once "repository/crudRepository.php";
    require_once "models/playerStatisticsCompleted.php";

    class PlayerStatisticsCompletedRepository implements CRUDRepository {

        private $table;
        private $mysqli;

        public function __construct($table, $mysqli){
            $this->table = $table;
            $this->mysqli = $mysqli;
        }

        public function findById($id){
            $playerStatsCompleted = null;
            try {
                $sql = "SELECT * FROM `$this->table` WHERE `player_id` = $id";
                $result = $this->mysqli->query($sql);
                $row = $result->fetch_assoc();
                if($result->num_rows > 0){
                    $playerStatsCompleted = new PlayerStatisticsCompleted($row["player_id"], $row["matches_played"], $row["successful_effort"], $row["total_effort"], $row["successful_freethrow"], $row["total_freethrow"], $row["successful_twopointer"], 
                    $row["total_twopointer"], $row["successful_threepointer"], $row["total_threepointer"], $row["steal"], $row["assist"], 
                    $row["block"], $row["rebound"], $row["foul"], $row["turnover"], $row["minutes"], $this->mysqli);
                }
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }

            return $playerStatsCompleted;
        }

        public function findAll(){
            $data = array();
            try {
                $sql = "SELECT * FROM `$this->table`";   
                $result = $this->mysqli->query($sql);
                while($row = $result->fetch_assoc()) {
                    $playerStatsCompleted = new PlayerStatisticsCompleted($row["player_id"], $row["matches_played"], $row["successful_effort"], $row["total_effort"], $row["successful_freethrow"], $row["total_freethrow"], $row["successful_twopointer"], 
                    $row["total_twopointer"], $row["successful_threepointer"], $row["total_threepointer"], $row["steal"], $row["assist"], 
                    $row["block"], $row["rebound"], $row["foul"], $row["turnover"], $row["minutes"], $this->mysqli);
                    array_push($data, $playerStatsCompleted);
                }
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
            return $data;
        }

        public function deleteById($id){
            try {
                $sql = " DELETE FROM `$this->table` WHERE `player_id` = $id";
                $result = $this->mysqli->query($sql);
                return $this->findAll();
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            } 
        }
        
        public function deleteAll(){
            try {
                $sql = " DELETE FROM `$this->table`";
                $result = $this->mysqli->query($sql);
                return $this->findAll();
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            } 
        }

        public function save($entity){
            try {
                $sql = "INSERT INTO `$this->table` (`player_id`, `matches_played`, `successful_effort`, `total_effort`, `successful_freethrow`, `total_freethrow`, `successful_twopointer`, `total_twopointer`, `successful_threepointer`, `total_threepointer`, `steal`, `assist`, `block`, `rebound`, `foul`, `turnover`, `minutes`) VALUES ('$entity->player_id', '$entity->matches_played', '$entity->successful_effort', '$entity->total_effort', '$entity->successful_freethrow', '$entity->total_freethrow', '$entity->successful_twopointer', '$entity->total_twopointer', '$entity->successful_threepointer', '$entity->total_threepointer', '$entity->steal', '$entity->assist', '$entity->block', '$entity->rebound', '$entity->foul', '$entity->turnover', '$entity->minutes')";
                $result = $this->mysqli->query($sql);
                return $this->findAll();
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            } 
        }
        
        public function update($entity){
           
            try {
                $playerStatsCompletedFound = $this->findById($entity->player_id);
                if($playerStatsCompletedFound == null){
                    return "Seasson Statistics for this Player don't exist";
                }

                $player_id = $playerStatsCompletedFound->player_id;
                $matches_played = $playerStatsCompletedFound->matches_played;
                $successful_effort = $playerStatsCompletedFound->successful_effort;
                $total_effort = $playerStatsCompletedFound->total_effort;
                $successful_freethrow = $playerStatsCompletedFound->successful_freethrow;
                $total_freethrow = $playerStatsCompletedFound->total_freethrow;
                $successful_twopointer = $playerStatsCompletedFound->successful_twopointer;
                $total_twopointer = $playerStatsCompletedFound->total_twopointer;
                $successful_threepointer = $playerStatsCompletedFound->successful_threepointer;
                $total_threepointer = $playerStatsCompletedFound->total_threepointer;
                $steal = $playerStatsCompletedFound->steal;
                $assist = $playerStatsCompletedFound->assist;
                $block = $playerStatsCompletedFound->block;
                $rebound = $playerStatsCompletedFound->rebound;
                $foul = $playerStatsCompletedFound->foul;
                $turnover = $playerStatsCompletedFound->turnover;
                $minutes = $playerStatsCompletedFound->minutes;

                if(property_exists($entity, 'player_id') && strcmp($entity->player_id, "") !== 0 && strcmp($player_id, $entity->player_id) !== 0){
                    $player_id = $entity->player_id;
                }

                if(property_exists($entity, 'matches_played') && strcmp($entity->matches_played, "") !== 0 && strcmp($matches_played, $entity->matches_played) !== 0){
                    $matches_played = $entity->matches_played;
                }

                if(property_exists($entity, 'successful_effort') && strcmp($entity->successful_effort, "") !== 0 && strcmp($successful_effort, $entity->successful_effort) !== 0){
                    $successful_effort = $entity->successful_effort;
                }

                if(property_exists($entity, 'total_effort') && strcmp($entity->total_effort, "") !== 0 && strcmp($total_effort, $entity->total_effort) !== 0){
                    $total_effort = $entity->total_effort;
                }

                if(property_exists($entity, 'successful_freethrow') && strcmp($entity->successful_freethrow, "") !== 0 && strcmp($successful_freethrow, $entity->successful_freethrow) !== 0){
                    $successful_freethrow = $entity->successful_freethrow;
                }

                if(property_exists($entity, 'total_freethrow') && strcmp($entity->total_freethrow, "") !== 0 && strcmp($total_freethrow, $entity->total_freethrow) !== 0){
                    $total_freethrow = $entity->total_freethrow;
                }

                if(property_exists($entity, 'successful_twopointer') && strcmp($entity->successful_twopointer, "") !== 0 && strcmp($successful_twopointer, $entity->successful_twopointer) !== 0){
                    $successful_twopointer = $entity->successful_twopointer;
                }

                if(property_exists($entity, 'total_twopointer') && strcmp($entity->total_twopointer, "") !== 0 && strcmp($total_twopointer, $entity->total_twopointer) !== 0){
                    $total_twopointer = $entity->total_twopointer;
                }

                if(property_exists($entity, 'successful_threepointer') && strcmp($entity->successful_threepointer, "") !== 0 && strcmp($successful_threepointer, $entity->successful_threepointer) !== 0){
                    $successful_threepointer = $entity->successful_threepointer;
                }

                if(property_exists($entity, 'total_threepointer') && strcmp($entity->total_threepointer, "") !== 0 && strcmp($total_threepointer, $entity->total_threepointer) !== 0){
                    $total_threepointer = $entity->total_threepointer;
                }

                if(property_exists($entity, 'steal') && strcmp($entity->steal, "") !== 0 && strcmp($steal, $entity->steal) !== 0){
                    $steal = $entity->steal;
                }

                if(property_exists($entity, 'assist') && strcmp($entity->assist, "") !== 0 && strcmp($assist, $entity->assist) !== 0){
                    $assist = $entity->assist;
                }

                if(property_exists($entity, 'block') && strcmp($entity->block, "") !== 0 && strcmp($block, $entity->block) !== 0){
                    $block = $entity->block;
                }

                if(property_exists($entity, 'rebound') && strcmp($entity->rebound, "") !== 0 && strcmp($rebound, $entity->rebound) !== 0){
                    $rebound = $entity->rebound;
                }

                if(property_exists($entity, 'foul') && strcmp($entity->foul, "") !== 0 && strcmp($foul, $entity->foul) !== 0){
                    $foul = $entity->foul;
                }

                if(property_exists($entity, 'turnover') && strcmp($entity->turnover, "") !== 0 && strcmp($turnover, $entity->turnover) !== 0){
                    $turnover = $entity->turnover;
                }

                if(property_exists($entity, 'minutes') && strcmp($entity->minutes, "") !== 0 && strcmp($minutes, $entity->minutes) !== 0){
                    $minutes = $entity->minutes;
                }

                $sql = "UPDATE `$this->table` SET matches_played = '$matches_played', successful_effort = '$successful_effort', total_effort = '$total_effort', successful_freethrow = '$successful_freethrow', total_freethrow = '$total_freethrow', successful_twopointer = '$successful_twopointer', total_twopointer = '$total_twopointer', successful_threepointer = '$successful_threepointer', total_threepointer = '$total_threepointer', steal = '$steal', assist = '$assist', block = '$block', rebound = '$rebound', foul = '$foul', turnover = '$turnover', minutes = '$minutes' WHERE player_id = '$player_id'";
                $result = $this->mysqli->query($sql);
                
                return $this->findById($playerStatsCompletedFound->player_id);
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
        }
    
        public function count(){

        }
    }

?>