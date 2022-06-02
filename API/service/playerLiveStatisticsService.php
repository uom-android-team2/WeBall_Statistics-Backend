<?php

    include "repository/playerLiveStatisticsRepository/playerLiveStatisticsRepository.php";


    class PlayerLivestatisticsService {
        private $playerLivestatisticsRepository;

        public function __construct($table, $mysqli){
            $this->playerLivestatisticsRepository = new PlayerLivestatisticsRepository($table, $mysqli);
        }

        public function findByMatchAndPlayerId($matchId, $playerId){
            return $this->playerLivestatisticsRepository->findBy2Id($matchId, $playerId);
        }

        public function findAllPlayerLiveStatistics(){
            return $this->playerLivestatisticsRepository->findAll();
        }

        public function deletePlayerLiveStatistics($id){
            return $this->playerLivestatisticsRepository->deleteById($id);
        }

        public function deleteAllPlayerLiveStatistics(){
            return $this->playerLivestatisticsRepository->deleteAll();
        }

        public function savePlayerLiveStatistics($playerLiveStatistics){
            return $this->playerLivestatisticsRepository->save($playerLiveStatistics);
        }


    }



?>