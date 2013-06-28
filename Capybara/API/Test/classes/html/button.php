<?php
	class html_button extends html_htmlEntity {
		
		public $onclick;
		public $isSubmit;
		
		public function __construct($text='',$class='',$onclick='') {
			$this->innerText=$text;
			$this->cssClass=$class;
			$this->onclick=$onclick;
			$this->isSubmit=false;
		}
		function printHTML() {
			print $this->isSubmit ? "<input type='submit'" : "<input type='button'";
			if(!is_null($this->id))
				print " id='$this->id'";
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