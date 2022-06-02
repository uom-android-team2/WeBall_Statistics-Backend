<?php 

    require_once "repository/crudRepository.php";
    require_once "models/teamStatisticsCompleted.php";

    class TeamStatisticsCompletedRepository implements CRUDRepository {

        private $table;
        private $mysqli;

        public function __construct($table, $mysqli){
            $this->table = $table;
            $this->mysqli = $mysqli;
        }

        public function findById($id){
            $teamStatsCompleted = null;
            try {
                $sql = "SELECT * FROM `$this->table` WHERE `team_id` = $id";
                $result = $this->mysqli->query($sql);
                $row = $result->fetch_assoc();
                if($result->num_rows > 0){
                    $teamStatsCompleted = new TeamStatisticsCompleted($row["team_id"], $row["total_matches"], $row["win"], $row["lose"], $row["succesful_effort"], 
                    $row["total_effort"], $row["successful_freethrow"], $row["total_freethrow"], $row["succesful_twopointer"], $row["total_twopointer"], 
                    $row["succesful_threepointer"], $row["total_threepointer"], $row["steal"], $row["assist"], $row["block"], $row["rebound"], $row["foul"], $row["turnover"], $this->mysqli);
                }
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }

            return $teamStatsCompleted;
        }

        public function findAll(){
            $data = array();
            try {
                $sql = "SELECT * FROM `$this->table`";   
                $result = $this->mysqli->query($sql);
                while($row = $result->fetch_assoc()) {
                    $teamStatsCompleted = new TeamStatisticsCompleted($row["team_id"], $row["total_matches"], $row["win"], $row["lose"], $row["succesful_effort"], 
                    $row["total_effort"], $row["successful_freethrow"], $row["total_freethrow"], $row["succesful_twopointer"], $row["total_twopointer"], 
                    $row["succesful_threepointer"], $row["total_threepointer"], $row["steal"], $row["assist"], $row["block"], $row["rebound"], $row["foul"], 
                    $row["turnover"], $this->mysqli);
                    array_push($data, $teamStatsCompleted);
                }
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
            return $data;
        }

        public function deleteById($id){
            try {
                $sql = " DELETE FROM `$this->table` WHERE `team_id` = $id";
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
                $sql = "INSERT INTO `$this->table` (`team_id`, `total_matches`, `win`, `lose`, `succesful_effort`, `total_effort`, `successful_freethrow`, `total_freethrow`, `succesful_twopointer`, `total_twopointer`, `succesful_threepointer`, `total_threepointer`, `steal`, `assist`, `block`, `rebound`, `foul`, `turnover`) VALUES ('$entity->team_id', '$entity->total_matches', '$entity->win', '$entity->lose', '$entity->succesful_effort', '$entity->total_effort', '$entity->successful_freethrow', '$entity->total_freethrow', '$entity->succesful_twopointer', '$entity->total_twopointer', '$entity->succesful_threepointer', '$entity->total_threepointer', '$entity->steal', '$entity->assist', '$entity->block', '$entity->rebound', '$entity->foul', '$entity->turnover')";
                $result = $this->mysqli->query($sql);
                return $this->findAll();
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            } 
        }
        
        public function update($entity){
           
            try {
                $teamStatsCompletedFound = $this->findById($entity->team_id);
                if($teamStatsCompletedFound == null){
                    return "Seasson Statistics for this Team doesn't exist";
                }

                $team_id = $teamStatsCompletedFound->team_id;
                $total_matches = $teamStatsCompletedFound->total_matches;
                $win = $teamStatsCompletedFound->win;
                $lose = $teamStatsCompletedFound->lose;
                $succesful_effort = $teamStatsCompletedFound->succesful_effort;
                $total_effort = $teamStatsCompletedFound->total_effort;
                $successful_freethrow = $teamStatsCompletedFound->successful_freethrow;
                $total_freethrow = $teamStatsCompletedFound->total_freethrow;
                $succesful_twopointer = $teamStatsCompletedFound->succesful_twopointer;
                $total_twopointer = $teamStatsCompletedFound->total_twopointer;
                $succesful_threepointer = $teamStatsCompletedFound->succesful_threepointer;
                $total_threepointer = $teamStatsCompletedFound->total_threepointer;
                $steal = $teamStatsCompletedFound->steal;
                $assist = $teamStatsCompletedFound->assist;
                $block = $teamStatsCompletedFound->block;
                $rebound = $teamStatsCompletedFound->rebound;
                $foul = $teamStatsCompletedFound->foul;
                $turnover = $teamStatsCompletedFound->turnover;

                if(property_exists($entity, 'team_id') && strcmp($entity->team_id, "") !== 0 && strcmp($team_id, $entity->team_id) !== 0){
                    $team_id = $entity->team_id;
                }

                if(property_exists($entity, 'total_matches') && strcmp($entity->total_matches, "") !== 0 && strcmp($total_matches, $entity->total_matches) !== 0){
                    $total_matches = $entity->total_matches;
                }

                if(property_exists($entity, 'win') && strcmp($entity->win, "") !== 0 && strcmp($win, $entity->win) !== 0){
                    $win = $entity->win;
                }

                if(property_exists($entity, 'lose') && strcmp($entity->lose, "") !== 0 && strcmp($lose, $entity->lose) !== 0){
                    $lose = $entity->lose;
                }

                if(property_exists($entity, 'succesful_effort') && strcmp($entity->succesful_effort, "") !== 0 && strcmp($succesful_effort, $entity->succesful_effort) !== 0){
                    $succesful_effort = $entity->succesful_effort;
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

                if(property_exists($entity, 'succesful_twopointer') && strcmp($entity->succesful_twopointer, "") !== 0 && strcmp($succesful_twopointer, $entity->succesful_twopointer) !== 0){
                    $succesful_twopointer = $entity->succesful_twopointer;
                }

                if(property_exists($entity, 'total_twopointer') && strcmp($entity->total_twopointer, "") !== 0 && strcmp($total_twopointer, $entity->total_twopointer) !== 0){
                    $total_twopointer = $entity->total_twopointer;
                }

                if(property_exists($entity, 'succesful_threepointer') && strcmp($entity->succesful_threepointer, "") !== 0 && strcmp($succesful_threepointer, $entity->succesful_threepointer) !== 0){
                    $succesful_threepointer = $entity->succesful_threepointer;
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
                
                $sql = "UPDATE `$this->table` SET total_matches = '$total_matches', win = '$win', lose = '$lose', succesful_effort = '$succesful_effort', total_effort = '$total_effort', successful_freethrow = '$successful_freethrow', total_freethrow = '$total_freethrow', succesful_twopointer = '$succesful_twopointer', total_twopointer = '$total_twopointer', succesful_threepointer = '$succesful_threepointer', total_threepointer = '$total_threepointer', steal = '$steal', assist = '$assist', block = '$block', rebound = '$rebound', foul = '$foul', turnover = '$turnover' WHERE team_id = '$team_id'";
                $result = $this->mysqli->query($sql);
                
                return $this->findById($teamStatsCompletedFound->team_id);
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
        }
    
        public function count(){

        }
    }

?>