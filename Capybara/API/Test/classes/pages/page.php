<?php
	class pages_page {
	
		public $head;
		public $footer;
		public $contents;
		public $topmenu;
		public $rightmenu;
		public $runscripts;
		public $preloadScript;
		protected $lang;
		protected $conf;
		
		function __construct() {
			
			$this->head=new html_head();

			$contents=new html_div();
			$contents->id='siteContents';
			$this->contents=$contents;

			$this->lang=lang_lang::getSingleton();
			$this->conf=config_conf::getSingleton();
			
			$this->footer=new html_div('Rodentia Software');
			$this->footer->id='siteFooter';
		}
	
		public function createTable($cols,$headline=false,$id='') {
				$table=new html_table();
				$table->id=$id;
				
				if($headline) {
					$tr=new html_tr();
					$th=new html_th($headline,$cols);
					$th->cssClass='headline';
					$tr->addEntity($th);
					$table->addEntity($tr);		
				}		
				return $table;
		}
		
		public function addSubTitle($table,$cells,$classes=false) {
			$tr=new html_tr();
			$tr->addEntities('td',$cells,'subheadline',$classes);
			$table->addEntity($tr);
		}
	
		
		function printHTML() {
			print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
			print '<html xmlns="http://www.w3.org/1999/xhtml" lang="se">';
			
			$this->head->printHTML();
			
			print '<body id="documentBody">';
			
			$navMenu=new html_div();
			$navMenu->id="navigationMenu";
			$navMenu->addEntity($this->topmenu);
			$navMenu->printHTML();
			
			$this->contents->printHTML();
		
			$rightMenu=new html_div();
			$rightMenu->id="rightMenu";
			$rightMenu->addEntity($this->rightmenu);
			$rightMenu->printHTML();
			
			if(!is_null($runscripts))
			{
				print '<script language="javascript" type="text/javascript">';
				foreach($runscripts as $script)
				{
					print $script;
				}
				print '</script>';
			}
			$this->footer->printHTML();
			print '</body>';
			print '</html>';
		}


	}
?>