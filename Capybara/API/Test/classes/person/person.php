<?php
	class person_person extends locatable_inCity implements data_IDoNotSerialize  {

		public static $doNotSerialize=true;

		//Pointers
		protected $motherOrganization;
		public $motherOrganizationId;
		public $birthLatitude;
		public $birthLongitude;
		public $birthCityId;
		public $birthStateId;
		public $birthCountryId;
		public $birthContinentId;

		public $birthLocation;

		protected $contact;
		public $contactId;
		public $roles;
		public $dimensions;

		//Properties
		public $nativeName;
		public $firstName;
		public $lastName;
		public $fullName;
		public $nickNames;
		public $birthDate;
		public $deceaseDate;
		public $username;
		public $password;

		//JSON
		public $_birthCity;
		public $_birthState;
		public $_birthCountry;
		public $_birthContinent;
		public $_birthLongitude;
		public $_birthLatitude;

		//Unknown
		protected static $unknown;
		protected $isUnknown=false;

		//None
		protected static $none;
		protected $isNone=false;

		function __construct($unknown=false,$none=false) {
			parent::__construct();
			$this->isNone=$none;
			$this->isUnknown=$unknown;
			if($this->isNone)
				$this->id=0;
			elseif($this->isUnknown)
				$this->id=NULL;
			$this->roles=new baseClassList();
			$this->birthLocation=new location_virtualLocation();
			$this->birthLocation->setObject($this,'getBirthCity','getBirthState','getBirthCountry','getBirthContinent','getBirthLatitude','getBirthLongitude');
			$this->dimensions=new baseClassList();
		}

		function getMotherOrganization() {
			return data_dataStore::getProperty('dataReader')->getOrganizationById($this->motherOrganizationId);
		}

		function prepareForSerialization() {
			parent::prepareForSerialization();
			/*
			$this->_birthCity=new keyValue($this->getBirthCity());
			$this->_birthState=new keyValue($this->getBirthState());
			$this->_birthCountry=new keyValue($this->getBirthCountry());
			$this->_birthContinent=new keyValue($this->getBirthContinent());
			$this->_birthLongitude=$this->getBirthLongitude();
			$this->_birthLatitude=$this->getBirthLatitude();
			*/
		}

		function getBirthCity() {
			return data_dataStore::getProperty('dataReader')->getCityById($this->birthCityId,true);
		}

		function getBirthState() {
			return data_dataStore::getProperty('dataReader')->getStateById($this->birthStateId,true);
		}

		function getBirthCountry() {
			return data_dataStore::getProperty('dataReader')->getCountryById($this->birthCountryId,true);
		}

		function getBirthContinent() {
			return data_dataStore::getProperty('dataReader')->getContinentById($this->birthContinentId,true);
		}

		function getBirthLongitude() {
			if(is_null($this->birthLongitude))
				$this->getBirthCity()->getLongitude();
			return $this->birthLongitude;
		}

		function getBirthLatitude() {
			if(is_null($this->birthLatitude))
				$this->getBirthCity()->getLatitude();
			return $this->birthLatitude;
		}

		function getBirthLocation() {

		}

		function hasRole($role) {
			if(is_null($this->roles))
				$this->roles=data_dataStore::getProperty('dataReader')->getPersonRoleList($this->id);
			foreach($this->roles as $r) {
				if(is_null($r->endDate))
					if($r->id==$role->id || $r->isChildOf($role))
						return true;
			}
			return false;
		}

		function getPersonId() {
			return $this->id;
		}

		function getName() {
			if($this->isNone ||(!is_null($this->id) && $this->id==0))
				return lang_lang::getSingleton()->get('No_one');
			if($this->isUnknown || is_null($this->id))
				return lang_lang::getSingleton()->get('Unknown_person');
			return $this->firstName . ' ' . $this->lastName;
		}

		function __toString() {
			return $this->getName() . " (ID: ".$this->id.")";
		}

		static function getUnknown() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$unknown = new person_person(true);
			}
			return self::$unknown;
		}

		static function getNone() {
			if (!isset(self::$none)) {
				$c=__CLASS__;
				self::$none = new person_person(false,true);
			}
			return self::$none;
		}
	}