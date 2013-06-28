<?php
	class match_substitution extends baseClass {
		
		public $competitorId;
		public $playerId;
		public $nextPlayerId;
		public $matchEventId;
		public $time;
		
		function getCompetitor() {
			if(is_null($this->id))
				return match_competitor::getUnknown();
			return data_dataStore::getProperty('dataReader')->getCompetitorById($this->competitorId);
		}
		
		function getPlayerOut() {
			return data_dataStore::getProperty('dataReader')->getPlayerById($this->playerId);
		}
		
		function getPlayerIn() {
			return data_dataStore::getProperty('dataReader')->getPlayerById($this->nextPlayerId);
		}
		
		function getName() {
			return "";
		}
		
	}