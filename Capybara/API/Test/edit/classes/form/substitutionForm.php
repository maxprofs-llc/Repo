<?php
	class form_substitutionForm extends form_inlineForm {
		
		public $sub;
		public $subno;
		
		function __construct($standardPrefix,$assetFolder,$sub,$subno) {
			parent::__construct($standardPrefix,$assetFolder,'html_table');
			$this->sub=$sub;
			$this->subno=$subno;
			$this->fixSearchBoxes=true;
		}
		
		function printHTML() {
			$cells=$this->getCells();
			
			$this->content->cssClass='sub';
			$this->content->addEntity(new html_td(''));
			foreach($cells as $cell) 
				$this->content->addEntity(new html_td($cell));
			parent::printHTML();			
		}
		
		function getCells() {
			$this->cells=array();
			
			$conf=config_conf::getSingleton();
			$dr=data_dataStore::getProperty('dataReader');
			$sub=$this->sub;
			$s=$this->subno;
			$lang=lang_lang::getSingleton();
			$prefix=$this->standardPrefix;
			
			$tr=new html_tr('sub');
			
			$id=new html_empty();
			$id->addEntity(new html_hidden($sub->id,$this->standardPrefix.'SubId'.$s,'id'));
			$id->addEntity(new html_hidden($sub->matchEventId,$this->standardPrefix.'SubMatchEventId'.$s,'matchEventId'));
			$id->addEntity(new html_hidden($sub->getPlayerOut()->id,$this->standardPrefix.'SubPlayerOutId'.$s,'playerOutId'));
			$id->addEntity(new html_hidden($sub->getPlayerIn()->id,$this->standardPrefix.'SubPlayerInId'.$s,'playerInId'));
			
			$out=new html_autoUpdateDropDown('.'.lcfirst($prefix).'Player','subout');
			$out->id=$prefix.'SubOut'.$s;
			$out->addOption('',person_person::getUnknown()->getName());
			
			$in=new html_autoUpdateDropDown('.'.lcfirst($prefix).'Player','subin');
			$in->id=$prefix.'SubIn'.$s;
			$in->addOption('',person_person::getUnknown()->getName());
			$in->addOption('0',person_person::getNone()->getName());

			foreach($sub->getCompetitor()->getSquad() as $player) {
				$opt=$out->addOption($player->personId,$player->getName(),true);
				if($sub->getPlayerOut()->personId==$player->personId) 
					$opt->selected=true;
				$opt=$in->addOption($player->personId,$player->getName(),true);
				if($sub->getPlayerIn()->personId==$player->personId)
					$opt->selected=true;
			}				
			
			$time=new html_text($sub->time,'time');
			$time->id=$this->standardPrefix.'SubTime'.$s;	
			
			$this->cells[]=$id;
			$this->cells[]=$out;
			$this->cells[]=$in;
			$this->cells[]=$time;
			$this->cells[]=new html_a($lang->get('Delete'),"javascript:delete".ucfirst($this->standardPrefix)."Sub($s)",'delete');
			
			return $this->cells;			
		}
	}