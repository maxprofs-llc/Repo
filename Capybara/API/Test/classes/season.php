<?php
	class season extends baseClass {
		//Unknown
		private static $unknown;
		protected $isUnknown=false;

		//None
		private static $none;
		protected $isNone=false;
		
		function getName() {
			return $this->name;
		}
		
		static function getNone() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$none = new $c(false,true);
			}
			return self::$none;
		}
				
		static function getUnknown() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$unknown = new $c(true);
			}
			return self::$unknown;
		}
	}