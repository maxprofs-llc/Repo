<?php
	class html_dropDown extends html_htmlEntity {

		public $onclick;
		
		function __construct($class='',$list=false) {
			parent::__construct();
			$this->cssClass=$class;
			if($list)
				foreach($list as $item)
					$this->addOption($item->id,$item->getName());
		}
		
		function setSelected($value) {
			foreach($this->entities as $ent) 
				if(is_a($ent,'option'))
					if($ent->value==$value)
						$ent->selected=true;
					else
						$ent->selected=false;
		}
		
		function printHTML() {
			print "<select";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			if(!is_null($this->onclick))
				print " onclick='$this->onclick'";
			if(!is_null($this->onchange))
				print " onchange='$this->onchange'";
			print ">";
			
			$this->printChildEntities();
			
			print "</select>";
		}

		function addOption($value,$text) {
			$opt=new option($value,$text);
			$this->addEntity($opt);
			return $opt;
		}
	}
	
	class option extends html_htmlEntity {
		
		public $value;
		public $selected;

		function __construct($value='',$text='') {
			parent::__construct();
			$this->innerText=$text;
			$this->value=$value;
			$this->selected=false;	
		}
	
		function printHTML() {
			print "<option value='" . $this->value . "'";
			if($this->selected)
				print " selected='selected'";
			if(!is_null($this->cssClass) && $this->cssClass!="")
				print " class='$this->cssClass'";
			print ">" . $this->innerText . "</option>";	
		}
	}
?>