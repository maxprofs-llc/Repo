<?php
	abstract class locatable_inStreet extends locatable_inCity {
		//Properties
		
		public $streetName;		//Street address
		public $streetNumber;	//Street number
		public $zipCode;		//Zip code for address
		public $zipArea;		//Zip area for address		

		function prepareForSerialization() {
			helper::debugPrint('Prepare location for JSON','arena');
			parent::prepareForSerialization();
		}
		
		function __construct() {
			parent::__construct();
		}
		
	} 