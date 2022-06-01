<?php

require_once "repository/crudRepository.php";
require_once "models/team.php";

class TeamRepository implements CRUDRepository{

    private $table;
    private $mysqli;

    public function __construct($table, $mysqli){
        $this->table = $table;
        $this->mysqli = $mysqli;
    }

    public function findById($id){
        $team = null;
        try {
            $sql = "SELECT * FROM `$this->table` WHERE `id` = $id";
            $result = $this->mysqli->query($sql);
            $row = $result->fetch_assoc();
            if($result->num_rows > 0){
                $team = new team($row["id"], $row["name"], $row["city"], $row["badge"]);
            }
        }catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        } 
        return $team;
    }
    
    public function findAll(){
        $data = array();
        try {
            $sql = "SELECT * FROM `$this->table`";   
            $result = $this->mysqli->query($sql);
            while($row = $result->fetch_assoc()) {
                $team = new team($row["id"], $row["name"], $row["city"], $row["badge"]);
                array_push($data, $team);
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
            $sql = "INSERT INTO `$this->table` (`name`, `city`, `badge`) VALUES ('$entity->name', '$entity->city', '$entity->badge')";
            $result = $this->mysqli->query($sql);
            return $this->findAll();
        }catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        } 
    }
    
    public function update($entity){
        try {
            $teamFound = $this->findById($entity->id);
            if($teamFound == null){
                return "team doesn't exist";
            }

            $name = $teamFound->name;
            $city = $teamFound->city;
            $badge = $teamFound->badge;

            if(property_exists($entity, 'name') && strcmp($entity->name, "") !== 0 && strcmp($name, $entity->name) !== 0){
                $name = $entity->name;
            }
            if(property_exists($entity, 'city') && strcmp($entity->city, "") !== 0 && strcmp($city, $entity->city) !== 0){
                $city = $entity->city;
            }
            if(property_exists($entity, 'badge') && strcmp($entity->badge, "") !== 0 && strcmp($badge, $entity->badge) !== 0){
                $badge = $entity->badge;
            }
           
            $sql = "UPDATE `$this->table` SET `name` = '$name', `city` = '$city', `badge` = '$badge' WHERE `id` = $entity->id";
            $result = $this->mysqli->query($sql);
            
            return $this->findById($teamFound->id);

        }catch(Exception $e){
            // echo 'Message: ' .$e->getMessage();
        }
    }
    
    public function count(){
    }
}
?>
