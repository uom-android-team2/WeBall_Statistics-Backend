<?php

        
    require_once "repository/crudRepository.php";
    require_once "models/playerLiveStatistics.php";


    class PlayerLivestatisticsRepository implements CRUDRepository{
     
        private $table;
        private $mysqli;

        public function __construct($table, $mysqli){
            $this->table = $table;
            $this->mysqli = $mysqli;
        }


        public function findBy2Id($matchId, $playerId){
            $playerLivestatistics = null;
            try{
                $sql = "SELECT * FROM $this->table WHERE `match_id` = $matchId AND `player_id` = $playerId";
                $result = $this->mysqli->query($sql);
                $row = $result->fetch_assoc();
                if($result->num_rows > 0){
                    $playerLivestatistics = new PlayerLivestatistics($row["match_id"], $row["player_id"], $row["successful_effort"], $row["total_effort"], $row["successful_freethrow"], $row["total_freethrow"], $row["successful_twopointer"], $row["total_twopointer"], $row["successful_threepointer"], $row["total_threepointer"], $row["steal"], $row["assist"], $row["block"], $row["rebound"], $row["foul"], $row["turnover"], $row["minutes"]);
                }
                
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
            
            return $playerLivestatistics;
        }

        public function findById($id){
            // return null;
        }
        
        public function findAll(){

            $playerLivestatistics = array();
            try{
                $sql = "SELECT * FROM $this->table";
                $result = $this->mysqli->query($sql);
                while($row = $result->fetch_assoc()){
                    $playerLivestatistics[] = new PlayerLivestatistics($row["match_id"], $row["player_id"], $row["successful_effort"], $row["total_effort"], $row["successful_freethrow"], $row["total_freethrow"], $row["successful_twopointer"], $row["total_twopointer"], $row["successful_threepointer"], $row["total_threepointer"], $row["steal"], $row["assist"], $row["block"], $row["rebound"], $row["foul"], $row["turnover"], $row["minutes"]);
                }
                
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
            
            return $playerLivestatistics;             

        }
        
        public function deleteById($id){
            try {
                $sql = " DELETE FROM `$this->table` WHERE `id` = $id";
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
            try {
               //sql insert playerLiveStatistics
                $sql = "INSERT INTO `$this->table` (`match_id`, `player_id`, `successful_effort`, `total_effort`, `successful_freethrow`, `total_freethrow`, `successful_twopointer`, `total_twopointer`, `successful_threepointer`, `total_threepointer`, `steal`, `assist`, `block`, `rebound`, `foul`, `turnover`, `minutes`) VALUES ('$entity->match_id', '$entity->player_id', '$entity->successful_effort', '$entity->total_effort', '$entity->successful_freethrow', '$entity->total_freethrow', '$entity->successful_twopointer', '$entity->total_twopointer', '$entity->successful_threepointer', '$entity->total_threepointer', '$entity->steal', '$entity->assist', '$entity->block', '$entity->rebound', '$entity->foul', '$entity->turnover', '$entity->minutes')";

                $result = $this->mysqli->query($sql);
                return $this->findAll();
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            } 
        }
        
        public function update($entity){

        }
        
        
        public function count(){

        }


    }   

?>