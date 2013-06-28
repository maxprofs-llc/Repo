<?php
	class html_htmlHelper {
		
		private $controller;
		
		public function __construct($controller) {
			$this->controller=$controller;
		}
		
		public function getLink($text,$id=false,$controller=false) {
			if(!$controller)
				$controller=$this->controller;
			$url=new data_urlhelper();
			$uri=$url->createurl("~/$controller/");
			print "<a href='$uri".($id ? $id : "")."'>$text</a>";
		}
		
	}
?>