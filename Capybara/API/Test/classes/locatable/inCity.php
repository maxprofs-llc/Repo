<?php
	abstract class locatable_inCity extends locatable_inState {

		//Pointers
		public $cityId;			//Location city. If getName() returns NULL it means no city

		//JSON properties
		public $_city;

		function __construct() {
			parent::__construct();
		}
		
		function minimumPrepareForSerialization() {
			parent::minimumPrepareForSerialization();
			$this->_city=$this->getCity()->getName();
		}
		
		function prepareForSerialization() {
			parent::prepareForSerialization();
			$this->_city=new keyValue($this->getCity());
		}

		function getCity() {
			helper::debugPrint('inCity: getCity (ID:'.$this->cityId.')','locations');
			return data_dataStore::getProperty('dataReader')->getCityById($this->cityId,true);
		}
	
		function getState() {
			helper::debugPrint('inCity: getState','locations');
			if(is_null($this->stateId))
				return $this->getCity()->getState();
			else
				return  data_dataStore::getProperty('dataReader')->getStateById($this->stateId,true);
		}

		function getCountry() {
			helper::debugPrint('inCity: getCountry','locations');
			if(is_null($this->countryId))
				if(is_null($this->getCity()->getCountry()) || is_null($this->getCity()->getCountry()->id))
					return $this->getState()->getCountry();
				else
					return $this->getCity()->getCountry();
			else
				return  data_dataStore::getProperty('dataReader')->getCountryById($this->countryId,true);
		}

		function getContinent() {
			helper::debugPrint('inCity: getContinent','locations');
			if(is_null($this->continentId))
				if(is_null($this->getCity()->getContinent()) || is_null($this->getCity()->getContinent()->id))
					if(is_null($this->getState()->getContinent()) || is_null($this->getState()->getContinent()->id))
						return $this->getCountry()->getContinent();
					else
						return $this->getState()->getContinent();
				else
					return $this->getCity()->getContinent();
			else
				return  data_dataStore::getProperty('dataReader')->getContinentById($this->continentId,true);
		}

		public function getLongitude() {
			if(is_null($this->longitude))
				if(is_null($this->getCity()->getLongitude()))
					if(is_null($this->getState()->getLongitude()))
						if(is_null($this->getCountry()->getLongitude()))
							return $this->getContinent()->getLongitude();
						else
							return $this->getCountry()->getLongitude();
					else
						return $this->getState()->getLongitude();
				else
					return $this->getCity()->getLongitude();
			else
				return $this->longitude;
		}

		public function getLatitude() {
			if(is_null($this->latitude))
				if(is_null($this->getCity()->getLatitude()))
					if(is_null($this->getState()->getLatitude()))
						if(is_null($this->getCountry()->getLatitude()))
							return $this->getContinent()->getLatitude();
						else
							return $this->getCountry()->getLatitude();
					else
						return $this->getState()->getLatitude();
				else
					return $this->getCity()->getLatitude();
			else
				return $this->latitude;
		}		
	}
?>