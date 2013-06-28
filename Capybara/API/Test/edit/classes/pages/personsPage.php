<?php
	class pages_personsPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="persons/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Persons'),'persons.php')));
			$this->head->addJavascript("persons/functions.js");
			$this->head->addJavascript("persons/external.js");
			$this->head->addJavascript("cities/external.js");
			$this->head->addJavascript("states/external.js");
			$this->head->addJavascript("countries/external.js");
			$this->head->addJavascript("continents/external.js");
			$this->head->addJavascript("organizations/external.js");
			$this->head->addJavascript("teams/external.js");
			$this->head->addJavascript("roles/external.js");
			$this->head->addJavascript("images/external.js");
		}
		
		
	}

?>