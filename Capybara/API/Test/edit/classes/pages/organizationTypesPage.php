<?php
	class pages_organizationTypesPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="organizationTypes/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Match_types'),'organizationTypes.php')));
			$this->head->addJavascript("organizationTypes/functions.js");			
			$this->head->addJavascript("organizationTypes/external.js");			
		}
		
		
	}
?>