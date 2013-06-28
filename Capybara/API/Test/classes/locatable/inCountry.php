<?php
	abstract class locatable_inCountry extends locatable_inContinent {

		//Pointers
		public $countryId;
		
		//JSON properties
		public $_country;

		function __construct() {
			parent::__construct();
		}
		
		function minimumPrepareForSerialization() {
			parent::minimumPrepareForSerialization();
			$this->_country=$this->getCountry()->getName();
		}

		function prepareForSerialization() {
			parent::prepareForSerialization();
			$this->_country=new keyValue($this->getCountry());
		}
		
		function getCountry() {
			helper::debugPrint('inCountry: getCountry','locations');
			if($this->isUnknown)
				return data_dataStore::getProperty('dataReader')->getCountryById(NULL,true);
			if(!is_null($this->countryId))
				return data_dataStore::getProperty('dataReader')->getCountryById($this->countryId,true);
			else
				return location_country::getUnknown();
		}

		function getContinent() {
			helper::debugPrint('inCountry: getContinent','locations');
			if($this->isUnknown || is_null($this_id))
				return location_continent::getUnknown();
			if(is_null($this->continentId))
				return $this->getCountry()->getContinent();
			else
				return data_dataStore::getProperty('dataReader')->getContinentById($this->continentId,true);
		}

		public function getLongitude() {
			if(is_null($this->longitude))
				if(is_null($this->getCountry()) || is_null($this->getCountry()->getLongitude()))
					return $this->getContinent()->getLongitude();
				else
					return $this->getCountry()->getLongitude();
			else
				return $this->longitude;
		}

		public function getLatitude() {
			if(is_null($this->latitude))
				if(is_null($this->getCountry()) || is_null($this->getCountry()->getLatitude()))
					return $this->getContinent()->getLatitude();
				else
					return $this->getCountry()->getLatitude();
			else
				return $this->latitude;
		}
	}
?>