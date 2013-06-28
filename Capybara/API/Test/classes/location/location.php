<?php
	class location_location extends locatable_inCity {
		
		//Unknown
		protected static $unknown;
		protected $isUnknown=false;
				
		function prepareForSerialization() {
			parent::prepareForSerialization();
		}

		function __construct($unknown=false) {
			parent::__construct();
			helper::debugPrint('Create city','location');
			$this->isUnknown=$unknown;
		}

		static function getUnknown() {
			helper::debugPrint('Get unknown '.$c,'location');
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$unknown = new $c();
			}
			helper::debugPrint('Return '.get_class(self::$unknown),'location');			
			return self::$unknown;
		}	
	}
?>