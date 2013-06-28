<?php
	class html_textarea extends html_htmlEntity {
		
		public $rows;
		public $cols;
		
		public function __construct($text='',$rows=4,$cols=20) {
			$this->innerText=$text;
			$this->rows=$rows;
			$this->cols=$cols;
		}
		
		function printHTML() {
			print "<textarea rows='$this->rows' cols='$this->cols'";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			print ">" . $this->innerText;
			print "</textarea>";
		}
	}
?>