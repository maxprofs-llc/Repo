<?php
	class html_dataGrid extends html_htmlEntity {
		public $rows;
		public $columns;
		
		public function __construct() {
			$this->rows=new baseClassList();
			$this->columns=new baseClassList();
		}
		
		function addColumns($columns) {
			foreach($columns as $column) {
				$this->addColumn($column);
			}
		}
		
		function addColumn($columnCaption='') {
			$column=new html_dataGridColumn($columnCaption);
			$this->columns->Append($column);
			return $column;
		}
		
		function addRow($cells=NULL,$class=NULL) {
			$row=new html_dataGridRow();
			$row->cssClass=$class;
			$count=0;
			foreach($cells as $cellContents) {
				$cell=new html_dataGridCell($cellContents);
				$row->addCell($cell);
				$count+=1;
			}
			if($count<$this->columns->count())
				$cell->span=($this->columns->count()-$count)+1;
			$this->rows->Append($row);
			return $row;
		}		
		
		function printHTML() {
			print "<table";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			print ">";
			print "<tr>";
			print "<td></td>";
			foreach($this->columns as $col) {
				print $col->headerCell->printHTML();
			}
			print "</tr>";
			foreach($this->rows as $row) {
				print "<tr";
				print " class='$row->cssClass'";
				print ">";
				print $row->headerCell->printHTML();
				foreach($row->cells as $cell) {
					print $cell->printHTML();
				}
				print "</tr>";
			}
			print "</table>";
			$this->doLoadScript();
		}
	}