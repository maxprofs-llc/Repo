<?php
	class pages_ageGroupsPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="ageGroups/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Age_groups'),'ageGroups.php')));
			$this->head->addJavascript("ageGroups/functions.js");
			$this->head->addJavascript("ageGroups/external.js");
		}
		
		
	}

?>