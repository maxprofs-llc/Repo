<?php
	class html_fileupload extends html_htmlEntity {
		public $name;
		
		function printHTML() {
			print "<input type='file'";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->name))
				print " name='$this->name'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			if(!is_null($this->innerText))
				print " value='$this->innerText'";
			if(!is_null($this->onclick))
				print " onclick=\"$this->onclick\"";
			print " />";
		}
	}
?>