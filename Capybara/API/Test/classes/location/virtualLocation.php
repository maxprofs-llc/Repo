<?php
	class location_virtualLocation extends location_location {
		
		protected $object;
		protected $cityFunction;
		protected $stateFunction;
		protected $countryFunction;
		protected $continentFunction;
		protected $latFunction;
		protected $lngFunction;
		
		function setObject($object,$cityFunction,$stateFunction,$countryFunction,$continentFunction,$latFunction,$lngFunction) {
			$this->object=$object;
			$this->cityFunction=$cityFunction;
			$this->stateFunction=$stateFunction;
			$this->countryFunction=$countryFunction;
			$this->continentFunction=$continentFunction;
			$this->latFunction=$latFunction;
			$this->lngFunction=$lngFunction;
		}
		
		function getCity() {
			$object=$this->object;
			$function=$this->cityFunction;
			return $object->$function();
		}

		function getState() {
			$object=$this->object;
			$function=$this->stateFunction;
			return $object->$function();
		}		

		function getCountry() {
			$object=$this->object;
			$function=$this->countryFunction;
			return $object->$function();
		}
		
		function getContinent() {
			$object=$this->object;
			$function=$this->continentFunction;
			return $object->$function();
		}

		function getLatitude() {
			$object=$this->object;
			$function=$this->latFunction;
			return $object->$function();
		}

		function getLongitude() {
			$object=$this->object;
			$function=$this->lngFunction;
			return $object->$function();
		}		
	}