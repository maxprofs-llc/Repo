<?php
	abstract class locatable_inContinent extends locatable_inLocation {

		//Pointers
		protected $continent;			//Location continent. If getName() returns NULL it means no continent
		public $continentId;
		
		//JSON properties
		public $_continent;

		function __construct() {
			parent::__construct();
		}
		
		function minimumPrepareForSerialization() {
			parent::minimumPrepareForSerialization();
			$this->_continent=$this->getContinent()->getName();
		}

		function prepareForSerialization() {
			parent::prepareForSerialization();
			$this->_continent=new keyValue($this->getContinent());
		}
				
		function getContinent() {
			return data_dataStore::getProperty('dataReader')->getContinentById($this->continentId,true);
		}
		

		public function getLongitude() {
			if(is_null($this->longitude))
				if(is_null($this->getContinent()))
					return NULL;
				else
					return $this->getContinent()->getLongitude();
			return $this->longitude;
		}

		public function getLatitude() {
			if(is_null($this->latitude))
				if(is_null($this->getContinent()))
					return NULL;
				else
					return $this->getContinent()->getLatitude();
			return $this->latitude;
		}
	}
?>