<?php
	class location_city extends locatable_inState {
	
		public $name=NULL;
		public $nativeName=NULL;
		public $url;

		//Unknown
		private static $unknown;
		protected $isUnknown=false;

		//None
		private static $none;
		protected $isNone=false;
						
		function prepareForSerialization() {
			parent::prepareForSerialization();
		}

		function __construct($unknown=false,$none=false) {
			parent::__construct();
			$this->isUnknown=$unknown;
			$this->isNone=$none;
			if($none)
				$this->id=0;
		}
		
		function getName() {
			$lang=lang_lang::getSingleton();
			if($this->isUnknown)
				return $lang->get('Unknown_city');
			elseif ($this->isNone)
				return $lang->get('No_city');
				
			if(is_null($this->name)) {
				if(is_null($this->nativeName))
					return $lang->get('Unknown_city');
				else
					return $this->nativeName;
			}
			else {
				return $this->name;
			}
		}
					
		function getLocationString() {
			if($this->isNone)
				return $this->getName();		
			return $this->getName() . (is_null($this->getCountry()) ? '' : $this->getCountry()->getLocationString());
		}
		
		function __toString() {
			return $this->getLocationString();
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
		
		static function getNone() {
			if (!isset(self::$none)) {
				$c=__CLASS__;
				helper::debugPrint('Get None '.$c,'location');
				self::$none = new $c(false,true);
			}
			return self::$none;
		}	
	}
?>