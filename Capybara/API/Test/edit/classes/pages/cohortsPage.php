<?php
	class pages_cohortsPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="cohorts/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Cohorts'),'cohorts.php')));
			$this->head->addJavascript("cohorts/functions.js");
			$this->head->addJavascript("cohorts/external.js");
		}
		
		
	}

?>