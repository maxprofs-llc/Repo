<?php
	class match_assist extends match_matchEvent {
		
		public $goalId;
		
		function getGoal() {
			data_dataStore::getProperty('dataReader')->getGoalById($this->goalId);
		}
		
		function getPerson() {
			helper::debugPrint('Player Id:'.$this->playerId,'goal');
			if(!is_null($this->playerId)) {
				helper::debugPrint('Person Id:'.$this->getPlayer()->getPerson()->id,'goal');
				return $this->getPlayer()->getPerson();
			} else {
				return data_dataStore::getProperty('dataReader')->getPersonById($this->personId);
			}
		}		
	}
?>