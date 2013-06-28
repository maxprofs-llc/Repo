<?php
	class team_cohort extends baseClass {
		
		//Properties
		
		public $startDate;	//Minimum birthdate to be considered a part of this cohort
		public $endDate;	//Maxumum birthdate to be considered a part of this cohort
		
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
		}

		function getName() {
			if($this->isUnknown || is_null($this->id))
				return lang_lang::getSingleton()->get('Unknown cohort');
			if($this->isNone || $this->id==0)
				return lang_lang::getSingleton()->get('No_cohort');
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