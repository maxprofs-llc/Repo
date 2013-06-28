<?php

	class html_tooltip extends html_htmlEntity {
		
		private $text;
		
		function __construct($text='') {
			$this->text=$text;
		}
		
		function printHTML() {
			print "<span class='tooltip'>$this->text</span>";
		}
	}
?>