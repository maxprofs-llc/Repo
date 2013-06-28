<?php
	abstract class locatable_inArena extends locatable_inStreet {
		
		public $arenaId;
		
		function __construct() {
			parent::__construct();
		}
		
		function getArena() {
			return data_dataStore::getProperty('dataReader')->getArenaById($this->arenaId);
		}		

		function getCity() {
			if(is_null($this->cityId))
				return $this->getArena()->getCity();
			else
				return data_dataStore::getProperty('dataReader')->getCityById($this->cityId,true);
		}
	
		function getState() {
			if(is_null($this->stateId))
				if(is_null($this->getArena()->getState()) || is_null($this->getArena()->getCountry()->id))
					return $this->getCity()->getState();
				else	
					return $this->getArena()->getState();
			else
				return data_dataStore::getProperty('dataReader')->getStateById($this->stateId,true);
		}

		function getCountry() {
			if(is_null($this->countryId) )
				if(is_null($this->getArena()->getCountry()) || is_null($this->getArena()->getCountry()->id))
					if(is_null($this->getCity()->getCountry()) || is_null($this->getCity()->getCountry()->id))
						return $this->getState()->getCountry();
					else
						return $this->getCity()->getCountry();
				else
					return $this->getArena()->getCountry();
			else
				return data_dataStore::getProperty('dataReader')->getCountryById($this->countryId,true);
		}

		function getContinent() {
			if(is_null($this->continentId))
				if(is_null($this->getArena()->getContinent()) || is_null($this->getArena()->getContinent()->id))
					if(is_null($this->getCity()->getContinent()) || is_null($this->getCity()->getContinent()->id))
						if(is_null($this->getState()->getContinent()) || is_null($this->getState()->getContinent()->id))
							return $this->getCountry()->getContinent();
						else
							return $this->getState()->getContinent();
					else
						return $this->getCity()->getContinent();
				else
					return $this->getArena()->getContinent();
			else
				return data_dataStore::getProperty('dataReader')->getContinentById($this->continentId,true);
		}

		public function getLongitude() {
			if(is_null($this->longitude))
				if(is_null($this->getArena()->getLongitude()))
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
					return $this->getArena()->getLongitude();
			else
				return $this->longitude;
		}

		public function getLatitude() {
			if(is_null($this->latitude))
				if(is_null($this->getArena()->getLatitude()))
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
					return $this->getArena()->getLatitude();
			else
				return $this->latitude;
		}			
/*
 * 
 * Om vi vill att Arena ska ha fšrtur šver underobjekt sŒ kommentera bort koden nedan
 * 
		function getCity() {
			if(!is_null($this->getArena()) && !is_null($this->getArena()->getCity()) && !is_null($this->getArena()->getCity()->id))
				return $this->getArena()->getCity();
			else
				if(is_null($this->city))
					return location_city::getUnknown();
				else
					return $this->city;
		}
	
		function getState() {
			if(!is_null($this->getArena()) && !is_null($this->getArena()->getState()) && !is_null($this->getArena()->getState()->id))
				return $this->getArena()->getState();
			else
				if(is_null($this->state))
					return location_state::getUnknown();
				else
					return $this->state;
		}

		function getCountry() {
			if(!is_null($this->getArena()) && !is_null($this->getArena()->getCountry()) && !is_null($this->getArena()->getCountry()->id))
				return $this->getArena()->getCountry();
			else
				if(is_null($this->country))
					return location_country::getUnknown();
				else
					return $this->country;
		}

		function getContinent() {
			if(!is_null($this->getArena()) && !is_null($this->getArena()->getContinent()) && !is_null($this->getArena()->getContinent()->id))
				return $this->getArena()->getContinent();
			else
				if(is_null($this->continent))
					return location_continent::getUnknown();
				else
					return $this->continent;
		}

		public function getLongitude() {
			if(!is_null($this->getArena()) && !is_null($this->getArena()->getLongitude()))
				return $this->getArena()->getLongitude();
			else
				return $this->longitude;
		}

		public function getLatitude() {
			if(!is_null($this->getArena()) && !is_null($this->getArena()->getLatitude()))
				return $this->getArena()->getLatitude();
			else
				return $this->latitude;
		}
	*/
	}
	
		
?>