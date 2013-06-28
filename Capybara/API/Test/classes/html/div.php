<?php
	class html_div extends html_htmlEntity {
		
		public $hidden=false;
		
		public function __construct($text='',$class='') {
			parent::__construct();
			if(is_object($text) && is_a($text,'html_htmlEntity'))
				$this->addEntity($text);
			else
				$this->innerText=$text;
			$this->cssClass=$class;
		}

		function printHTML() {
			print "<div";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			if($this->hidden)
				print " style='display: none;'";
			print ">";
			print $this->innerText;
			$this->printChildEntities();
			print '</div>';		
		}
	}
?>