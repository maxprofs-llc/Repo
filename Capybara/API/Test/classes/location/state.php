<?php
	class location_state extends locatable_inCountry {
		
		//Pointer
		
		public $capitalCityId=NULL;
		
		private $cities=array();

		//Properties
		
		public $name=NULL;
		public $nativeName=NULL;
		public $nativeFullName;
		public $nativeShortName;
		public $nativeSortName;
		
		//JSON properties
		public $_capitalCity;
		
		//Unknown
		protected static $unknown;
		protected $isUnknown=false;

		function prepareForSerialization() {
			parent::prepareForSerialization();
			if(is_null($this->id)) {
				//$this->_capitalCity=NULL;
			}else{
				//$this->_capitalCity=new keyValue($this->getCapitalCity());
			}
		}
	
		function __construct($unknown=false) {
			parent::__construct();
			helper::debugPrint('Create state','location');
			$this->isUnknown=$unknown;
		}

		function addCity($city) {
			$object=new keyValue($city);
			$cities['id'.$city->id]=$object;
		}
				
		function getCapitalCity() {
			helper::debugPrint('Get captial city','location');		
			if($this->isUnknown || is_null($this->id))
				return NULL;
			return data_dataStore::getProperty('dataReader')->getCityById($this->capitalCityId,true);
		}
		
		function getName() {
			$lang=lang_lang::getSingleton();
			if(is_null($this->name)) {
				if(is_null($this->nativeName))
					return $lang->get('Unknown_state');
				else
					return $this->nativeName;
			}
			else {
				return $this->name;
			}
		}
		
		function getLocationString() {
			$conf=config_conf::getSingleton();
			if($conf->get('show_state',false))
				return ', ' . $this->abbrevation . $this->getCountry()->getLocationString();
			else
				return $this->getCountry()->getLocationString();;
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