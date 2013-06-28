<?php
	class pages_arenasPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="arenas/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Arenas'),'arenas.php')));
			$this->head->addJavascript("arenas/functions.js");
			$this->head->addJavascript("arenas/external.js");
			$this->head->addJavascript("cities/external.js");
			$this->head->addJavascript("states/external.js");
			$this->head->addJavascript("countries/external.js");
			$this->head->addJavascript("continents/external.js");
			$this->head->addJavascript("images/external.js");
		}
		
		
	}
?>