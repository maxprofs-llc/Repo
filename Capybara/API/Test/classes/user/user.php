<?php
	class user_user extends baseClass {
		public $firstname;
		public $lastname;
		private $password;
		public $email;
		public $phone;
		public $privileges;
		public $configFile;
		
		function __construct() {
			parent::__construct();
			$this->privileges=new baseClassList();
		}
		
		function getName() {
			return $this->firstname.' '.$this->lastname;
		}
	}