<?php 

    require_once "repository/crudRepository.php";
    require_once "models/player.php";


    // if($id != null){
    //     $sql = "SELECT * FROM `player` WHERE `id` = $id";
    // }else{
    //     $sql = "SELECT * FROM `player`";
    // }
    
    // // execute statment
    // try {
    
    //     $result = $mysqli->query($sql);
    //     //Check if data exists
    //     if ($result->num_rows > 0) {
    //         if($id){
    //             $row = $result->fetch_assoc();
    //             $player = new Player($row["id"], $row["name"], $row["surname"], $row["number"], $row["position"], $row["team"], $row["photo"]);
    //             $data = $player;
    //         }else{
    //             while($row = $result->fetch_assoc()) {
    //                 $player = new Player($row["id"], $row["name"], $row["surname"], $row["number"], $row["position"], $row["team"], $row["photo"]);
    //                 array_push($data, $player);
    //             }
    //         }
    //     }
        
    
    class PlayerRepository implements CRUDRepository {

        private $table;
        private $mysqli;

        public function __construct($table, $mysqli){
            $this->table = $table;
            $this->mysqli = $mysqli;
        }

        public function findById($id){  
            $player = null;
            try{
                $sql = "SELECT * FROM `$this->table` WHERE `id` = $id";
                $result = $this->mysqli->query($sql);
                $row = $result->fetch_assoc();
                if($result->num_rows > 0){
                    $player = new Player($row["id"], $row["name"], $row["surname"], $row["number"], $row["position"], $row["team"], $row["photo"]);
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
                    $player = new Player($row["id"], $row["name"], $row["surname"], $row["number"], $row["position"], $row["team"], $row["photo"]);
                    array_push($data, $player);
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

        }
        public function update($entity){
            try {
                $playerFound = $this->findById($entity->id);

                if($playerFound == null){
                    return "team doesn't exist";
                }
    
                $name = $playerFound->name;
                $surname = $playerFound->surname;
                $number = $playerFound->number;
                $position = $playerFound->position;
                $team = $playerFound->team;
                $photo = $playerFound->photo;
                
                if(strcmp($entity->name, "") !== 0 && strcmp($name, $entity->name) !== 0){
                    $name = $entity->name;
                }

                if(strcmp($entity->surname, "") !== 0 && strcmp($surname, $entity->surname) !== 0){
                    $surname = $entity->surname;
                }
                
                if(strcmp($entity->number, "") !== 0 && strcmp($number, $entity->number) !== 0){
                    $number = $entity->number;
                }
                
                if(strcmp($entity->position, "") !== 0 && strcmp($position, $entity->position) !== 0){
                    $position = $entity->position;
                }
                
                if(strcmp($entity->team, "") !== 0 && strcmp($team, $entity->team) !== 0){
                    $team = $entity->team;
                }

                if(strcmp($entity->photo, "") !== 0 && strcmp($photo, $entity->photo) !== 0){
                    $photo = $entity->photo;
                }
                
                $sql = "UPDATE `$this->table` SET `name` = '$name', `surname` = '$surname', `number` = '$number', `position` = '$position', `team` = '$team', `photo` = '$photo' WHERE `id` = $entity->id";
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
