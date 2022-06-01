<?php 

    require_once "repository/crudRepository.php";
    require_once "models/coach.php";

    class CoachRepository implements CRUDRepository {

        private $table;
        private $mysqli;

        public function __construct($table, $mysqli){
            $this->table = $table;
            $this->mysqli = $mysqli;
        }

        public function findById($id){
            $coach = null;
            try {
                $sql = "SELECT * FROM `$this->table` WHERE `id` = $id";
                $result = $this->mysqli->query($sql);
                $row = $result->fetch_assoc();
                if($result->num_rows > 0){
                    $coach = new Coach($row["id"], $row["teamid"], $row["firstname"], $row["surname"], $row["headcoach"], $row["image"], $this->mysqli);
                }
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }

            return $coach;
        }

        public function findAll(){
            $data = array();
            try {
                $sql = "SELECT * FROM `$this->table`";   
                $result = $this->mysqli->query($sql);
                while($row = $result->fetch_assoc()) {
                    $coach = new Coach($row["id"], $row["teamid"], $row["firstname"], $row["surname"], $row["headcoach"], $row["image"], $this->mysqli);
                    array_push($data, $coach);
                }
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
            return $data;
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
                $sql = " DELETE FROM `$this->table`";
                $result = $this->mysqli->query($sql);
                return $this->findAll();
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            } 
        }

        public function save($entity){
            try {
                $sql = "INSERT INTO `$this->table` (`id`, `teamid`, `firstname`, `surname`, `headcoach`, `image`) VALUES (NULL, '$entity->teamid', '$entity->firstname', '$entity->surname', '$entity->headcoach', '$entity->image')";
                $result = $this->mysqli->query($sql);
                return $this->findAll();
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            } 
        }
        
        public function update($entity){
           
            try {
                $coachFound = $this->findById($entity->id);
                if($coachFound == null){
                    return "Coach doesn't exist";
                }

                $teamid = $coachFound->teamid;
                $firstname = $coachFound->firstname;
                $surname = $coachFound->surname;
                $headcoach = $coachFound->headcoach;
                $image = $coachFound->image;

                if(property_exists($entity, 'teamid') && strcmp($entity->teamid, "") !== 0 && strcmp($teamid, $entity->teamid) !== 0){
                    $teamid = $entity->teamid;
                }

                if(property_exists($entity, 'firstname') && strcmp($entity->firstname, "") !== 0 && strcmp($firstname, $entity->firstname) !== 0){
                    $firstname = $entity->firstname;
                }

                if(property_exists($entity, 'surname') && strcmp($entity->surname, "") !== 0 && strcmp($surname, $entity->surname) !== 0){
                    $surname = $entity->surname;
                }

                if(property_exists($entity, 'headcoach') && strcmp($entity->headcoach, "") !== 0 && strcmp($headcoach, $entity->headcoach) !== 0){
                    $headcoach = $entity->headcoach;
                }

                if(property_exists($entity, 'image') && strcmp($entity->image, "") !== 0 && strcmp($image, $entity->image) !== 0){
                    $image = $entity->image;
                }
                
                $sql = "UPDATE `$this->table` SET `teamid` = '$teamid', `firstname` = '$firstname', `surname` = '$surname', `headcoach` = $headcoach, `image` = '$image' WHERE `id` = $entity->id";
                $result = $this->mysqli->query($sql);
                
                return $this->findById($coachFound->id);
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
        }
    
        public function count(){

        }
    }

?>