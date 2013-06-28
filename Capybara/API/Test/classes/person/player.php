<?php
	class person_player extends person_person {
		
		//Pointers
		public $team;
		public $personId;
		public $roleId;
		
		//Properties
		public $shirtNumber;
		public $matchFull;
		public $distance;
		public $speed;
		
		//Unknown
		protected static $unknown;
		protected $isUnknown=false;

		//None
		protected static $none;
		protected $isNone=false;
				
		function getPerson() {
			if(is_null($this->id))
				return person_person::getUnknown();
			elseif ($this->id==0)
				return person_person::getNone();
			return data_dataStore::getProperty('dataReader')->getPersonById($this->personId);		
		}
		
		function getName() {
			return $this->getPerson()->getName();
		}
		
		function getRole() {
			return data_dataStore::getProperty('dataReader')->getRoleById($this->roleId);		
		}
		
		static function getUnknown() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$unknown = new $c(true);
			}
			return self::$unknown;
		}	

		static function getNone() {
			if (!isset(self::$none)) {
				$c=__CLASS__;
				self::$none = new $c(false,true);
			}
			return self::$none;
		}		
	}
