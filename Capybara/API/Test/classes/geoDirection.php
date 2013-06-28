<?php
	class geoDirection extends baseClass {
		
		public $degrees;
		
		//Unknown
		private static $unknown;
		protected $isUnknown=false;
		
		function __construct($isUnknown=false) {
			parent::__construct();
			$this->isUnknown=$isUnknown;
		}
		
		function prepareForSerialization() {
			parent::prepareForSerialization();
		}
		
		public function getName() {
			if($this->isUnknown) 
				return lang_lang::getSingleton()->get('Unknown_direction');
			return $this->name;
		}
	
		static function getUnknown() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$unknown = new $c(true);
			}
			return self::$unknown;
		}
	}