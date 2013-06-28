<?php
	class html_expandableDiv extends html_div {
		
		public $expandedText;
		public $collapsedText;
		public $expanderCssClass;
		
		public function __construct($expandedText='',$collapsedText='',$text='',$class='') {
			parent::__construct($text,$class);
			$this->innerText=$text;
			$this->cssClass='expander_contents ' . $class;
			$this->expandedText=$expandedText;
			$this->collapsedText=$collapsedText;
		}

		function printHTML() {
			$expid=$this->id . "_expander";
			print "<span class='expander $this->expanderCssClass' id='$expid'><span class='expanded'>$this->expandedText</span><span class='collapsed'>$this->collapsedText</span></span>";
			parent::printHTML();
		}
	}
	
?>