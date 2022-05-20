<?php

    // import the class 
    include "repository/refereeRepository/refereeRepository.php";

    class RefereeService{
        private $refereeRepository;
        
        public function __construct($table, $mysqliConnection){
            $this->refereeRepository = new RefereeRepository($table, $mysqliConnection);
        }
        
        public function findRefereeById($id){
            return $this->refereeRepository->findById($id);
        }
        
        public function findAllReferees(){
            return $this->refereeRepository->findAll();
        }
        
        public function deleteRefereeById($id){
            return $this->refereeRepository->deleteById($id);
        }
        
        public function deleteAllRefereer(){
            return $this->refereeRepository->deleteAll();
        }

        public function updateReferee($entity){
            return $this->refereeRepository->update($entity);
        }
    }

?>