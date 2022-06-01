
<?php
    
    include "repository/teamRepository/teamRepository.php";
    
    class TeamService {

        private $teamRepository;

        public function __construct($table, $mysqliConnection){
            $this->teamRepository = new TeamRepository($table, $mysqliConnection);
        }

        public function findTeamById($id){
            return $this->teamRepository->findById($id);
        }

        public function findAllTeams(){
            return $this->teamRepository->findAll();
        }

        public function deleteTeamById($id){
            return $this->teamRepository->deleteById($id);
        }

        public function deleteAllTeams(){
            return $this->teamRepository->deleteAll();
        }

        public function updateTeam($entity){
            return $this->teamRepository->update($entity);
        }
        
        public function saveTeam($entity){
            return $this->teamRepository->save($entity);
        }

    }


?>