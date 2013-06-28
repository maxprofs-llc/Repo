<?php
	class form_periodForm extends form_inlineForm {
		
		public $period;
		public $periodno; 
		private $teams;
		public $selectedTeamId;
		public $selectedDirection;
		
		function __construct($standardPrefix,$assetFolder,$period,$periodno,$teams=false,$selectedTeamId=NULL,$selectedDirection=NULL) {
			parent::__construct($standardPrefix,$assetFolder,'html_empty');
			$this->period=$period;
			$this->periodno=$periodno;
			$this->teams=$teams;
			$this->selectedTeamId=$selectedTeamId;
			$this->selectedDirection=$selectedDirection;
			$this->fixSearchBoxes=true;
		}
		
		function printHTML() {
			
			$cells=$this->getCells();
				
			$this->content->cssClass='period';
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
			
			$dr=data_dataStore::getProperty('dataReader');
			$period=$this->period;
			$periodno=$this->periodno;
			$lang=lang_lang::getSingleton();
			
			$id=new html_hidden($period->id,$this->standardPrefix.'PeriodId'.$periodno,'id');
			
			$type=new html_searchBox();
			$type->cssClass=$this->standardPrefix.'PeriodType periodType';
			$type->id=$this->standardPrefix.'PeriodType'.$periodno;
			$type->list=$dr->getGenericList('periodType','pt','match_periodType');
			$type->listURL='periodTypes/periodTypeJSON.php';
			//$scorer->list=$periods;
			$type->chosenValue=$period->getPeriodType()->getName();
			$type->chosenId=$period->getPeriodType()->id;
			$type->addText='+';
			$type->addFunction='addPeriodType(this.getParent());';
			$type->findFunction='addPeriodType($("'.$type->id.'"),-99);';
			//$type->addAutoUpdate('.periodType','');
			
			$normal=new html_time($period->length,'length');
			$normal->id=$this->standardPrefix.'PeriodTime'.$periodno;
				
			//$extra=new html_text('','extraTime');
			//$extra->id='matchPeriodExtraTime'.$periodno;
			
			$kickoff=new html_autoUpdateDropDown('.'.$this->standardPrefix.'Team','kickoff');
			$kickoff->id=$this->standardPrefix.'PeriodKickOff'.$periodno;
			$kickoff->addOption('',$lang->get('Unknown_team'));
			if($this->teams)
				foreach($this->teams as $team)
					$kickoff->addOption($team->id,$team->getName(),true);
			$kickoff->setSelected($this->selectedTeamId);
			
			$direction=new html_searchBox();
			$direction->cssClass=$this->standardPrefix.'PeriodDirection direction';
			$direction->id=$this->standardPrefix.'PeriodDirection'.$periodno;
			$direction->list=$dr->getGeoDirectionList(true);
			$direction->listURL="geoDirections/geoDirectionJSON.php";
			//$scorer->list=$periods;
			if(!is_null($this->selectedDirection)) {
				$direction->chosenValue=$this->selectedDirection->getName();
				$direction->chosenId=$this->selectedDirection->id;
			}
			$direction->addText='+';
			$direction->addFunction='addGeoDirection(this.getParent());';
			$direction->findFunction='addGeoDirection($("'.$direction->id.'"),-99);';
			
			//$this->cells[]='';
			$this->cells[]=$id;
			$this->cells[]=$type;
			$this->cells[]=$normal;
			
			$this->cells[]=$kickoff;
			$this->cells[]=$direction;
			$this->cells[]=new html_a($lang->get('Delete'),"javascript:delete".ucfirst($this->standardPrefix)."Period($periodno)",'delete');
			
			return $this->cells;			
		}
	}