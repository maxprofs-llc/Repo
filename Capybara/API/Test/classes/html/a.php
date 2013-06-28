<?php
	class html_a extends html_htmlEntity {
		
		public $href;
		
		public function __construct($text='',$href='',$class='') {
			parent::__construct();
			$this->href=$href;
			$this->cssClass=$class;
			if(is_object($text) && is_a($text,'html_htmlEntity'))
				$this->addEntity($text);
			else
				$this->innerText=$text;
		}

		function printHTML() {
			print "<a";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			print " href='$this->href'>";
			$this->printChildEntities();
			print $this->innerText;
			print '</a>';
		}		

	}

?>