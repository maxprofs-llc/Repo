<?php
	class pages_gendersPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="genders/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Genders'),'genders.php')));
			$this->head->addJavascript("genders/functions.js");
			$this->head->addJavascript("genders/external.js");
		}	
	}

?>