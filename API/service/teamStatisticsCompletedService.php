<?php

    include "repository/teamStatisticsCompletedRepository/teamStatisticsCompletedRepository.php";

    class TeamStatisticsCompletedService {
        private $teamStatsRepository;
        
        public function __construct($table, $mysqliConnection){
            $this->teamStatsRepository = new TeamStatisticsCompletedRepository($table, $mysqliConnection);
        }
        
        //For specific team all stats
        public function findTeamCompletedStatsByTeamId($id){
            return $this->teamStatsRepository->findById($id);
        }
        
        //For all teams all stats
        public function findAllTeamCompletedStats(){
            return $this->teamStatsRepository->findAll();
        }
        
        public function deleteTeamCompletedStatsById($id){
            return $this->teamStatsRepository->deleteById($id);
        }
        
        public function deleteAllTeamCompletedStats(){
            return $this->teamStatsRepository->deleteAll();
        }

        public function updateTeamCompletedStats($entity){
            return $this->teamStatsRepository->update($entity);
        }
        
        public function saveTeamCompletedStats($entity){
            return $this->teamStatsRepository->save($entity);
        }
    }

?>