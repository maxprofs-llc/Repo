<?php
	class data_securityDatabase extends data_database {
		
		private $securityLink;
		
		function __construct() {
			parent::init();
		}

		function connect() {
			$conf=$this->conf;
			$this->securityLink = mysql_connect($conf->get('db_security_host_ip').':'.$conf->get('db_security_host_port'), $conf->get('db_security_username'), $conf->get('db_security_password'));
			parent::selectDB($conf->get('db_security_database'));
		}
		
		function getLink() {
			return $this->securityLink;
		}
		
	}
?>