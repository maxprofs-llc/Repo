<?php
	class html_td extends html_htmlEntity {
	
		public $colspan;
	
		public function __construct($text='',$colspan=1,$class='') {
			parent::__construct();			
			$this->colspan=$colspan;
			if(is_object($text) && is_a($text,'html_htmlEntity')) {
				$this->addEntity($text);
			} elseif(is_array($text)) {
				foreach($text as $el) {
					if(is_a($el,'html_htmlEntity'))
						$this->addEntity($el);
					else
						$this->addEntity(new html_plainText($el));
				}
			} else {
				$this->innerText=$text;
			}
			$this->cssClass=$class;
		}
		
		function printHTML() {
			print "<td";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			if($this->colspan>1)
				print " colspan='$this->colspan'";
			if(!is_null($this->onclick))
				print " onclick=\"" . $this->onclick . "\"";
				
			print ">";
			print $this->innerText;
			$this->printChildEntities();
			print '</td>';
		}

	}
	
?>