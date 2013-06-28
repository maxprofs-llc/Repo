<?php
	class location_continent extends locatable_inLocation {
		
		public $name=NULL;
			
		private $cities=array();
		private $states=array();
		private $countries=array();
		
		//Unknown
		private static $unknown;
		protected $isUnknown=false;
		
		function __construct($unknown=false) {
			parent::__construct();
			$this->isUnknown=$unknown;
		}
		
		function addCity($city) {
			$object=new keyValue($city);
			$this->cities['id'.$city->id]=$object;
		}
		
		function getCities() {
			return $this->cities;
		}
		
		function addState($state) {
			$object=new keyValue($state);
			$this->states['id'.$state->id]=$object;
		}
		
		function getStates() {
			return $this->states;
		}
		
		function addCountry($country) {
			$object=new keyValue($country);
			$this->countries['id'.$country->id]=$object;
		}

		function getCountries() {
			return $this->countries;
		}		
		
		function getName() {
			$lang=lang_lang::getSingleton();
			if(is_null($this->name)) {
				return $lang->get('Unknown_continent');
			}
			else {
				return $this->name;
			}
		}
		
		function getLocationString() {
			$conf=config_conf::getSingleton();
			if($conf->get('show_continent',false))
				return ', ' . $this->getName();
			else
				return '';		
		}

		static function getUnknown() {
			helper::debugPrint('Get unknown '.$c,'location');
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$unknown = new $c(true);
			}
			helper::debugPrint('Return '.get_class(self::$unknown),'location');			
			return self::$unknown;
		}
	}
?>