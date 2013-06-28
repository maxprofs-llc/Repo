<?php
	class pages_precipitationTypesPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="precipitationTypes/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Precipitation_types'),'precipitationTypes.php')));
			$this->head->addJavascript("precipitationTypes/functions.js");
			$this->head->addJavascript("precipitationTypes/external.js");
		}
		
		
	}

?>