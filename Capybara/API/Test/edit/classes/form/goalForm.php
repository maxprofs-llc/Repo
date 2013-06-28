<?php
	class form_goalForm extends form_inlineForm {
		
		public $goal;
		public $goalno;
		
		function __construct($standardPrefix,$assetFolder,$goal,$goalno) {
			parent::__construct($standardPrefix,$assetFolder,'html_table');
			$this->goal=$goal;
			$this->goalno=$goalno;
			$this->fixSearchBoxes=true;
		}
		
		function printHTML() {
			
			$cells=$this->getCells();
				
			$this->content->cssClass='goal';
			$this->content->addEntity(new html_td(''));
			foreach($cells as $cell) 
				$this->content->addEntity(new html_td($cell));
			
			/*
			$this->content->addEntity(new html_td($cells[1]));
			$this->content->addEntity(new html_td($cells[2]));
			$this->content->addEntity(new html_td($cells[3]));
			$this->content->addEntity(new html_td($cells[4]));
			$this->content->addEntity(new html_td($cells[5]));
			$this->content->addEntity(new html_td($cells[6]));
			*/
			parent::printHTML();			
		}
		
		function getCells() {
			$this->cells=array();
			
			$conf=config_conf::getSingleton();
			$dr=data_dataStore::getProperty('dataReader');
			$goal=$this->goal;
			$g=$this->goalno;
			$lang=lang_lang::getSingleton();
			$prefix=$this->standardPrefix;
			
			$tr=new html_tr('goal');
			$label=new html_td($lang->get('Goal').' '.$g);
			$tr->addEntity($label);
				
			$table=new html_table();
			$table->id=$prefix.'Goal'.$g;

			$id=new html_empty();
			$id->addEntity(new html_hidden($goal->id,$this->standardPrefix.'GoalId'.$g,'id'));
			$id->addEntity(new html_hidden($goal->matchEventId,$this->standardPrefix.'GoalMatchEventId'.$g,'matchEventId'));
			
			$scorer=new html_autoUpdateDropDown('.match'.ucfirst($prefix).'Player','scorer');
			$scorer->id=$prefix.'GoalScorer'.$g;
			$scorer->addOption('',person_person::getUnknown()->getName());
			$scorer->cssClass='.match'.ucfirst($prefix).'Player';
			
			$assist=new html_autoUpdateDropDown('.match'.ucfirst($prefix).'Player','assist');
			$assist->id=$prefix.'GoalAssist'.$g;
			$assist->addOption('',person_person::getUnknown()->getName());
			$assist->addOption('0',person_person::getNone()->getName());

			$assists=$goal->getAssists();
			foreach($goal->getCompetitor()->getSquad() as $player) {
				$opt=$scorer->addOption($player->personId,$player->getName(),true);
				if($goal->personId==$player->personId) 
					$opt->selected=true;
				$opt=$assist->addOption($player->personId,$player->getName(),true);
				if(count($assists)!=0 && $assists[0]->getPerson()->id==$player->personId) 
					$opt->selected=true;
			}			
			$result=new html_div('','goalResult');
			$homeScore=new html_text($goal->homeScore,'homeScore score');
			$awayScore=new html_text($goal->awayScore,'awayScore score');
			$result->addEntity($homeScore);
			$result->addEntity(new html_span('-'));
			$result->addEntity($awayScore);
			
			/*
			$period=new html_searchBox();
			$period->cssClass='period';
			$period->id=$prefix.'GoalPeriod'.$g;
			$period->listURL="periods/periodJSON.php";
			$period->chosenValue='';
			$period->chosenId='';
			$period->addText='+';
			$period->addFunction='addPeriod(this.getParent());';
			$period->findFunction='addPeriod(this.getParent());';
			*/
			
			$time=new html_text('','time');
			$time->id=$prefix.'GoalTime'.$g;
					
			$speed=new html_text('','speed');
			$speed->id=$prefix.'GoalSpeed'.$g;
			
			$type=new html_text('','goalType');
			$type->id=$prefix.'GoalType'.$g;
			
			$comment=new html_multiText();
			$comment->id=$prefix.'GoalComment'.$g;
			$comment->cssClass='goalComment';
			$comment->defaultLabel=$lang->getLanguage();
			foreach($conf->get('languages') as $code => $langId) {
				$comment->addTextInput($code,'');
			}	

			$table->addEntity(new html_tr('',array($lang->get('Goal_scorer').':',$scorer)));
			$table->addEntity(new html_tr('',array($lang->get('Goal_assist').':',$assist)));
			$table->addEntity(new html_tr('',array($lang->get('Result').':',$result)));
			$table->addEntity(new html_tr('',array($lang->get('Goal_type').':',$type)));
			//$table->addEntity(new html_tr('',array($lang->get('Period').':',$period)));
			$table->addEntity(new html_tr('',array($lang->get('Game_time').':',$time)));
			$table->addEntity(new html_tr('',array($lang->get('Speed').':',$speed)));
			$table->addEntity(new html_tr('',array($lang->get('Public comments').':',$comment)));			
			
			//$this->cells[]='';
			$this->cells[]=$id;
			$this->cells[]=$table;
			//$this->cells[]=$assist;
			//$this->cells[]=new html_a($lang->get('Delete'),"javascript:delete".ucfirst($this->standardPrefix)."Referee($goalno)",'delete');
			
			return $this->cells;			
		}
	}