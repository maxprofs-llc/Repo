<?php
	class html_checkbox extends html_htmlEntity {
	
		public $name;
		public $checked;
		
		function printHTML() {
			print "<input type='checkbox'";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->name))
				print " name='$this->name'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			if(!is_null($this->onclick))
				print " onclick=\"$this->onclick\"";
			if($this->disabled)
				print " disabled='disabled'";
			if($this->checked)
				print " checked='checked'";
			print " />";		
		}
	}
?>