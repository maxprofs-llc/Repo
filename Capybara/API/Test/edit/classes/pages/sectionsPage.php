<?php
	class pages_sectionsPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="sections/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Sections'),'sections.php')));
			$this->head->addJavascript("sections/functions.js");
			$this->head->addJavascript("sections/external.js");
		}
		
		
	}

?>