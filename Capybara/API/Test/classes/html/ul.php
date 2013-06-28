<?php
	class html_ul extends html_htmlEntity {
	
		public function __construct() {
			parent::__construct();			
		}
		
		function printHTML() {
			print "<ul";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			print ">";
			$this->printChildEntities();
			print '</ul>';
		}		
	}
?>