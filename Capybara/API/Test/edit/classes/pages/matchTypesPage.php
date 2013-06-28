<?php
	class pages_matchTypesPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="matchTypes/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Match_types'),'matchTypes.php')));
			$this->head->addJavascript("matchTypes/functions.js");			
			$this->head->addJavascript("matchTypes/external.js");			
		}
		
		
	}
?>