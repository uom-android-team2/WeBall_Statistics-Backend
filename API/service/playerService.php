<?php 
    include "repository/playerRepository/playerRepository.php";
        
    class PlayerService {

        private $playerRepository;

        public function __construct($table, $mysqliConnection){
            $this->playerRepository = new playerRepository($table, $mysqliConnection);
        }

        public function findPlayerById($id){
            return $this->playerRepository->findById($id);
        }

        public function findAllPlayers(){
            return $this->playerRepository->findAll();
        }

        public function deletePlayerById($id){
            return $this->playerRepository->deleteById($id);
        }

        public function deleteAllPlayers(){
            return $this->playerRepository->deleteAll();
        }

        public function updatePlayer($entity){
            return $this->playerRepository->update($entity);
        }

        public function savePlayer($entity){
            return $this->playerRepository->save($entity);
        }

        public function findByTeamName($teamName){
            return $this->playerRepository->findByTeamName($teamName);
        }
        
        public function findByName($name){
            return $this->playerRepository->findByName($name);
        }

    }
?>