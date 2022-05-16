<?php
// `id` int(12) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
// `name`  VARCHAR(32) NOT NULL,
// `surname`  VARCHAR(32) NOT NULL,
// `number` int(2) UNSIGNED NOT NULL,
// `position`varchar(32) NOT NULL,
// `team` varchar(32) NOT NULL,
// `photo` VARCHAR(255) NOT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

class player {

    public $id;
    public $name;
    public $surname;
    public $number;
    public $position;
    public $team;
    public $photo;


    public function __construct($id, $name, $surname, $number, $position, $team, $photo){
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->number = $number;
        $this->position = $position;
        $this->team = $team;
        $this->photo = $photo; 
    }

    public function print_info(){
        echo "id: ". $this->id . " name: " . $this->name . " surname: " . $this->surname . " number: " . $this->number . " position: " . $this->position . " team: " . $this->team . " photo path: " . $this->photo;
        echo "<br>";
    }
    
};

?>