<?php
	class html_dataGridCell {
		
		public $contents;
		public $span=1;
		
		function __construct($contents='') {
			$this->contents=new html_td($contents);
		}
		
		function printHTML() {
			if($this->span>1)
				$this->contents->colspan=$this->span;
			$this->contents->printHTML();
		}
	}
	
?>