<?php
	class html_th extends html_htmlEntity {
	
		public $colspan;
		
		public function __construct($text='',$colspan=1) {
			parent::__construct();			
			$this->colspan=$colspan;
			if(is_a($text,'html_htmlEntity'))
				$this->addEntity($text);
			else
				$this->innerText=$text;
		}
		
		function printHTML() {
			print "<th";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			if($this->colspan>1)
				print " colspan='$this->colspan'";
				
			print ">";
			print $this->innerText;
			$this->printChildEntities();
			print '</th>';
		}
	}

?>