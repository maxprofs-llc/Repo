<?php
	class html_hidden extends html_htmlEntity {
		
		public $value;
		public $name;
		
		public function __construct($value='',$id='',$class='') {
			$this->value=$value;
			$this->cssClass=$class;
			$this->id=$id;
		}
		
		function printHTML() {
			print "<input type='hidden'";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->name))
				print " name='$this->name'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			if(!is_null($this->value))
				print " value='$this->value'";
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