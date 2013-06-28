<?php
	class pages_cardTypesPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="cardTypes/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Card_types'),'cardTypes.php')));
			$this->head->addJavascript("cardTypes/functions.js");
			$this->head->addJavascript("cardTypes/external.js");
		}
		
		
	}

?>