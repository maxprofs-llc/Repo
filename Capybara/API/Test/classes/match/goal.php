<?php
	class match_goal extends match_matchEvent {
		
		public $matchEventId;
		public $homeScore;
		public $awayScore;

		//JSON
		
		public $_player;
		public $_assists;
				
		function minimumPrepareForSerialization() {
			parent::minimumPrepareForSerialization();
			
			$this->_assists=$this->getAssists();
		}
		
		function prepareForSerialization() {
			parent::prepareForSerialization();
		}
		
		function getCompetitor() {
			return data_dataStore::getProperty('dataReader')->getCompetitorByGoalId($this->id);
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
		
		function getAssists() {
			helper::debugPrint("Assist",'goal');
			helper::debugPrint("Goal: $this->id",'goal');		
			return data_dataStore::getProperty('dataReader')->getAssistsForGoal($this->id);
		}
		
		function getName() {
			return "";
		}
	}