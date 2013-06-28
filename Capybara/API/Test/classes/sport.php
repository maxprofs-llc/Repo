<?php
	class sport extends baseClass {
		
		//Unknown
		private static $unknown;
		protected $isUnknown=false;

		function __construct($unknown=false) {
			parent::__construct();
			$this->isUnknown=$unknown;
		}

		function getName() {
			$lang=lang_lang::getSingleton();
			if(is_null($this->name)) 
				return '';
			else 
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
?>