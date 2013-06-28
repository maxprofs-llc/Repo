<?php
	class html_form extends html_htmlEntity {
		
		public $action;
		public $method;
		
		function __construct($action='',$method='post') {
			parent::__construct();
			$this->method=$method;
			$this->action=$action;
		}
		
		function printHTML() {
			print "<form enctype='multipart/form-data'";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->id))
				print " name='$this->id'";
			if(!is_null($this->method))
				print " method='$this->method'";
			if(!is_null($this->action))
				print " action='$this->action'";
			print " >";
			
			$this->printChildEntities();
			
			print "</form>";
		}
	}
?>