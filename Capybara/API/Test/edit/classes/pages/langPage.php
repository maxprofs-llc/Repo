<?php
	class pages_langPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="lang/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Languages'),'lang.php')));
			$this->head->addJavascript("lang/functions.js");			
		}
		
		
	}
?>