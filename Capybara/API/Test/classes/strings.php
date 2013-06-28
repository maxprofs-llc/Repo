<?php
	class strings implements Encoding_iEncodable {
	
		private $props;
		private $Encode;
		
		public function __construct() {
			$this->Encode=array();
		}
		
		public function __get($name) {
			if(isset($this->props[$name]))
				return $this->props[$name];
			return "";
		}
		
		public function __set($name,$value) {
			$this->props[$name]=$value;
			$this->$name=$value;
		}
		
		public function getData($row,$prefix='') {
			foreach($row as $prop => $value) {
				if(stripos($prop,$prefix)!==false) {
					//helper::debugPrint($prop . ' => ' . $value,'strings');
					$this->props[substr($prop,strlen($prefix))]=$row->$prop;
					$this->addVarToList(substr($prop,strlen($prefix)));
				}
			}
		}	
		
		public function getVarList() {
			return $this->Encode;
		}
		
		public function addVarToList($var) {
			if(!in_array($var,$this->Encode))
				$this->Encode[]=$var;
		}
		
	}
?>