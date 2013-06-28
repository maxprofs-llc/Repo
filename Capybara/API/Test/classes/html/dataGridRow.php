<?php
	class html_dataGridRow {

		public $cells;
		public $headerCell;
		public $cssClass;
		
		function __construct($headerCell='') {
			$this->cells=new baseClassList();
			$this->headerCell=new html_td($headerCell);
		}

		function addCell(html_dataGridCell $cell) {
			$this->cells->Append($cell);
		}
		
	}
?>