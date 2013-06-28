<?php
	class cardType extends baseClass {
		
		//Unknown
		private static $unknown;
		protected $isUnknown=false;
		
		function __construct($unknown=false) {
			parent::__construct();
			$this->isUnknown=$isUnknown;
		}
		
		function prepareForSerialization() {
			parent::prepareForSerialization();
		}
		
		public function getName() {
			if($this->isUnknown || is_null($this->id))
				return lang_lang::getSingleton()->get('Unknown_card_type');
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