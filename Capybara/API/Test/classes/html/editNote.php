<?php
	class html_editNote extends html_note {
		public $editText;
		
		function __construct($text='',$editText='',$class='') {
			parent::__construct($text,$class);
			$this->editText=$editText;
		}
		
		function printHTML() {
			print "<span class='note";
			if(!is_null($this->cssClass))
				print ' '.$this->cssClass;
			print "' ";
			if(!is_null($this->id))
				print " id='$this->id'";
			print "><span class='editText'>$this->editText</span></span>";
			print "<div id='".$this->id."_script'>";
			$cont=implode('',file(__DIR__."/scripts/editNote.js"));
			print "<script>";
			print $cont;		
			print "initNote('$this->text',$('$this->id'));";
			print "$('".$this->id."_script').dispose();";
			print "</script>";
			print "</div>";
		}
	}