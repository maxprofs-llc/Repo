<?php
	class location_country extends locatable_inContinent {
		
		public $capitalCityId=NULL;
		
		public $name=NULL;
		public $nativeName=NULL;
		public $iso2='';
		public $iso3='';
		public $numCode;
		
		private $cities=array();
		private $states=array();
		
		//JSON properties
		public $_capitalCity;

		//Unknown
		protected static $unknown;
		protected $isUnknown=false;
		
		function prepareForSerialization() {
			helper::debugPrint('Prepare country for JSON','location');
			parent::prepareForSerialization();
			if(is_null($this->id)) {
				//$this->_capitalCity=NULL;
			}else{
				//$this->_capitalCity=new keyValue($this->getCapitalCity());
			}
		}

		function addCity($city) {
			$object=new keyValue($city);
			$cities['id'.$city->id]=$object;
		}
		
		function addState($state) {
			$object=new keyValue($state);
			$states['id'.$state->id]=$object;
		}

		function __construct($unknown=false) {
			parent::__construct();
			helper::debugPrint('Create country','location');
			$this->isUnknown=$unknown;
		}
		
		function getCapitalCity() {
			helper::debugPrint('Get captial city','location');		
			if($this->isUnknown || is_null($this->id))
				return location_city::getUnknown();
			return data_dataStore::getProperty('dataReader')->getCityById($this->capitalCityId,true);
		}

		function getName() {
			$lang=lang_lang::getSingleton();
			if(is_null($this->name)) {
				if(!is_null($this->strings[lang_lang::getSingleton()->getLanguage()]->name))
					return $this->strings[lang_lang::getSingleton()->getLanguage()]->name;
				elseif(is_null($this->nativeName))
					return $lang->get('Unknown_country');
				else
					return $this->nativeName;
			}
			else {
				return $this->name;
			}
		}
		
		function getLocationString() {
			return ', ' . $this->getName() . $this->getContinent()->getLocationString();  
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