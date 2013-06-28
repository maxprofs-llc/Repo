<?php
	class html_ajaxBox extends html_htmlEntity {
	
		public $chosenId;
		public $chosenValue;
		public $listURL;
		public $addText='Add';
		public $addFunction;
		
		public function __construct($text='',$class='') {
			parent::__construct();
			if(is_object($text) && is_a($text,'html_htmlEntity'))
				$this->addEntity($text);
			else
				$this->innerText=$text;
			$this->cssClass=$class;
		}

		function printHTML() {
			print "<div";
			if(!is_null($this->id))
				print " id='$this->id'";
			
			print " class='ajaxBox $this->cssClass'";
			print "><input type='hidden' name='listURL' id='". $this->id ."_listURL' value='$this->listURL' /><input type='hidden' name='id' id='". $this->id ."_id' value='$this->chosenId' /><input type='hidden' name='value' id='". $this->id ."_value' value='$this->chosenValue' /><input type='text' value='$this->chosenValue' /><div class='addButton' onclick='$this->addFunction'><span>$this->addText</span></div>";
			print $this->innerText;
			print '</div>';	
		}		
	}