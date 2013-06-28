<?php
	class pages_organizationsPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="organizations/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Organizations'),'organizations.php')));
			$this->head->addJavascript("organizations/functions.js");
			$this->head->addJavascript("organizations/external.js");
			$this->head->addJavascript("organizationTypes/external.js");
			$this->head->addJavascript("images/external.js");
		}
		
		
	}

?>