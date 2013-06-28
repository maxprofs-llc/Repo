<?php
	class html_img extends html_htmlEntity {
		public $src;
		public $alt;
		
		public function __construct($src='',$alt='') {
			parent::__construct();			
			$this->src=$src;
			$this->alt=$text;
		}
				
		function printHTML() {
			print "<img";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			if($this->colspan>1)
				print " colspan='$this->colspan'";
				
			print " src='$this->src' alt='$this->alt' />";
		}
		
	}
?>