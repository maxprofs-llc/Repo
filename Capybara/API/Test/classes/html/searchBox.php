<?php
	
	class html_searchBox extends html_htmlEntity {

		public $chosenId;
		public $chosenValue;
		public $listURL;
		public $addText='Add';
		public $addFunction;
		public $findText='Find';
		public $findFunction;
		public $list=NULL;
		public $showAddButton=true;
		public $showFindButton=true;
		private $autoUpdate=false;
		
		public function __construct($text='',$class='') {
			parent::__construct();
			if(is_object($text) && is_a($text,'html_htmlEntity'))
				$this->addEntity($text);
			else
				$this->innerText=$text;
			$this->cssClass=$class;
		}

		function printHTML() {
			if($this->findFunction=='')
				$this->showFindButton=false;
			print "<div";
			if(!is_null($this->id))
				print " id='$this->id'";
			
			print " class='searchBox $this->cssClass'";
			print "><input type='hidden' name='listURL' id='". $this->id ."_listURL' value='$this->listURL' /><input type='hidden' name='id' id='". $this->id ."_id' value='$this->chosenId' /><input type='hidden' name='value' id='". $this->id ."_value' value='$this->chosenValue' /><input type='text' value='$this->chosenValue' />";
			print "<input type='hidden' name='findFunction' id='". $this->id ."_findFunction' value='$this->findFunction' />";
			if($this->showAddButton)
				print "<div class='addButton' onclick='$this->addFunction'><span>$this->addText</span></div>";
			if($this->showFindButton)
				print "<div class='addFromMasterButton' onclick='$this->findFunction'><span>$this->findText</span></div>";
			print $this->innerText;
			if(!is_null($this->list))
			{
				print "<div class='list' style='display: none'>";
				print $this->list->getJSON();
				print "</div>";
			}
			if($this->autoUpdate)
				foreach($this->autoUpdate as $autoUpdate)
					print "<div class='autoUpdate' style='display: none'><span>".$autoUpdate['control']."</span><span>".$autoUpdate['lookup']."</span></div>";
			print '</div>';	
		}	
		
		function addAutoUpdate($control,$lookup) {
			if(!$this->autoUpdate)
				$this->autoUpdate=array();
			$this->autoUpdate[]=array('control'=>$control,'lookup'=>$lookup);
		}
	}