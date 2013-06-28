<?php
	class data_masterDatabase extends data_database {
		
		private $masterLink;
		
		function __construct() {
			parent::init();
		}

		function connect() {
			$conf=$this->conf;
			
			$this->masterLink = mysql_connect($conf->get('db_master_host_ip').':'.$conf->get('db_master_host_port'), $conf->get('db_master_username'), $conf->get('db_master_password'));
			
			parent::selectDB($conf->get('db_master_name'));
		}
		
		function getLink() {
			return $this->masterLink;
		}		
	}
?>