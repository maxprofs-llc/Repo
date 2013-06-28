<?php
	class pages_geoDirectionsPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="geoDirections/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Geographical_directions'),'geoDirections.php')));
			$this->head->addJavascript("geoDirections/functions.js");
			$this->head->addJavascript("geoDirections/external.js");
		}
	}

?>