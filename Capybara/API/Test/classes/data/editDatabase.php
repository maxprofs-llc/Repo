<?php
	class data_editDatabase extends data_database {
		
		private $editLink;
		
		function __construct() {
			parent::init();
		}
		
		function connect() {
			$conf=$this->conf;
			$this->editLink = mysql_connect($conf->get('db_host_ip').':'.$conf->get('db_host_port'), $conf->get('db_username'), $conf->get('db_password'),true);	
			parent::selectDB($conf->get('db_name'));
		}
		
		function getLink() {
			return $this->editLink;
		}
		
	}