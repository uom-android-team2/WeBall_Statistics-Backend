<?php
    class Team {
        public $id;
        public $name;
        public $city;
        public $badge;

        public function __construct($id, $name, $city, $bagde) {
            $this->id = $id;
            $this->name = $name;
            $this->city = $city;
            $this->badge = $bagde;
        }

        public function print_info(){
            echo "id: ". $this->id . " name: " . $this->name . " city: " . $this->city . " badge path: " . $this->bagde;
            echo "<br>";
        }
    };
?>