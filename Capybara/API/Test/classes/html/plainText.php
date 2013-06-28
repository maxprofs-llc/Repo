<?php

	class html_plainText extends html_htmlEntity {
		
		public $text;
		
		function __construct($text='') {
			$this->text=$text;
		}
		
		function printHTML() {
			print $this->text;
		}
	}

?>