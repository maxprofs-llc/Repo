<?php
	class html_li extends html_htmlEntity {
				
		public function __construct($text='',$class='') {
			parent::__construct();
			if(is_object($text) && is_a($text,'html_htmlEntity'))
				$this->addEntity($text);
			else
				$this->innerText=$text;
			$this->cssClass=$class;
		}
		
		function printHTML() {
			print "<li";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			print ">";
			print $this->innerText;
			$this->printChildEntities();
			print "</li>\n";
		}
	}
?>