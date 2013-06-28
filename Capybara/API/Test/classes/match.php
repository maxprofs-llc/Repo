<?php

	class match extends locatable_inArena {
	
		//Pointers
		public $homeTeamId;
		public $awayTeamId;
		public $gender;
		public $ageGroup;			//If this match is only for people of a certain age, eg U21
		public $cohort;				//If this match is only for people born a certain year, eg P91
		public $section;			//What section the match belongs to, eg Elite, Youth team etc
		public $matchType;
		protected $hostOrganization;
		public $hostOrganizationId;
		public $weather;
		
		public $referees;
		
		//Properties
		public $sportId;
		public $seasonId;
		
		function __construct() {
			parent::__construct();
			
			$this->gender = gender::getUnknown();
			$this->matchType=matchType::getUnknown();
			$this->weather=new weather_weather();
			$this->referees=new baseClassList();
		}
		
		function getHomeTeam() {
			return data_dataStore::getProperty('dataReader')->getTeamById($this->homeTeamId);
		}
		
		function getAwayTeam() {
			return data_dataStore::getProperty('dataReader')->getTeamById($this->awayTeamId);
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
			return new baseClassList();
		}
		
		function getPeriods() {
			return new baseClassList();
		}

		function getAwaySquad() {
			return new baseClassList();
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
			return $homeTeam->getName() . "-" . $awayTeam->getName();	
		}
		
	}

?>