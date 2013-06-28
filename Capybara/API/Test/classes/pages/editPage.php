<?php
		class pages_editPage extends pages_page {

		function __construct() {
			parent::__construct();

			$lang=$this->lang;
			$conf=$this->conf;
			$sess=new data_session();
						
			$head=new html_head();
			$head->addJavascriptVar('addString',"'".$lang->get('Add')."'");
			$head->addJavascriptVar('addNewString',"'".$lang->get('Add new')."'");
			$head->addJavascriptVar('cancelString',"'".$lang->get('Cancel')."'");
			$head->addJavascriptVar('findInMasterString',"'".$lang->get('Find in master database')."'");
			$head->addJavascriptVar('changeQuestionString',"'".$lang->get('You have made changes that will be lost if you change')."'");
			$head->addJavascriptVar('continueString',"'".$lang->get('Continue')."'");
			$head->addJavascriptVar('thumbnailWidth',$conf->get('thumbnail_width',50));
			$head->addJavascriptVar('thumbnailHeight',$conf->get('thumbnail_height',50));
			$head->addStyleSheet('css/login.css');
			$head->addStyleSheet("css/statistik.css");
			$head->addStyleSheet("css/date.css");
			$stylesheets=explode(',',$conf->get('stylesheets'));
			foreach($stylesheets as $sheet) {
				$head->addStyleSheet("css/$sheet");
			}
			if(!is_null($this->preloadScript)) {
				$head->addJavascript($this->preloadScript);
			}
			//$head->addJavascript("common/mootools-core-1.3.1.js");
			//$head->addJavascript("common/mootools-more-1.3.1.1.js");
			$head->addJavascript("common/mootools-1.2.4-core.js");
			$head->addJavascript("common/mootools-1.2.5.1-more.js");
			$head->addJavascript("common/functions.js");
			$head->addJavascript("common/ajaxupload.js");
			$head->addJavascript("common/date.js");
			$head->addJavascript("http://maps.google.com/maps/api/js?sensor=false&language=".$lang->getLanguage());
			$head->title="Statistikdatabas Data Edit";
			$this->head=$head;	
	
			$topmenu=new html_ul();
			$topmenu->addEntity(new html_li(new html_a($lang->get("Statistics"),"http://www.aik.se/fotboll/statistik")));
			$topmenu->addEntity(new html_li('','divider'));
			$topmenu->addEntity(new html_li(new html_a($lang->get("Data Editor"),"http://cache.aik.se/820726/edit/index.php","link")));
			$this->topmenu=$topmenu;
			
			$dir=$_SERVER['SCRIPT_NAME'];
			$dir=substr($dir,0,-strlen(strrchr($dir,'/')));
			$this->rightmenu=new html_ul();
			$this->addMenuEntry('Start_page','index.php');
			if($sess->checkUrl(false,'~Basics')) {
				$basic=$this->addMenuGroup('Basics');
				if($sess->checkUrl(false,$dir.'/sports.php'))
					$this->addMenuEntry('Sports','sports.php',$basic);
				if($sess->checkUrl(false,$dir.'/genders.php'))
					$this->addMenuEntry('Genders','genders.php',$basic);
				if($sess->checkUrl(false,$dir.'/sections.php'))
					$this->addMenuEntry('Sections','sections.php',$basic);
				if($sess->checkUrl(false,$dir.'/ageGroups.php'))
					$this->addMenuEntry('Age_groups','ageGroups.php',$basic);
				if($sess->checkUrl(false,$dir.'/cohorts.php'))
					$this->addMenuEntry('Cohorts','cohorts.php',$basic);
			}
			if($sess->checkUrl(false,'~Geography')) {
				$geo=$this->addMenuGroup('Geography');
				if($sess->checkUrl(false,$dir.'/cities.php'))
					$this->addMenuEntry('Cities','cities.php',$geo);
				if($sess->checkUrl(false,$dir.'/states.php'))
					$this->addMenuEntry('States','states.php',$geo);
				if($sess->checkUrl(false,$dir.'/countries.php'))
					$this->addMenuEntry('Countries','countries.php',$geo);
				if($sess->checkUrl(false,$dir.'/continents.php'))
					$this->addMenuEntry('Continents','continents.php',$geo);
			}
			if($sess->checkUrl(false,'~Persons')) {
				$person=$this->addMenuGroup('Persons');
				if($sess->checkUrl(false,$dir.'/persons.php'))
					$this->addMenuEntry('Persons','persons.php',$person);
				if($sess->checkUrl(false,$dir.'/roles.php'))
					$this->addMenuEntry('Roles','roles.php',$person);
			}			
			if($sess->checkUrl(false,'~Weather')) {
				$weather=$this->addMenuGroup('Weather_and_directions');
				if($sess->checkUrl(false,$dir.'/precipitationTypes.php'))
					$this->addMenuEntry('Precipitation_types','precipitationTypes.php',$weather);
				if($sess->checkUrl(false,$dir.'/geoDirections.php'))
					$this->addMenuEntry('Geographical_directions','geoDirections.php',$weather);
			}
			if($sess->checkUrl(false,'~Match')) {
				$match=$this->addMenuGroup('Match');
				if($sess->checkUrl(false,$dir.'/matches.php'))
					$this->addMenuEntry('Matches','matches.php',$match);
				if($sess->checkUrl(false,$dir.'/matchTypes.php'))
					$this->addMenuEntry('Match_types','matchTypes.php',$match);
				if($sess->checkUrl(false,$dir.'/periodTypes.php'))
					$this->addMenuEntry('Period_types','periodTypes.php',$match);
				if($sess->checkUrl(false,$dir.'/cardTypes.php'))
					$this->addMenuEntry('Card_types','cardTypes.php',$match);
			}
			if($sess->checkUrl(false,$dir.'/teams.php'))
				$this->addMenuEntry('Teams','teams.php');
			if($sess->checkUrl(false,$dir.'/organizations.php'))
				$this->addMenuEntry('Organizations','organizations.php');
			if($sess->checkUrl(false,$dir.'/organizationTypes.php'))
				$this->addMenuEntry('Organization_types','organizationTypes.php');
			if($sess->checkUrl(false,$dir.'/arenas.php'))
				$this->addMenuEntry('Arenas','arenas.php');
			if($sess->checkUrl(false,$dir.'/images.php'))
				$this->addMenuEntry('Images','images.php');
			$this->addMenuEntry('&nbsp;','');

			$this->addMenuEntry('Swedish',$_SERVER['SCRIPT_NAME'].'?lang=sv');
			$this->addMenuEntry('English',$_SERVER['SCRIPT_NAME'].'?lang=en');
			if($sess->checkUrl(false,$dir.'/lang.php'))
				$this->addMenuEntry('Edit languages','lang.php');

			if($sess->checkUrl(false,$dir.'/users.php')) {
				$this->addMenuEntry('&nbsp;','');
				$this->addMenuEntry('Handle users','users.php');
			}
				
			$this->addMenuEntry('&nbsp;','');

			$this->addMenuEntry('Log_out','index.php?logout=1');

		}
		
		protected function addMenuGroup($label) {
			$group=new html_expandableDiv($this->lang->get($label),$this->lang->get($label));
			$group->id='menu'.$label;
			$group->cssClass='expandableMenu';
			$glist=new html_ul();
			$group->addEntity($glist);
			$this->rightmenu->addEntity(new html_li($group));
			return $glist;
		}
		
		protected function addMenuEntry($label,$url,$group=NULL) {
			if($url!='')
				if(is_null($group))
					$this->rightmenu->addEntity(new html_li(new html_a($this->lang->get($label),$url,'link')));	
				else
					$group->addEntity(new html_li(new html_a($this->lang->get($label),$url,'link')));
			else
				$this->rightmenu->addEntity(new html_li($this->lang->get($label)));
		}
		
		function printHTML() {
			$sess=new data_session();
			if(!$sess->checkLogin()) {
				print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
				print "<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"se\">\n";
				
				$this->head=new html_head();
				$this->head->addStyleSheet('css/login.css');
				$this->head->printHTML();
				
				$sess->showLogin(false);
				
				$this->footer->printHTML();
				
				die();
			}
			parent::printHTML();
		}
	}
?>