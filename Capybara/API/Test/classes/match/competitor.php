<?php

	class match_competitor extends baseClass {
		
		public $teamId;
		public $isStarter;
		
		//JSON
		public $_captains;
		public $_team;
		public $_players;
		public $_substitutions;
		public $_goals;
		
		//None
		private static $none;
		protected $isNone=false;
		
		//Unknown
		protected static $unknown;
		protected $isUnknown=false;
		
		function minimumPrepareForSerialization() {
			parent::minimumPrepareForSerialization();
			
			helper::debugPrint("Prepare for serialization","json");
			$this->_team=new keyValue($this->getTeam());
			$this->_captains=array_map("keyValue::FromBaseClass",$this->getCaptains()->getArrayCopy());
		}
		
		function prepareForSerialization() {
			parent::prepareForSerialization();
			$this->_team=$this->getTeam();
			$this->_players=$this->getSquad();
			$this->_goals=$this->getGoals();
		}
		
		function getTeam() {
			return data_dataStore::getProperty('dataReader')->getTeamById($this->teamId);
		}
		
		function getSquad() {
			if(is_null($this->id))
				return new baseClassList();
			return data_dataStore::getProperty('dataReader')->getSquadForCompetitor($this->id);
		}
		
		function getSubstitutions() {
			if(is_null($this->id))
				return new baseClassList();
			return data_dataStore::getProperty('dataReader')->getSubstitutionsForCompetitor($this->id);
		}
		
		function getCaptains() {
			return data_dataStore::getProperty('dataReader')->getCaptainsForCompetitor($this->id);
		}
		
		function getName() {
			if($this->isUnknown || is_null($this->id))
				return lang_lang::getSingleton()->get('Unknown_competitor');
			if($this->isNone || $this->id==0)
				return lang_lang::getSingleton()->get('None');
			return $this->getTeam()->getName();
		}
		
		function getGoals() {
			return data_dataStore::getProperty('dataReader')->getGoalsForCompetitorWithId($this->id);
		}

		function getWarnings() {
			return data_dataStore::getProperty('dataReader')->getWarningsForCompetitorWithId($this->id);
		}
		
		static function getUnknown() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$unknown = new $c(true);
			}
			return self::$unknown;
		}
		
		static function getNone() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$none = new $c(false,true);
			}
			return self::$none;
		}	
	}