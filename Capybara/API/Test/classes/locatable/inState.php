<?php
	abstract class locatable_inState extends locatable_inCountry {

		//Pointers
		public $stateId;			//Location state. If getName() returns NULL it means no state
		
		//JSON properties
		public $_state;

		function __construct() {
			parent::__construct();
		}
		
		function minimumPrepareForSerialization() {
			parent::minimumPrepareForSerialization();
			$this->_state=$this->getState()->getName();
		}

		function prepareForSerialization() {
			parent::prepareForSerialization();
			$this->_state=new keyValue($this->getState());
		}
			
		function getState() {
			helper::debugPrint('inState: getState','locations');
			if($this->isUnknown || is_null($this->id))
				return data_dataStore::getProperty('dataReader')->getStateById(NULL,true);
			if(!is_null($this->countryId))
				return data_dataStore::getProperty('dataReader')->getStateById($this->stateId,true);
			else
				return location_state::getUnknown();
		}

		function getCountry() {
			helper::debugPrint("inState: getCountry (countryId=$this->countryId)",'locations');
			if(!is_null($this->countryId))
				return data_dataStore::getProperty('dataReader')->getCountryById($this->countryId,true);
			if($this->isUnknown || is_null($this->id))
				return location_country::getUnknown();
			else
				return $this->getState()->getCountry();
		}

		function getContinent() {
			helper::debugPrint('inState: getContinent','locations');
			if($this->isUnknown || is_null($this->id))
				return location_continent::getUnknown();
			if(is_null($this->continentId))
				if(is_null($this->getState()->getContinent()) || is_null($this->getState()->getContinent()->id))
					if(is_null($this->getCountry()) || is_null($this->getCountry()->id))
						return location_continent::getUnknown();
					else
						return $this->getCountry()->getContinent();
				else
					return $this->getState()->getContinent();
			else
				return data_dataStore::getProperty('dataReader')->getContinentById($this->continentId,true);
		}	

		public function getLongitude() {
			if(is_null($this->longitude))
				if(is_null($this->getState()) || is_null($this->getState()->getLongitude()))
					if(is_null($this->getCountry()) || is_null($this->getCountry()->getLongitude()))
						if(is_null($this->getContinent()))
							return NULL;
						else
							return $this->getContinent()->getLongitude();
					else
						return $this->getCountry()->getLongitude();
				else
					return $this->getState()->getLongitude();
			else
				return $this->longitude;
		}

		public function getLatitude() {
			if(is_null($this->latitude))
				if(is_null($this->getState()) || is_null($this->getState()->getLatitude()))
					if(is_null($this->getCountry()) || is_null($this->getCountry()->getLatitude()))
						if(is_null($this->getContinent()))
							return NULL;
						else
							return $this->getContinent()->getLatitude();
					else
						return $this->getCountry()->getLatitude();
				else
					return $this->getState()->getLatitude();
			else
				return $this->latitude;
		}
	}
?>