<?php
	class html_col extends html_htmlEntity {
		
		public $span;
		
		public function __construct($span=1,$class='') {
			parent::__construct();
			$this->span=$span;
			$this->cssClass=$class;
		}
		
		function printHTML() {
			print "<colgroup";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			if($this->span>1)
				print " span='$this->span'";
				
			print "></colgroup>";
		}
	}
	
?>