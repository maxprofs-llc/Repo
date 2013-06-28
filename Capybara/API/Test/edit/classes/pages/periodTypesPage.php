<?php
	class pages_periodTypesPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="periodTypes/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Period_types'),'periodTypes.php')));
			$this->head->addJavascript("periodTypes/functions.js");
			$this->head->addJavascript("periodTypes/external.js");
		}
		
		
	}

?>