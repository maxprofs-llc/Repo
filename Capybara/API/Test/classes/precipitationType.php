<?php
	class precipitationType extends baseClass {

		//Unknown
		private static $unknown;
		protected $isUnknown=false;
		
		//None
		private static $none;
		protected $isNone=false;
		
		function __construct($unknown=false,$none=false) {
			parent::__construct();
			$this->isUnknown=$isUnknown;
			$this->isNone=$none;
		}
		
		function prepareForSerialization() {
			parent::prepareForSerialization();
		}
		
		public function getName() {
			if($this->isUnknown || is_null($this->id))
				return lang_lang::getSingleton()->get('Unknown_precipitation');
			if($this->isNone || $this->id==0)
				return lang_lang::getSingleton()->get('No_precipitation');
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
?>