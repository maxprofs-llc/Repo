<?php
	class pages_rolesPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="roles/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Roles'),'roles.php')));
			$this->head->addJavascript("roles/functions.js");
			$this->head->addJavascript("roles/external.js");
			$this->head->addJavascript("cities/external.js");
			$this->head->addJavascript("states/external.js");
			$this->head->addJavascript("countries/external.js");
			$this->head->addJavascript("continents/external.js");
			$this->head->addJavascript("organizations/external.js");
		}
		
		
	}

?>