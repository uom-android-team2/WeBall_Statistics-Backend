<?php

    include "repository/teamLiveStatisticsRepository/teamLiveStatisticsRepository.php";


    class TeamLivestatisticsService {

        private $teamLivestatisticsRepository;

        public function __construct($table, $mysqli){
            $this->teamLivestatisticsRepository = new TeamLivestatisticsRepository($table, $mysqli);
        }

        public function findByMatchIdAndTeamId($matchId, $teamId){
            return $this->teamLivestatisticsRepository->findBy2Id($matchId, $teamId);
        }

        public function findAllTeamLiveStatistics(){
            return $this->teamLivestatisticsRepository->findAll();
        }

        public function deleteByMatchId($matchId){
            return $this->teamLivestatisticsRepository->deleteById($matchId);
        }

        public function deleteAll(){
            return $this->teamLivestatisticsRepository->deleteAll();
        }

        public function saveTeamLiveStatistics($teamLiveStatistics){
            return $this->teamLivestatisticsRepository->save($teamLiveStatistics);
        }
        
        public function updateTeamLiveStatistics($teamLiveStatistics){
            return $this->teamLivestatisticsRepository->update($teamLiveStatistics);
        }

       
    }




?>