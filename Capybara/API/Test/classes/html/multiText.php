<?php

	class html_multiText extends html_htmlEntity {
		
		protected $textInputs;
		public $defaultLabel;
		
		function addTextInput($label='',$defaultText='',$value=false) {
			$this->textInputs[] = array($label,$defaultText,$value);
		}
		
		function printHTML() {
			print "<table";
			if(!is_null($this->id))
				print " id='$this->id'";
			print ">";
			foreach($this->textInputs as $inp) {
				print "<tr><td>" . $inp[0];
				print "</td><td><input type='text' value='" . $inp[1] . "'";
				if($inp[0]==$this->defaultLabel)
					print " class='defaultValue'";
				if(!is_null($this->id))
					print " id='".$this->id."_".$inp[0]."'";
				print " />";
				if($inp[2])
					print "<input type='hidden' id='".$inp[0]."_id' value='$inp[2]' />";
				print "</td></tr>";
			}
			print "</table>";
		}
	}
?>