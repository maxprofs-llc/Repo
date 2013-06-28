<?php
	class html_thead extends html_htmlEntity {
	
		public function __construct($class=NULL) {
			parent::__construct();
			$this->cols=new ArrayObject();
		}	
		
		function addColumn($column) {
			$this->cols->Append($column);
		}

		public function printColumns() {
			foreach($this->cols as $col) {
				if(is_object($col) && is_a($col,'html_col'))
					$col->printHTML();
			}
		}

		function printHTML() {
			print "<thead>";
			$this->printColumns();
			$this->printChildEntities();
			print '</thead>';
		}
	}
?>