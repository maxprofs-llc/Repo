<?php
	class person_personRole extends person_role {
		
		//Pointers
		
		public $teamId;
		public $organizationId;
		public $roleId;
		
		//Properties
		
		public $startDate;
		public $endDate;
		public $defaultShirtNumber;
		public $isPrimary;
		
		function __construct() {
			parent::__construct();
		}
		
		function getTeam() {
			return data_dataStore::getProperty('dataReader')->getTeamById($this->teamId);
		}

		function getOrganization() {
			return data_dataStore::getProperty('dataReader')->getOrganizationById($this->organizationId);
		}		
	}
?>