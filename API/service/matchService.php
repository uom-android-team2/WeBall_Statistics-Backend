<?php 
    include "repository/matchRepository/matchRepository.php";
        
    class MatchService {

        private $matchRepository;

        public function __construct($table, $mysqliConnection){
            $this->matchRepository = new MatchRepository($table, $mysqliConnection);
        }

        public function findMatchById($id){
            return $this->matchRepository->findById($id);
        }

        public function findAllMatches(){
            return $this->matchRepository->findAll();
        }

        public function deleteMatchById($id){
            return $this->matchRepository->deleteById($id);
        }

        public function deleteAllMatches(){
            return $this->matchRepository->deleteAll();
        }

        public function updateMatch($entity){
            return $this->matchRepository->update($entity);
        }

    }
?>