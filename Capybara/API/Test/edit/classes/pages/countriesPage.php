<?php
	class pages_countriesPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="countries/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Countries'),'countries.php')));
			$this->head->addJavascript("countries/functions.js");
			$this->head->addJavascript("countries/external.js");
			$this->head->addJavascript("cities/external.js");
			$this->head->addJavascript("continents/external.js");
		}
		
		
	}

?>