<?php
	class html_autoUpdateDropDown extends html_dropDown {
		
		public $updateClass;
		public $unique=false;
		
		function __construct($updateClass,$class='',$unique=false) {
			parent::__construct($class);
			$this->updateClass=$updateClass;
			$this->unique=$unique;
		}
		
		function printHtml() {
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

			$id=base_convert(mt_rand(0, 0x38E38E3), 10, 36);

			print "<div id='$id'>";
			print "<div id='options'>{updateClass:'$this->updateClass',unique:".($this->unique ? 'true':'false')."}</div>";
			print "<script>";
			$cont=implode('',file(__DIR__."/scripts/autoUpdateDropDown.js"));
			print "var scriptDiv=$('$id');";
			print $cont;		
			print "initBox($(scriptDiv.getPrevious()),scriptDiv.getElement('#options').get('html'));";
			print "scriptDiv.dispose();";
			print "</script>";
			print "</div>";
		}
		
		function addOption($value,$text,$autoUpdate=false) {
			$opt=parent::addOption($value,$text);
			if($autoUpdate)
				$opt->cssClass='autoUpdate';
			return $opt;
		}
	}