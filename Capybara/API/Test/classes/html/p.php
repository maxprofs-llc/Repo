<?php
	class html_p extends html_htmlEntity {
				
		public function __construct($text='',$class='') {
			parent::__construct();
			$this->innerText=$text;
			$this->cssClass=$class;
		}
		
		function printHTML() {
			if(!$this->visible)
				return;
			print "<p";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			print ">";
			print $this->innerText;
			$this->printChildEntities();
			print '</p>';
		}
	}
?>