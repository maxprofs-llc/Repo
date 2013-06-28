<?php
	class pages_statesPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="states/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('States'),'states.php')));
			$this->head->addJavascript("states/functions.js");
			$this->head->addJavascript("states/external.js");
			$this->head->addJavascript("cities/external.js");
			$this->head->addJavascript("countries/external.js");
			$this->head->addJavascript("continents/external.js");
		}
		
		
	}

?>