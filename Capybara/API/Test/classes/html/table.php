<?php
	class html_table extends html_htmlEntity {
		public $cols;

		public function __construct($class='') {
			parent::__construct();
			$this->cols=new ArrayObject();
			$this->cssClass=$class;
		}

		function addColumn($column) {
			$this->cols->Append($column);
		}

		public function printColumns() {
			foreach($this->cols as $col) {
				$col->printHTML();
			}
		}
	
		function printHTML() {
			print "<table";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			print ">";
			$this->printColumns();
			$this->printChildEntities();
			print '</table>';
		}
	}
?>