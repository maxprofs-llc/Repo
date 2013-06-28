<?php

	class match_match extends locatable_inArena {
	
		//Pointers
		public $date;
		public $time;
		public $genderId;
		public $ageGroupId;			//If this match is only for people of a certain age, eg U21
		public $cohortId;				//If this match is only for people born a certain year, eg P91
		public $sectionId;			//What section the match belongs to, eg Elite, Youth team etc
		public $matchType;
		public $hostOrganizationId;
		public $roundNumber;
		public $competitors;
		public $attendance;
		public $weatherƒId;
		
		public $isPublic=true;
		public $isPlayed=true;
		public $isIncludedInSummary=true; 
		
		private $goals;
		private $warnings;
		
		private $referees;
		
		//Properties
		public $sportId;
		public $seasonId;

		//JSON
		public $_periods;
		public $_referees;
		public $_homeTeam;
		public $_awayTeam;
		public $_weather;
		public $_goals;
		public $_warnings;
		public $_homeGoals;
		public $_awayGoals;
		
		public $_result;
		
		function __construct() {
			parent::__construct();
			
			$this->competitors=new baseClassList();
			$this->competitors->Append(new match_competitor());
			$this->competitors->Append(new match_competitor());
		}
		
		function prepareForSerialization() {
			parent::prepareForSerialization();
			$this->_periods=$this->getPeriods();
			$this->_referees=$this->getReferees();
			$this->_homeTeam=$this->getHomeCompetitor();
			$this->_awayTeam=$this->getAwayCompetitor();
			//$this->_weather=$this->getWeather();
			$this->_goals=$this->getGoals();
			$this->_warnings=$this->getWarnings();
			$this->_homeGoals=$this->getHomeGoals();
			$this->_awayGoals=$this->getAwayGoals();
		}
		
		function minimumPrepareForSerialization() {
			parent::minimumPrepareForSerialization();
			$this->_homeTeam=$this->getHomeCompetitor();
			$this->_awayTeam=$this->getAwayCompetitor();
			$this->_homeGoals=count($this->getHomeGoals());
			$this->_awayGoals=count($this->getAwayGoals());
			$this->_result=$this->getResultString();
		}
		
		function getResultString() {
			return count($this->getHomeGoals())."-".count($this->getAwayGoals());			
		}
		
		function getHomeCompetitor() {
			helper::debugPrint('Get home competitor','match');
			if(count($this->competitors)>0)
				return $this->competitors[0];
			else
				return new match_competitor();					
		}
		
		function getAwayCompetitor() {
			if(count($this->competitors)>1)
				return $this->competitors[1];
			else
				return new match_competitor();					
		}
		
		function getCompetitors($no) {
			return $this->competitors[$no+1];
		}
		
		function getMe() {
			for($i=0;$i<count($this->competitors);$i++) {
				if($this->competitors[$i]->getTeam()->id==config_conf::getSingleton()->get('my_team'))
					return $this->competitors[$i];
			}
			return match_competitor::getNone();
		}

		function getOpponent() {
			for($i=0;$i<count($this->competitors);$i++) {
				if($this->competitors[$i]->getTeam()->id!=config_conf::getSingleton()->get('my_team'))
					return $this->competitors[$i];
			}
			return match_competitor::getNone();
		}
		
		function getStarterTeam() {
			if($this->getHomeCompetitor()->isStarter) 
				return $this->getHomeTeam();
			elseif($this->getAwayCompetitor()->isStarter)
				return $this->getAwayTeam();
			else
				return team::getUnknown();
		}

		function getHomeTeam() {
			return $this->getHomeCompetitor()->getTeam();
		}
		
		function getAwayTeam() {
			return $this->getAwayCompetitor()->getTeam();
		}
		
		function getGoals() {
			helper::debugPrint('Get goal for match '.$this->id,'match');
			if(is_null($this->id))
				return array();
			if(is_null($this->goals) && !is_null($this->id))
				$this->goals=data_dataStore::getProperty('dataReader')->getGoalsForMatchWithId($this->id);
			return $this->goals;
		}
		
		function getMatchEvents() {
			return array(
				"goals"=>$this->getGoals(),
				"warnings"=>$this->getWarnings()
			);
		}
		
		function getWarnings() {
			helper::debugPrint('Get warning for match '.$this->id,'match');
			if(is_null($this->id))
				return array();
			if(is_null($this->warnings) && !is_null($this->id))
				$this->warnings=data_dataStore::getProperty('dataReader')->getWarningsForMatchWithId($this->id);
			return $this->warnings;
		}
		
		function getHomeGoals() {
			helper::debugPrint("Get home goals<br>","queries");
			$homeId=$this->getHomeCompetitor()->id;
			
			return data_dataStore::getProperty('dataReader')->getGoalsForCompetitorWithId($homeId);
		}
		
		function getAwayGoals() {
			helper::debugPrint("Get away goals<br>","queries");
			$awayId=$this->getAwayCompetitor()->id;
			return data_dataStore::getProperty('dataReader')->getGoalsForCompetitorWithId($awayId);
		}
		
		function getWeather() {
			return data_dataStore::getProperty('dataReader')->getWeatherById($this->weatherId);
		}
		
		function getHomeTeamFormation() {
			//return data_dataStore::getProperty('dataReader')->getTeamById($this->homeTeamId);
			return new formation('4-4-2');
		}
		
		function getAwayTeamFormation() {
			//return data_dataStore::getProperty('dataReader')->getTeamById($this->awayTeamId);
			return new formation('4-4-2');
		}
				
		function getHomeSquad() {
			helper::debugPrint('<h1>Get home squad</h1>','match');
			return $this->getHomeCompetitor()->getSquad();
		}
		
		function getHomeSubstitutions() {
			return $this->getHomeCompetitor()->getSubstitutions();
		}
		
		function getPeriods() {
			helper::debugPrint('Get periods','match');
			if($this->id==NULL)
				return new baseClassList();
			helper::debugPrint('Get from DB','match');
			$periods=data_dataStore::getProperty('dataReader')->getPeriodsForMatchWithId($this->id);
			if(is_null($periods))
				return new baseClassList();
			else
				return $periods;
		}
		
		function getReferees() {
			if($this->id==NULL)
				return array();
			$referees=data_dataStore::getProperty('dataReader')->getRefereesForMatchWithId($this->id);
			if(is_null($referees))
				return array();
			else
				return $referees;			
		}

		function getAwaySquad() {
			return $this->getAwayCompetitor()->getSquad();
		}
		
		function getAwaySubstitutions() {
			return $this->getAwayCompetitor()->getSubstitutions();
		}
				
		function getHostOrganization() {
			return data_dataStore::getProperty('dataReader')->getOrganizationById($this->hostOrganizationId);
		}
		
		function getMatchType() {
			return $this->matchType;
		}

		function getSport() {
			return data_dataStore::getProperty('dataReader')->getSportById($this->sportId);
		}	
		
		function getSeason() {
			return data_dataStore::getProperty('dataReader')->getSeasonById($this->seasonId);
		}	

		function getGender() {
			return $this->gender;
		}	
		
		function getCohort() {
			if(is_null($this->cohort)) {
				return team_cohort::getNone();
			}
			return $this->cohort;
		}	
		
		function getAgeGroup() {
			if(is_null($this->ageGroup)) {
				return team_ageGroup::getNone();
			}
			return $this->ageGroup;
		}
				
		function getSection() {
			if(is_null($this->section)) {
				return team_section::getUnknown();
			}
			return $this->section;
		}
				
		function getName() {
			return $this->date." ".$this->time." ".$this->getHomeTeam()->getName() . "-" . $this->getAwayTeam()->getName() . " " . $this->getResultString();	
		}
		
		function getLongString() {
			return $this->getName();
		}
		
		
		function __toString() {
			return $this->getHomeTeam()->getName() . "-" . $this->getAwayTeam()->getName() . " " . $this->getResultString();
		}
		
		function getReport(lang_lang $lang=NULL,$organizationId=NULL) {
			if(is_null($lang))
				$lang=lang_lang::getSingleton();
			if(is_null($organizationId))
				$organizationId=config_conf::getSingleton()->get('my_team');
			return data_dataStore::getProperty('dataReader')->getMatchReport($this->id,$lang->getLanguage(),$organizationId);
		}
		
		function getNecessaryData() {
			parent::getNecessaryData();
			$this->competitors=data_dataStore::getProperty('dataReader')->getCompetitorsForMatchWithId($this->id);		
		}
	}

?>