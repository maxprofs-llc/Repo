<?php
	class pages_matchesPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="matches/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Matches'),'matches.php')));
			$this->head->addJavascript("matches/functions.js");			
			$this->head->addJavascript("matches/external.js");
			$this->head->addJavascript("arenas/external.js");
			$this->head->addJavascript("cities/external.js");
			$this->head->addJavascript("states/external.js");
			$this->head->addJavascript("countries/external.js");
			$this->head->addJavascript("continents/external.js");
			$this->head->addJavascript("persons/external.js");
			$this->head->addJavascript("geoDirections/external.js");
			$this->head->addJavascript("organizations/external.js");
			$this->head->addJavascript("teams/external.js");
			$this->head->addJavascript("roles/external.js");
			$this->head->addJavascript("sports/external.js");
			$this->head->addJavascript("precipitationTypes/external.js");
			$this->head->addJavascript("periodTypes/external.js");
			$this->head->addJavascript("cardTypes/external.js");
			$this->head->addJavascript("../classes/ckeditor/ckeditor.js");
			$this->head->addJavascript("images/external.js");
		}
		
		
	}
?>