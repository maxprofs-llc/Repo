<?php
	class html_password extends html_htmlEntity {

		public $name;

		public function __construct($class='') {
			$this->cssClass=$class;
		}
		
		function printHTML() {
			print "<input type='password'";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->name))
				print " name='$this->name'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			if(!is_null($this->text))
				print " value='$this->text'";
			if(!is_null($this->onclick))
				print " onclick='$this->onclick'";
			if(!is_null($this->onchange))
				print " onchange='$this->onchange'";
			if($this->disabled)
				print " disabled='disabled'";
			print " />";
		}
	
	}
?>