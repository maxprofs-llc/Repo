<?php
	class pages_imagesPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="images/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Images'),'images.php')));
			$this->head->addJavascript("images/functions.js");
			$this->head->addJavascript("images/external.js");
		}
		
		
	}

?>