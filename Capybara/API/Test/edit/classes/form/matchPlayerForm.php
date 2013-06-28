<?php
	class form_matchPlayerForm extends form_inlineForm {
		
		public $player;
		public $playerno;
		
		function __construct($standardPrefix,$assetFolder,$player,$playerno) {
			parent::__construct($standardPrefix,$assetFolder,'html_empty');
			$this->player=$player;
			$this->playerno=$playerno;
			$this->fixSearchBoxes=true;
		}
		
		function printHTML() {
			
			$cells=$this->getCells();
				
			$this->content->cssClass='player';
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
			$conf=config_conf::getSingleton();
			$lang=lang_lang::getSingleton();
			
			$allRoles=$dr->getRoleList();
			$roles=new baseClassList();
			$roles->Append($dr->getRoleById(NULL));
			foreach($allRoles as $role) {
				if($role->isChildOf($dr->getRoleById($conf->get('player_role_id',1))) || $role->id==$conf->get('player_role_id',1))
					$roles->Append($role);
			}
			
			$player=$this->player;
			$playerno=$this->playerno;
			
			$playerrole=$player->getRole();
			
			/*
			$form=new form_inlineForm(ucfirst($side).'Player','player','html_empty');
			$form->fixSearchBoxes=true;
			*/
			
			$id=new html_hidden($player->id,$this->standardPrefix.'PlayerId','id');
			
			$no=new html_text($player->shirtNumber,'shirtnumber');
			$no->id=$this->standardPrefix.'ShirtNumber'.$playerno;
			
			$role=new html_searchBox();
			$role->cssClass='role';
			$role->id=$this->standardPrefix.'PlayerRole'.$playerno;
			$role->list=$roles;
			//$scorer->list=$players;
			$role->chosenValue=$playerrole;
			$role->chosenId=$playerrole->id;
			$role->addText='+';
			$role->addFunction='addRole(this.getParent());';
			$role->findFunction='addRole($("'.$role->id.'"),-99);';
			
			$plyr=new html_searchBox();
			$plyr->cssClass=$this->standardPrefix.'Player person';
			$plyr->id=$this->standardPrefix.'Player'.$playerno;
			$plyr->listURL='players/playerJSON.php';
			//$assist->list=$players;
			$plyr->chosenValue=$player->getName();
			$plyr->chosenId=$player->getPerson()->id;
			$plyr->addText='+';
			$plyr->addFunction='addPerson(this.getParent());';	
			$plyr->findFunction='addPerson($("'.$plyr->id.'"),-99);';
			$plyr->addAutoUpdate($this->standardPrefix.'Team','teamid');
			$plyr->addAutoUpdate('matchDate','date');
											
			$entire=new html_checkbox();
			$entire->checked=($player->matchFull == 1);
			$entire->id=$this->standardPrefix.'PlayerEntire'.$playerno;
			$entire->cssClass='entire';
			
			$distance=new html_text($player->distance,'distance');
			$distance->id=$this->standardPrefix.'PlayerDistance'.$playerno;
			
			$speed=new html_text($player->speed,'speed');
			$speed->id=$this->standardPrefix.'PlayerSpeed'.$playerno;	

			$this->cells[]=$id;
			$this->cells[]=$no;
			$this->cells[]=$plyr;
			$this->cells[]=$role;
			$this->cells[]=$entire;
			$this->cells[]=$distance;
			$this->cells[]=$speed;
			$this->cells[]=new html_a($lang->get('Delete'),"javascript:delete".ucfirst($this->standardPrefix)."Player($playerno)",'delete');
			
			return $this->cells;			
			
		}
	}