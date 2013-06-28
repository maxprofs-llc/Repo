<?php
	class pages_continentsPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="continents/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Continents'),'continents.php')));
			$this->head->addJavascript("continents/functions.js");
			$this->head->addJavascript("continents/external.js");
		}
		
		
	}

?>