<?php
	class form_refereeForm extends form_inlineForm {
		
		public $referee;
		public $refereeno; 
		
		function __construct($standardPrefix,$assetFolder,$referee,$refereeno) {
			parent::__construct($standardPrefix,$assetFolder,'html_empty');
			$this->referee=$referee;
			$this->refereeno=$refereeno;
			$this->fixSearchBoxes=true;
		}
		
		function printHTML() {
			
			$cells=$this->getCells();
				
			$this->content->cssClass='referee';
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
			$referee=$this->referee;
			$refereeno=$this->refereeno;
			$lang=lang_lang::getSingleton();
			
			$id=new html_hidden($referee->id,$this->standardPrefix.'RefereeId'.$refereeno,'id');
			
			$refrole=$dr->getRoleById($referee->roleId);

			$role=new html_searchBox();
			$role->cssClass='refereeRole';
			$role->id='refereeRole'.$refereeno;
			$role->listURL='referees/refereeRoleJSON.php';
			//$scorer->list=$players;
			$role->chosenValue=$refrole;
			$role->chosenId=$refrole->id;
			$role->addText='+';
			$role->addFunction='addRole(this.getParent());';
			$role->findFunction='addRole(this.getParent(),-99);';
			
			$ref=new html_searchBox();
			$ref->cssClass='refereePerson';
			$ref->id=$this->standardPrefix.ucfirst('referee').$refereeno;
			$ref->listURL='referees/refereeJSON.php';
			//$assist->list=$players;
			$ref->chosenValue=$referee->getName();
			$ref->chosenId=$referee->getPersonId();
			$ref->addText='+';
			$ref->addFunction='addPerson(this.getParent());';	
			$ref->findFunction='addPerson(this.getParent(),-99);';	
			$ref->addAutoUpdate('matchDate','date');
			
			//$this->cells[]='';
			$this->cells[]=$id;
			$this->cells[]=$role;
			$this->cells[]=$ref;
			$this->cells[]=new html_a($lang->get('Delete'),"javascript:delete".ucfirst($this->standardPrefix)."Referee($refereeno)",'delete');
			
			return $this->cells;			
		}
	}