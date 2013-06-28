<?php
	class pages_sportsPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="sports/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Sports'),'sports.php')));
			$this->head->addJavascript("sports/functions.js");
			$this->head->addJavascript("sports/external.js");
		}
		
		
	}

?>