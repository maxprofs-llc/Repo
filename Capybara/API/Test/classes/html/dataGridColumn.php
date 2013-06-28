<?php
	class html_dataGridColumn  {
		
		public $headerCell;
		
		function __construct($headerCell='') {
			$this->headerCell=new html_th($headerCell);
		}
	}
	
?>