<?php
	class match_matchEvent extends baseClass {
		
		public $matchId;
		public $competitorId;
		public $teamId;
		public $playerId;
		public $personId;
		
		public $_player;
				
		function minimumPrepareForSerialization() {
			parent::minimumPrepareForSerialization();
			
			$this->_player=new keyValue($this->getPlayer());
		}

		function getName() {
			return "";
		}
		
		function getPlayer() {
			helper::debugPrint("Get player with id: $this->playerId","matchevent");
			return data_dataStore::getProperty('dataReader')->getPlayerById($this->playerId);
		}
		
		function getPerson() {
			return data_dataStore::getProperty('dataReader')->getPersonById($this->personId);
		}
		
	}