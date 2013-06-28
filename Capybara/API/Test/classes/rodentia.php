<?php

	class rodentia {
		
		private $api;
		
		public function __construct() {
			$this->api=new api_api();
		}
		
		public function api() {
			return $this->api;
		}
		
		public function request($request) {
			return $this->api->request($request);
		}
		
		public static function login($usernameOrApiKey,$password=false) {
			if($password) {
				$_POST['loginUsername']=$usernameOrApiKey;
				$_POST['loginPassword']=$password;
			} else {
				$_GET['api_key']=$usernameOrApiKey;
			}
			$sess=new data_session();
			return self::loginStatus();
		}
		
		public static function loginStatus() {
			$sess=new data_session();
			if(!$sess->checkLogin(false,false))
				return false;
			$return=new stdClass();
			$return->status='logged_in';
			$return->timeLeftUntilLogout=$sess->timeLeftUntilLogout;
			return $return;
		}
	}

?>