<?php

	class html_list extends html_dropDown {

		function printHTML() {
			print "<select";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			if(!is_null($this->onclick))
				print " onclick='$this->onclick'";
			if(!is_null($this->onchange))
				print " onchange='$this->onchange'";
			print " multiple=''>";
			
			$this->printChildEntities();
			
			print "</select>";
		}	
	}
?>