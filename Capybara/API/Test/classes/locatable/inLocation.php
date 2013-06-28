<?php
	abstract class locatable_inLocation extends baseClass {

		//Properties
		
		public $longitude;		//Location longitude
		public $latitude;		//Location latitude
		
		//JSON
		
		public $_longitude;
		public $_latitude;
		
		function prepareForSerialization() {
			parent::prepareForSerialization();
			$this->_longitude=$this->getLongitude();
			$this->_latitude=$this->getLatitude();
		}
		
		function __construct() {
			parent::__construct();
			//$this->noJSON[]='longitude';
			//$this->noJSON[]='latitude';
		}
		
		public function getName() {
			return "";
		}
		
		public function getLongitude() {
			return $this->longitude;
		}

		public function getLatitude() {
			return $this->latitude;
		}		
	}
?>