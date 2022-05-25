<?php

    include "repository/playerStatisticsCompletedRepository/playerStatisticsCompletedRepository.php";

    class PlayerStatisticsCompletedService {
        private $playerStatsRepository;
        
        public function __construct($table, $mysqliConnection){
            $this->playerStatsRepository = new PlayerStatisticsCompletedRepository($table, $mysqliConnection);
        }
        
        //For specific player all stats
        public function findPlayerCompletedStatsByPlayerId($id){
            return $this->playerStatsRepository->findById($id);
        }
        
        //For all players all stats
        public function findAllPlayerCompletedStats(){
            return $this->playerStatsRepository->findAll();
        }
        
        public function deletePlayerCompletedStatsById($id){
            return $this->playerStatsRepository->deleteById($id);
        }
        
        public function deleteAllPlayerCompletedStats(){
            return $this->playerStatsRepository->deleteAll();
        }

        public function updatePlayerCompletedStats($entity){
            return $this->playerStatsRepository->update($entity);
        }
    }

?>