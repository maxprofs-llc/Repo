<?php
	class html_autoUpdateComboBox extends html_htmlEntity {
		
		public $updateClass;
		
		function __construct($updateClass) {
			$this->updateClass=$updateClass;
		}
		
		function printHtml() {
			print "<select></select>";
			$id=base_convert(mt_rand(0, 0x38E38E3), 10, 36);
			print "<div id='$id'>";
			print "<div id='options'>{updateClass:'$this->updateClass'}</div>";
			print "<script>";
			$cont=implode('',file(__DIR__."/scripts/autoUpdateComboBox.js"));
			print "var scriptDiv=$('$id');";
			print $cont;		
			print "initBox($(scriptDiv.getPrevious()),scriptDiv.getElement('#options').get('html'));";
			print "scriptDiv.dispose();";
			print "</script>";
			print "</div>";
		}
	}