<?php
	class html_mapLocation extends html_htmlEntity {
		
		public $longitude;
		public $latitude;
		public $helpText='';
		public $centerButtonText='Center on location';
		public $resetButtonText='Revert position';
		public $findButtonText='Find address on map';
		public $addressButtonText='Get address';
		
		protected $longInput;
		protected $latInput;
		
		function __construct() {
			parent::__construct();
		}
		
		function printHTML() {
			$lang=lang_lang::getSingleton();
			print "<div";
			if(!is_null($this->id))
				print " id='$this->id'";
			print " class='mapContainer ";	
			if(!is_null($this->cssClass))
				print $this->cssClass;
			print "'>";
			print "<input type='hidden' value='$this->latitude' id='".$this->id."_lat' />";
			print "<input type='hidden' value='$this->longitude' id='".$this->id."_long' />";
			print "<div id='".$this->id."_map' class='mapViewport'></div>";
			print "<div class='mapButtons'>";
			print "<ul>";
			print "<li><input type='button' name='btnCenter' value='".$this->centerButtonText."' /></li>";
			print "<li><input type='button' name='btnReset' value='".$this->resetButtonText."' /></li>";
			print "<li><input type='button' name='btnSearch' value='".$this->findButtonText."' /></li>";
			print "<li><input type='button' name='btnAddress' value='".$this->addressButtonText."' /></li>";
			print "<li>&nbsp;</li>";
			print "<li>".$lang->get("Coordinates").": <span class='mapPositionText'>-</span></li>";
			print "<li></li>";
			print "</ul>";
			print "</div>";
			print "<p class='mapHelptext'>$this->helpText</p>";
			print '</div>';
		}
	}
?>