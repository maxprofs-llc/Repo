<?php
	class html_text extends html_htmlEntity {
		
		public $text;
		public $name;
		
		public function __construct($text='',$class='') {
			$this->text=$text;
			$this->cssClass=$class;
		}
		
		function printHTML() {
			print "<input type='text'";
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