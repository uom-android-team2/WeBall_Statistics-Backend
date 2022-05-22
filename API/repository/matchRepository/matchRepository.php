<?php

require_once "repository/crudRepository.php";
require_once "models/match.php";

class MatchRepository implements CRUDRepository{

    private $table;
    private $mysqli;

    public function __construct($table, $mysqli){
        $this->table = $table;
        $this->mysqli = $mysqli;
    }

    public function findById($id){
        $match = null;
        try {
            $sql = "SELECT * FROM `$this->table` WHERE `id` = $id";
            $result = $this->mysqli->query($sql);
            $row = $result->fetch_assoc();
            if($result->num_rows > 0){
                $match = new BasketballMatch($row["id"], $row["teamlandlord_id"], $row["teamguest_id"], $row["date"], $row["progress"], $row["completed"], $this->mysqli);
            }
        }catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        } 
        return $match;
    }
    
    public function findAll(){
        $data = array();
        try {
            $sql = "SELECT * FROM `$this->table`";   
            $result = $this->mysqli->query($sql);
            while($row = $result->fetch_assoc()) {
                $match = new BasketballMatch($row["id"], $row["teamlandlord_id"], $row["teamguest_id"], $row["date"], $row["progress"], $row["completed"], $this->mysqli);
                array_push($data, $match);
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

    }
    
    public function update($entity){
        try {
            $matchFound = $this->findById($entity->id);
            if($matchFound == null){
                return "Match doesn't exist";
            }

            $teamlandlord_id = $matchFound->teamlandlord_id;
            $teamguest_id = $matchFound->teamguest_id;
            $date = $matchFound->date;
            $progress = $matchFound->progress;
            $completed = $matchFound->completed;

            if(property_exists($entity, 'teamlandlord_id') && strcmp($entity->teamlandlord_id, "") !== 0 && strcmp($teamlandlord_id, $entity->teamlandlord_id) !== 0){
                $teamlandlord_id = $entity->teamlandlord_id;
            }

            if(property_exists($entity, 'teamguest_id') && strcmp($entity->teamguest_id, "") !== 0 && strcmp($teamguest_id, $entity->teamguest_id) !== 0){
                $teamguest_id = $entity->teamguest_id;
            }

            if(property_exists($entity, 'date') && strcmp($entity->date, "") !== 0 && strcmp($date, $entity->date) !== 0){
                $date = $entity->date;
            }

            if(property_exists($entity, 'progress') && strcmp($entity->progress, "") !== 0 && strcmp($progress, $entity->progress) !== 0){
                $progress = $entity->progress;
            }

            if(property_exists($entity, 'completed') && strcmp($entity->completed, "") !== 0 && strcmp($completed, $entity->completed) !== 0){
                $completed = $entity->completed;
            }
           
            $sql = "UPDATE `$this->table` SET `teamlandlord_id` = '$teamlandlord_id', `teamguest_id` = '$teamguest_id', `date` = '$date', `progress` = $progress, `completed` = $completed WHERE `id` = $entity->id";
            $result = $this->mysqli->query($sql);
            
            return $this->findById($matchFound->id);

        }catch(Exception $e){
            echo 'Message: ' .$e->getMessage();
        }
    }
    
    public function count(){
    }
}
?>
