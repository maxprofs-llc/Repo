<?php
	class pages_usersPage extends pages_editPage {
		
		public function __construct() {
			$this->preloadScript="users/preload.js";			
			parent::__construct();
			$this->topmenu->addEntity(new html_li('>','divider'));
			$this->topmenu->addEntity(new html_li(new html_a($this->lang->get('Users'),'users.php')));
			$this->head->addJavascript("users/functions.js");
			$this->head->addJavascript("users/external.js");
			$this->head->addJavascriptVar('addPrivilegeString',"'".$this->lang->get('Privilege scope')."'");
		}
		
		
	}
?>