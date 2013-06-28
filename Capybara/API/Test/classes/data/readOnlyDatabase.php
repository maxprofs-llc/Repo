<?php
	class data_readOnlyDatabase extends data_database {
		
		private $readOnlyLink;

		function __construct() {
			parent::init();
		}
				
		function connect() {
			$conf=$this->conf;
			$this->readOnlyLink = mysql_connect($conf->get('db_host_ip').':'.$conf->get('db_host_port'), $conf->get('db_username'), $conf->get('db_password'));
			parent::selectDB($conf->get('db_name'));
		}
		
		function getLink() {
			return $this->readOnlyLink;
		}
		
	}
?>