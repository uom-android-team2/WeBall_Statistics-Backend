<?php 

    require_once "repository/crudRepository.php";
    require_once "models/playerStatsLive.php";


        
    class PlayerStatsLiveRepository implements CRUDRepository {

        private $table;
        private $mysqli;

        public function __construct($table, $mysqli){
            $this->table = $table;
            $this->mysqli = $mysqli;
        }

        public function findById($id){  
            $player = null;
            try{
                $sql = "SELECT * FROM `$this->table` WHERE `player_id` = $id";
                $result = $this->mysqli->query($sql);
                $row = $result->fetch_assoc();
                if($result->num_rows > 0){
                    $player = new PlayerStatsLive($row["player_id"], $row["match_id"], $row["successful_effort"], $row["total_effort"], $row["successful_freethrow"], $row["total_freethrow"], $row["successful_twopointer"], $row["total_twopointer"], $row["successful_threepointer"], $row["total_threepointer"], $row["steel"], $row["assist"], $row["block"], $row["rebound"], $row["foul"], $row["turnover"], $row["minutes"]);
                }
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }

            return $player;

        }
        public function findAll(){
            $data = array();
            try {
                $sql = "SELECT * FROM `$this->table`";   
                $result = $this->mysqli->query($sql);
                while($row = $result->fetch_assoc()) {
                    $player = new playerStatsLive($row["player_id"], $row["match_id"], $row["successful_effort"], $row["total_effort"], $row["successful_freethrow"], $row["total_freethrow"], $row["successful_twopointer"], $row["total_twopointer"], $row["successful_threepointer"], $row["total_threepointer"], $row["steel"], $row["assist"], $row["block"], $row["rebound"], $row["foul"], $row["turnover"], $row["minutes"]);
                    array_push($data, $player);
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
                $sql = " DELETE FROM `$this->table` WHERE 1 = 1";
                $result = $this->mysqli->query($sql);
                return $this->findAll();
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            } 
        }
        public function save($entity){

        }
        public function update($entity){
            try {
                $playerFound = $this->findById($entity->id);

                if($playerFound == null){
                    return "team doesn't exist";
                }
    
                $player_id = $playerFound->player_id;
                $match_id = $playerFound->match_id;
                $successful_effort = $playerFound->successful_effort;
                $total_effort = $playerFound->total_effort;
                $successful_freethrow = $playerFound->successful_freethrow;
                $total_freethrow = $playerFound->total_freethrow;
                $successful_twopointer = $playerFound->successful_twopointer;
                $total_twopointer = $playerFound->total_twopointer;
                $successful_threepointer = $playerFound->successful_threepointer;
                $total_threepointer = $playerFound->total_threepointer;
                $steel = $playerFound->steel;
                $assist = $playerFound->assist;
                $block = $playerFound->block;
                $rebound = $playerFound->rebound;
                $foul = $playerFound->foul;
                $turnover = $playerFound->turnover;
                $minutes = $playerFound->minutes;
                
                
                if(property_exists($entity, 'player_id') && strcmp($entity->player_id, "") !== 0 && strcmp($player_id, $entity->player_id) !== 0){
                    $player_id = $entity->player_id;
                }

                if(property_exists($entity, 'match_id') && strcmp($entity->match_id, "") !== 0 && strcmp($match_id, $entity->match_id) !== 0){
                    $match_id = $entity->match_id;
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

                if(property_exists($entity, 'steel') && strcmp($entity->steel, "") !== 0 && strcmp($steel, $entity->steel) !== 0){
                    $steel = $entity->steel;
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
                
                $sql = "UPDATE `$this->table` SET `player_id` = '$player_id', `match_id` = '$match_id', `successful_effort` = '$successful_effort', `total_effort` = '$total_effort', `successful_freethrow` = '$successful_freethrow', `total_freethrow` = '$total_freethrow', `successful_twopointer` = '$successful_twopointer', `total_twopointer` = '$total_twopointer', `successful_threepointer` = '$successful_threepointer', `total_threepointer` = '$total_threepointer', `successful_freethrow` = '$successful_freethrow', `steel` = '$steel', `assist` = '$assist', `block` = '$block', `rebound` = '$rebound', `foul` = '$foul', `turnover` = '$turnover', `minutes` = '$minutes' WHERE `player_id` = $entity->player_id";
                $result = $this->mysqli->query($sql);
                
                return $this->findById($playerFound->id);
    
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
        }
        public function count(){

        }

    }




?>
