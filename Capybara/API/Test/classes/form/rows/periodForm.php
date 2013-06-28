<?php
	class form_rows_periodForm extends form_inlineForm {
		
		public $period;
		public $periodno; 
		
		function __construct($standardPrefix,$assetFolder,$period,$periodno) {
			parent::__construct($standardPrefix,$assetFolder,'html_empty');
			$this->period=$period;
			$this->periodno=$periodno;
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
			$type->cssClass=$this->standardPrefix.'PeriodType';
			$type->id=$this->standardPrefix.'PeriodType'.$periodno;
			$type->list=$dr->getGenericList('periodType','pt','match_periodType');
			//$scorer->list=$periods;
			$type->chosenValue=$period->getPeriodType()->getName();
			$type->chosenId=$period->getPeriodType()->id;
			$type->addText='+';
			$type->addFunction='addPeriodType(this.getParent());';
		
			$normal=new html_time($period->length,'length');
			$normal->id=$this->standardPrefix.'PeriodTime'.$periodno;
				
			//$extra=new html_text('','extraTime');
			//$extra->id='matchPeriodExtraTime'.$periodno;
			
			$kickoff=new html_autoUpdateDropDown('.'.$this->standardPrefix.'Team','kickoff');
			$kickoff->id=$this->standardPrefix.'PeriodKickOff'.$periodno;
			$kickoff->addOption('',$lang->get('Unknown_team'));
			
			$direction=new html_searchBox();
			$direction->cssClass=$this->standardPrefix.'PeriodDirection';
			$direction->id=$this->standardPrefix.'PeriodDirection'.$periodno;
			$direction->list=$dr->getGeoDirectionList(true);
			//$scorer->list=$periods;
			$direction->chosenValue='';
			$direction->chosenId='';
			$direction->addText='+';
			$direction->addFunction='addGeoDirection(this.getParent());';

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