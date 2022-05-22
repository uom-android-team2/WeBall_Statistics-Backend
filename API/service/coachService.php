<?php

    include "repository/coachRepository/coachRepository.php";

    class CoachService{
        private $coachRepository;
        
        public function __construct($table, $mysqliConnection){
            $this->coachRepository = new CoachRepository($table, $mysqliConnection);
        }
        
        public function findCoachById($id){
            return $this->coachRepository->findById($id);
        }
        
        public function findAllCoaches(){
            return $this->coachRepository->findAll();
        }
        
        public function deleteCoachById($id){
            return $this->coachRepository->deleteById($id);
        }
        
        public function deleteAllCoaches(){
            return $this->coachRepository->deleteAll();
        }

        public function updateCoach($entity){
            return $this->coachRepository->update($entity);
        }
    }

?>