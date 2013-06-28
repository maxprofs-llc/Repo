<?php
	class html_note extends html_htmlEntity {
		
		public $text;
		
		function __construct($text='',$class='') {
			$this->text=$text;
			$this->cssClass=$class;	
		}
		
		function printHTML() {
			print "<span class='note";
			if(!is_null($this->cssClass))
				print ' '.$this->cssClass;
			print "' ";
			if(!is_null($this->id))
				print " id='$this->id'";
			print "><span class='noteText'>".$this->text."</span></span>";
			print "<div id='".$this->id."_script'>";
			$cont=implode('',file(__DIR__."/scripts/note.js"));
			print "<script>";
			print $cont;		
			print "initNote('$this->text',$('$this->id'));";
			print "$('".$this->id."_script').dispose();";
			print "</script>";
			print "</div>";
		}
	}