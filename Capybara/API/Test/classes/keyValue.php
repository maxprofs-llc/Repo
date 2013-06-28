<?php
	class keyValue {
		public $id;
		public $_name;
		public $_string;
		public $_longString;
		public $_class;
		
		function __construct($object=NULL) {
			if(!is_null($object)) {
				$this->id=$object->id;
				if(!is_object($object)) {
					debug_print_backtrace();
				}
				$this->_name=$object->getName();
				$this->_string=$object->__toString();
				$this->_longString=$object->getLongString();
				$this->_class=get_class($object);
			} else {
				$this->id=NULL;
				$this->_name="";
			}
		}
		
		function getName() {
			return $this->_name;
		}
		
		function getString() {
			return $this->_string;
		}
		
		function getLongString() {
			return $this->_longString;	
		}
		
		function getJSON() {
			return json_encode($this);
		}
		
		static function FromBaseClass(baseClass $object) {
			return new keyValue($object);
		}
	}