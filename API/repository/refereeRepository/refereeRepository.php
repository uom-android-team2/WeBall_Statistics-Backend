<?php 

    // referee repository that implements CRUDRepository
    require_once "repository/crudRepository.php";
    require_once "models/referee.php";

    // create class refereeRepository that extends CRUDRepository   // <?php
    class RefereeRepository implements CRUDRepository {

        private $table;
        private $mysqli;

        public function __construct($table, $mysqli){
            $this->table = $table;
            $this->mysqli = $mysqli;
        }

        public function findById($id){
            $referee = null;
            try {
                $sql = "SELECT * FROM `$this->table` WHERE `id` = $id";
                $result = $this->mysqli->query($sql);
                $row = $result->fetch_assoc();
                if($result->num_rows > 0){
                    $referee = new Referee($row["id"], $row["firstname"], $row["surname"]);
                }
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }

            return $referee;

        }
        public function findAll(){
            $data = array();
            try {
                $sql = "SELECT * FROM `$this->table`";   
                $result = $this->mysqli->query($sql);
                while($row = $result->fetch_assoc()) {
                    $referee = new Referee($row["id"], $row["firstname"], $row["surname"]);
                    array_push($data, $referee);
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
                $sql = " DELETE FROM `$this->table` WHERE 1 = 1";
                $result = $this->mysqli->query($sql);
                return $this->findAll();
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            } 
        }

        public function save($entity){
            try {
                $sql = "INSERT INTO `$this->table` (`id`, `firstname`, `surname`) VALUES (NULL, '$entity->firstname', '$entity->surname')";
                $result = $this->mysqli->query($sql);
                return $this->findAll();
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            } 
        }
        
        public function update($entity){
           
            try {
                $refereeFound = $this->findById($entity->id);
                if($refereeFound == null){
                    return "Referee doesn't exist";
                }

                $firstname = $refereeFound->firstname;
                $surname = $refereeFound->surname;

                if(property_exists($entity, 'firstname') && strcmp($entity->firstname, "") !== 0 && strcmp($firstname, $entity->firstname) !== 0){
                    $firstname = $entity->firstname;
                }
                if(property_exists($entity, 'surname') && strcmp($entity->surname, "") !== 0 && strcmp($surname, $entity->surname) !== 0){
                    $surname = $entity->surname;
                }
                
                $sql = "UPDATE `$this->table` SET `firstname` = '$firstname', `surname` = '$surname' WHERE `id` = $entity->id";
                $result = $this->mysqli->query($sql);
                
                return $this->findById($refereeFound->id);
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
        }
    
        public function count(){

        }
    
    }

?>