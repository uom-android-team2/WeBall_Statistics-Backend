<?php

        
    require_once "repository/crudRepository.php";
    require_once "models/teamLiveStatistics.php";


    class TeamLiveStatisticsRepository implements CRUDRepository{
     
        private $table;
        private $mysqli;

        public function __construct($table, $mysqli){
            $this->table = $table;
            $this->mysqli = $mysqli;
        }


        public function findBy2Id($matchId, $team_id){
            $teamLiveStatistics = null;
            try{
                $sql = "SELECT * FROM $this->table WHERE `match_id` = $matchId AND `team_id` = $team_id";
                $result = $this->mysqli->query($sql);
                $row = $result->fetch_assoc();
                if($result->num_rows > 0){
                    // create new TeamLiveStatistics object
                    $teamLiveStatistics = new TeamLiveStatistics($row['match_id'], $row['team_id'], $row['successful_effort'], $row['total_effort'], $row['successful_freethrow'], $row['total_freethrow'], $row['succesful_twopointer'], $row['total_twopointer'], $row['succesful_threepointer'], $row['total_threepointer'], $row['steal'], $row['assist'], $row['block'], $row['rebound'], $row['foul'], $row['turnover']);
                }
                
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
            
            return $teamLiveStatistics;
        }

        public function findById($id){
            // return null;
        }
        
        public function findAll(){

            $teamLiveStatistics = array();
            try{
                $sql = "SELECT * FROM $this->table";
                $result = $this->mysqli->query($sql);
                while($row = $result->fetch_assoc()){
                    $teamLiveStatistics[] = new TeamLiveStatistics($row['match_id'], $row['team_id'], $row['successful_effort'], $row['total_effort'], $row['successful_freethrow'], $row['total_freethrow'], $row['successful_twopointer'], $row['total_twopointer'], $row['successful_threepointer'], $row['total_threepointer'], $row['steal'], $row['assist'], $row['block'], $row['rebound'], $row['foul'], $row['turnover']);
                }   
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }

            return $teamLiveStatistics;
        }
        
        public function deleteById($matchId){
            try {
                $sql = " DELETE FROM `$this->table` WHERE `match_id` = $matchId";
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
               //sql insert teamLiveStatistics
                $sql = "INSERT INTO `$this->table` (`match_id`, `team_id`, `successful_effort`, `total_effort`, `successful_freethrow`, `total_freethrow`, `successful_twopointer`, `total_twopointer`, `successful_threepointer`, `total_threepointer`, `steal`, `assist`, `block`, `rebound`, `foul`, `turnover`) VALUES ('$entity->match_id', '$entity->team_id', '$entity->successful_effort', '$entity->total_effort', '$entity->successful_freethrow', '$entity->total_freethrow', '$entity->succesful_twopointer', '$entity->total_twopointer', '$entity->succesful_threepointer', '$entity->total_threepointer', '$entity->steal', '$entity->assist', '$entity->block', '$entity->rebound', '$entity->foul', '$entity->turnover')";
                $result = $this->mysqli->query($sql);
                return $this->findAll();
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            } 
        }
        
        public function update($entity){

            

            try {
                $teamLivestatisticsFound = $this->findBy2Id($entity->match_id, $entity->team_id);

                if($teamLivestatisticsFound == null){
                    return "doesn't exist";
                }
                
                $successful_effort = $entity->successful_effort;
                $total_effort = $entity->total_effort;
                $successful_freethrow = $entity->successful_freethrow;
                $total_freethrow = $entity->total_freethrow;
                $succesful_twopointer = $entity->succesful_twopointer;
                $total_twopointer = $entity->total_twopointer;
                $succesful_threepointer = $entity->succesful_threepointer;
                $total_threepointer = $entity->total_threepointer;
                $steal = $entity->steal;
                $assist = $entity->assist;
                $block = $entity->block;
                $rebound = $entity->rebound;
                $foul = $entity->foul;
                $turnover = $entity->turnover;



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

               // sql query for update teamLivestatistics
                $sql = "UPDATE `$this->table` SET successful_effort = '$successful_effort', total_effort = '$total_effort', successful_freethrow = '$successful_freethrow', total_freethrow = '$total_freethrow', succesful_twopointer = '$succesful_twopointer', total_twopointer = '$total_twopointer', succesful_threepointer = '$succesful_threepointer', total_threepointer = '$total_threepointer', steal = '$steal', assist = '$assist', block = '$block', rebound = '$rebound', foul = '$foul', turnover = '$turnover' WHERE match_id = '$entity->match_id' AND team_id = '$entity->team_id'";
                $result = $this->mysqli->query($sql);
                
                return $this->findBy2Id($teamLivestatisticsFound->match_id, $teamLivestatisticsFound->team_id);
    
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
         
        }
        
        
        public function count(){

        }


    }   

?>