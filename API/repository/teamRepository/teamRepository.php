<?php

require_once "repository/crudRepository.php";
require_once "models/team.php";

class TeamRepository implements CRUDRepository{

    public $table;
    public $mysqli;

    public function __construct($table, $mysqli){
        $this->table = $table;
        $this->mysqli = $mysqli;
    }

    public function findById($id){
        try {
            $sql = "SELECT * FROM `$this->table` WHERE `id` = $id";
            $result = $this->mysqli->query($sql);
            $row = $result->fetch_assoc();
            $team = new team($row["id"], $row["name"], $row["city"], $row["badge"]);
            return $team;
        }catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        } 
    }
    
    public function findAll(){
        try {
            $data = array();
            $sql = "SELECT * FROM `$this->table`";   
            $result = $this->mysqli->query($sql);
            while($row = $result->fetch_assoc()) {
                $team = new team($row["id"], $row["name"], $row["city"], $row["badge"]);
                array_push($data, $team);
            }
            return $data;
        }catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        }
    }
    
    public function deleteById($id){
        try {
            $sql = " DELETE FROM $this->table WHERE `id` = $id";
            $result = $this->mysqli->query($sql);
            return $this->findAll();
        }catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        } 
    }
    
    public function deleteAll(){
        try {
            $sql = " DELETE FROM $this->table WHERE 1 = 1";
            $result = $this->mysqli->query($sql);
            return $this->findAll();
        }catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        } 
    }
    
    public function save($entity){

    }
    
    public function update($entity){
        // try {
        //     $teamFound = $this->findById($entity->id);
        //     if(!$teamFound){
        //         return "team doesnt exist";
        //     }
        //     $name = $teamFound->name;
        //     $city = $teamFound->city;
        //     $badge =  $teamFound->badge;

        //     if($teamFound->name != $entity->name && !empty($entity->name)){
        //         $name = $entity->name;
        //     }
        //     if($teamFound->city != $entity->city && !empty($entity->city)){
        //         $city = $entity->city;
        //     }
        //     if($teamFound->badge != $entity->badge && !empty($entity->badge)){
        //         $badge = $entity->badge;
        //     }

        //     $sql = "UPDATE `$this->table`
        //     SET `name` = `$name`, city = `$city`, badge = `$badge`
        //     WHERE `id` = $entity->id;";
        //     $result = $this->mysqli->query($sql);
        //     return $this->findById($entity->id);
        // }catch(Exception $e){
        //     echo 'Message: ' .$e->getMessage();
        // }
    }
    
    public function count(){
    }
}
?>
