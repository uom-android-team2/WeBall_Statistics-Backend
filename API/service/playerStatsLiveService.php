<?php 
    include "repository/playerStatsLiveRepository/playerStatsLiveRepository.php";
        
    class PlayerStatsLiveService {

        private $playerStatsRepository;

        public function __construct($table, $mysqliConnection){
            $this->playerStatsRepository = new playerStatsLiveRepository($table, $mysqliConnection);
        }

        public function findPlayerById($id){
            return $this->playerStatsRepository->findById($id);
        }

        public function findAllPlayers(){
            return $this->playerStatsRepository->findAll();
        }

        public function deletePlayerById($id){
            return $this->playerStatsRepository->deleteById($id);
        }

        public function deleteAllPlayers(){
            return $this->playerStatsRepository->deleteAll();
        }

        public function updatePlayer($entity){
            return $this->playerStatsRepository->update($entity);
        }

    }
?>