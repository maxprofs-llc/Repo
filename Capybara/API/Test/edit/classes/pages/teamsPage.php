<?php
	class pages_teamsPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="teams/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Teams'),'teams.php')));
			$this->head->addJavascript("teams/functions.js");
			$this->head->addJavascript("teams/external.js");
			$this->head->addJavascript("arenas/external.js");
			$this->head->addJavascript("cities/external.js");
			$this->head->addJavascript("countries/external.js");
			$this->head->addJavascript("continents/external.js");
			$this->head->addJavascript("states/external.js");
			$this->head->addJavascript("sports/external.js");
			$this->head->addJavascript("genders/external.js");
			$this->head->addJavascript("sections/external.js");
			$this->head->addJavascript("cohorts/external.js");
			$this->head->addJavascript("ageGroups/external.js");
			$this->head->addJavascript("organizations/external.js");
			$this->head->addJavascript("images/external.js");
		}
		
		
	}
?>