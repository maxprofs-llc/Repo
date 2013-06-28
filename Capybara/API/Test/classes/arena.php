<?php
	class arena extends locatable_inStreet {
			
		//Properties
		public $foundingDate='';				//The date the arena was founded
		public $cessationDate='';				//The date the arena ceased to exist
		public $url='';							//Internet URL for organization, eg: http://www.aik.se/
		public $name=NULL;
		public $nativeName=NULL;
		
		//Unknown
		private static $unknown;
		protected $isUnknown=false;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function prepareForSerialization() {
			parent::prepareForSerialization();
		}
		
		public function getName() {
			$lang=lang_lang::getSingleton();
			if(is_null($this->name)) {
				if(is_null($this->nativeName))
					return $lang->get('Unknown_arena');
				else
					return $this->nativeName;
			}
			else {
				return $this->name;
			}
		}

		static function getUnknown() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$unknown = new $c(true);
			}
			return self::$unknown;
		}	
		
		function __toString() {
			return $this->getName().", ".$this->getCity()->getName();
		}
	}
?>