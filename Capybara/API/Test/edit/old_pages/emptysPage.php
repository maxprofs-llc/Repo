<?
	class emptysPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="emptys/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Emptys'),'emptys.php')));
			$this->head->addJavascript("emptys/functions.js");
		}
		
		
	}

?>