<?php
	class html_head extends html_htmlEntity {
		
		public $stylesheets;
		public $javascripts;
		public $javascriptVars;
		public $title;
		public $charset;
		
		public function __construct() {
			parent::__construct();
			
			$this->stylesheets=new ArrayObject();
			$this->javascripts=new ArrayObject();
			$this->javascriptVars=array();
			$this->charset='UTF-8';
		}
		
		public function addStyleSheet($path) {
			$this->stylesheets->Append($path);
		}

		public function addJavascript($path) {
			$this->javascripts->Append($path);
		}
		
		public function addJavascriptVar($name,$value) {
			$this->javascriptVars[$name]=$value;
		}
	
		public function printHTML() {
			print "<head>\n";
			print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=\"".$this->charset."\" />\n";
			print "<title>$this->title</title>\n";
			if(count($this->javascriptVars)>0) {
				print "<script language=\"javascript\" type=\"text/javascript\" charset=\"".$this->charset."\">\n";
				foreach($this->javascriptVars as $name=>$value) {
					print "var $name=$value;\n";
				}
				print "</script>\n";
			}
			foreach($this->stylesheets as $css)
			{
				print '<link rel="stylesheet" href="' . $css . '" />'."\n";
			}
			foreach($this->javascripts as $script)
			{
				print "<script language=\"javascript\" type=\"text/javascript\" src=\"" . $script . "\" charset=\"".$this->charset."\"></script>\n";
			}
			print "</head>\n";
		}
	}
?>