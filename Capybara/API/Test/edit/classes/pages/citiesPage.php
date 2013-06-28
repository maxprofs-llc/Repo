<?php
	class pages_citiesPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="cities/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Cities'),'cities.php')));
			$this->head->addJavascript("cities/functions.js");
			$this->head->addJavascript("cities/external.js");
			$this->head->addJavascript("states/external.js");
			$this->head->addJavascript("countries/external.js");
			$this->head->addJavascript("continents/external.js");
		}
		
		
	}

?>