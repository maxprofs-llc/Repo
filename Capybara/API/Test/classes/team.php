<?php
	class team extends locatable_inCity {
		
		//Pointers
		public $organizationId;		//Parent organization, eg AIK
		public $genderId;			//Gender for this team: Men, Women, Mixed
		public $sportId;			//The sport this team is playing
		public $ageGroupId=0;		//If this team is only for people of a certain age, eg U21
		public $cohortId=0;			//If this team is only for people born a certain year, eg P91
		public $sectionId;			//What section the team belongs to, eg Elite, Youth team etc
		public $contact;			//Primary contact info of the team
		public $homeArenaId;		//Primary home arena
		public $logoFileId=NULL;	//Id of file record containing image data for the logo of the team. Should not be accessed directly
		
		//Properties
		public $name;				//The name of the team, eg AIK P91
		public $fullName;			//The full name of the team, eg AllmŠna Idrottsklubben
		public $nickName;			//Nickname of the team, eg Gnaget
		public $shortName;			//Short name of the team, eg AIK
		public $sortName;			//Name to use in sorting, eg AC Milan should be sorted by Milan
		public $nativeName;			//The name of the team, eg AIK P91 (in native tongue of team)
		public $nativeFullName;		//The full name of the team, eg AllmŠna Idrottsklubben (in native tongue of team)
		public $nativeNickName;		//Nickname of the team, eg Gnaget (in native tongue of team)
		public $nativeShortName;	//Short name of the team, eg AIK (in native tongue of team)
		public $nativeSortName;		//Name to use in sorting, eg AC Milan should be sorted by Milan (in native tongue of team)
		public $foundingDate;		//Date the team was founded
		public $cessationDate;		//Date the team ceased to exist
		public $url;				//Homepage for team
		
		//JSON
		public $_homeArena;
		public $_organization;
		
		//Unknown
		private static $unknown;
		protected $isUnknown=false;
		
		function __construct($isUnknown=false) {
			parent::__construct();
			$this->isUnknown=$isUnknown;
		}
		
		function prepareForSerialization() {
			parent::prepareForSerialization();
			$this->_homeArena=$this->getHomeArena();
			$this->_organization=new keyValue($this->getOrganization());
		}
		
		function getName() {
			if($this->isUnknown) 
				return lang_lang::getSingleton()->get('Unknown_team');
			return $this->name;
		}
		
		function getHomeArena() {
			return data_dataStore::getProperty('dataReader')->getArenaById($this->homeArenaId);
		}
	
		function getSport() {
			return data_dataStore::getProperty('dataReader')->getSportById($this->sportId);
		}	
		
		function getGender() {
			return data_dataStore::getProperty('dataReader')->getGenderById($this->genderId);
		}

		function getOrganization() {
			return data_dataStore::getProperty('dataReader')->getOrganizationById($this->organizationId);
		}
		
		function getCohort() {
			return data_dataStore::getProperty('dataReader')->getCohortById($this->cohortId);
		}	
		
		function getAgeGroup() {
			return data_dataStore::getProperty('dataReader')->getAgeGroupById($this->ageGroupId);
		}
				
		function getSection() {
			return data_dataStore::getProperty('dataReader')->getSectionById($this->sectionId);
		}
		
		function getLogoImageId() {
			if(is_null($this->logoFileId))
				return $this->getOrganization()->getLogoImageId();
			return $this->logoFileId;
		}
		
		function getMatches() {
			return data_dataStore::getProperty('dataReader')->getMatchesForTeamWithId($this->id);
		}
		
		function getLongString() {
			$string=$this->getName();
			if($this->getSection()->getName()!='' && $this->sectionId!=0 && !is_null($this->sectionId))
				$string.=', '.$this->getSection()->getName();
			if($this->getGender()->getName()!='' && $this->genderId!=0 && !is_null($this->genderId))
				$string.=', '.$this->getGender()->getName();
			return $string;
		}

		static function getUnknown() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$unknown = new $c(true);
			}
			return self::$unknown;
		}	
	}
?>