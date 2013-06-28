<?php
	class organizationType extends baseClass {
		
		//Pointers
		public $parentOrganizationType;
		
		//Unknown
		private static $unknown;
		protected $isUnknown=false;

		//None
		private static $none;
		protected $isNone=false;
		
		function __construct($unknown=false,$none=false) {
			parent::__construct();
			$this->isUnknown=$unknown;
			$this->isNone=$none;
			if($none)
				$this->id=0;
			if(!$unknown && !$none)
				$this->parentOrganizationType=organizationType::getUnknown();
		}
		
		function getName() {
			if($this->isUnknown || is_null($this->id))
				return lang_lang::getSingleton()->get('Unknown organization_type');
			if($this->isNone || $this->id==0)
				return lang_lang::getSingleton()->get('None');
			return $this->name;
		}

		static function getUnknown() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$unknown = new $c(true);
			}
			return self::$unknown;
		}	

		static function getNone() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$none = new $c(false,true);
			}
			return self::$none;
		}			
	}