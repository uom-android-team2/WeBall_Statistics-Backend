<?php
//     `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     `firstname`varchar(32) NOT NULL,
//     `surname`varchar(32) NOT NULL
//   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

class Referee {

    public $id;
    public $firstname;
    public $surname;

    public function __construct($id, $firstname, $surname){
        $this->id = $id;
        $this->firstname = $firstname;
        $this->surname = $surname;
    }
    
};

?>