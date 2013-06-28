<?php
	class html_script extends html_htmlEntity {
	
		public $script;
			
		public function __construct($script='') {
			parent::__construct();
			$this->script=$script;
		}

		function printHTML() {
			print '<script language="javascript" type="text/javascript">';
			print $this->script;
			print '</script>';	
		}
	}
?>