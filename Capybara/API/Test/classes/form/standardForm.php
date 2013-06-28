<?php
	
	class form_standardForm extends html_htmlEntity {
		
		public $content;
		public $areas;
		public $standardPrefix;
		public $assetFolder;
		public $headline;
		public $showSave=true;
		public $hideSaveThenNew=false;
		public $saveFunction;
		public $wizards;
		public $dataReader;
		public $table;
		public $icon;
		
		protected $conf;
		protected $lang;
		protected $languages;
		protected $lastArea;
		protected $initMap=false;
		protected $fixExpanders=false;
		private $fixSearchBoxes=false;
		protected $fixAjaxBoxes=false;
		protected $fixDeletes=false;
		protected $fixDateFields=false;
		protected $fixTextEditors=false;
		protected $loadDate=false;
		protected $object;
		protected $hiddenFields;
		
		function __construct($standardPrefix='',$assetFolder,$object=NULL) {
			$this->standardPrefix=$standardPrefix;
			$this->assetFolder=$assetFolder;
			$this->areas=new baseClassList();
			$this->lang=lang_lang::getSingleton();
			$this->conf=config_conf::getSingleton();
			//$this->languages=explode(',',$this->conf->get('available_langs'));
			$languageCodes=explode(',',$this->conf->get('available_langs'));
			$this->languages=array();
			foreach($languageCodes as $langCode) {
				$this->languages[$langCode]=$this->lang->getLanguageIdForCode($langCode);
			}
			$this->content=new html_div();
			$this->wizards=new baseClassList();
			$this->object=$object;
			if(!is_null(data_dataStore::getProperty('dataReader')))
				$this->dataReader=data_dataStore::getProperty('dataReader');
			$this->hiddenFields=array();
		}
		
		public function addTextEditor($text='',$id='',$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;	
			$ckeditor=new html_ckeditor($text);
			$ckeditor->id=$this->standardPrefix.$id;
			$ckeditor->lateBinding=true;
			$ckeditor=new html_textarea($text,10,10);
			$area->table->addEntity(new html_tr('',array($ckeditor)));
			if(!$this->fixTextEditors)
				$this->fixTextEditors=array();
			//$this->fixTextEditors[]=$ckeditor;
		}
		
		public function printHTML() {
			//Update datestamp on server
			$sess=new data_session();
			$sess->checkLogin();
			
			$this->content->id=$this->standardPrefix . 'Form';
			if(!is_null($this->object)) {
				$objDiv=new html_div($this->object->getJSON());
				$objDiv->id='objectJSON';
				$objDiv->hidden=true;
				$this->content->addEntity($objDiv);
			}
			$headline=new html_p();
			$headline->addEntity(new html_span($this->headline,'headline'));
			if(!is_null($this->icon)) {
				$headline->addEntity($this->icon);
				$this->icon->cssClass.=" icon";
			}
			$this->content->addEntity($headline);
				
			foreach($this->areas as $area) {
				$this->content->addEntity($area->getDiv());
			}
						
			if($this->showSave) {
				$buttons=new html_div();
				$buttons->addEntity(new html_button($this->lang->get('Save'),'saveButton',$this->saveFunction.'();'));
				if(!$this->hideSaveThenNew)
					$buttons->addEntity(new html_button($this->lang->get('Save').' + '.$this->lang->get('New'),'saveThenNewButton',$this->saveFunction."();$(mainSelect).value=-1;$(mainSelect).fireEvent('change',{target:$(mainSelect)});"));
				$buttons->cssClass='block';
				$status=new html_span('');
				$status->id=$this->standardPrefix.'SaveStatus';
				$status->cssClass='status';
				$buttons->addEntity($status);
				$this->content->addEntity($buttons);
			}

			if($this->initMap)
				$this->content->addEntity(new html_script('initMap();'));
			if($this->fixExpanders)
				$this->content->addEntity(new html_script("fixExpanders();"));
			if($this->fixDeletes)
				$this->content->addEntity(new html_script("fixDeletes();"));
			if($this->fixDateFields)
				$this->content->addEntity(new html_script("fixDateFields();"));
			if($this->fixSearchBoxes)
				$this->content->addEntity(new html_script("fixSearchBoxes();"));
			if($this->fixAjaxBoxes)
				$this->content->addEntity(new html_script("fixAjaxBoxes();"));
			if($this->fixTextEditors) 
				foreach($this->fixTextEditors as $editor) {
					$this->content->addEntity(new html_div($editor->getScript()));
			}			
			$this->content->addEntity(new html_script("fixTooltips();"));
			$this->content->addEntity(new html_script('var js=new Asset.javascript("'.$this->assetFolder.'/functions.js",{onload:function() {
				'.$this->standardPrefix.'FormLoaded();
			}});'));
			foreach($this->hiddenFields as $id=>$value) {
				$this->content->addEntity(new html_hidden($value,$id));
			}
			$this->content->printHTML();
		}
		
		public function addExpandableArea($id,$label,$headline,$prefix=NULL,$area=NULL) {
			if(is_null($prefix))
				$prefix=$this->standardPrefix;
			$newarea=new form_expandableArea('Hide '.$label,'Show '.$label,$headline);
			$newarea->id=$prefix . $id;
			$this->lastArea=$newarea;
			if(is_null($area))
				$this->areas->Append($newarea);
			else
				$area->areas->Append($newarea);
			$this->fixExpanders=true;
			return $newarea;
		}
		
		public function addLangField($id,$label,$strings,$variable,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;

			$field=new html_multiText();
			$field->id=$this->standardPrefix . $id;
			$field->defaultLabel=$this->lang->getLanguageCode();
			foreach($this->languages as $code => $langId) {
				$field->addTextInput($code,$strings[$langId]->$variable,$langId);
			}
			$this->addField($label,$field,$area);			
		}
		
		public function addTextField($id,$label,$value,$unit='',$area=NULL,$translate=true) {
			if(is_null($area))
				$area=$this->lastArea;
			$cont=new html_empty();
			$field=new html_text($value);
			$field->id=$this->standardPrefix . $id;
			$cont->addEntity($field);
			if($unit!='')
				$cont->addEntity(new html_span($unit));
			$this->addField($label,$cont,$area,$translate);									
		}
		
		function addDropdownField($id,$label,$options,$value,$area=NULL,$translate=true) {
			if(is_null($area))
				$area=$this->lastArea;
			$dropdown=new html_dropDown();
			$dropdown->id=$this->standardPrefix . $id;
			foreach($options as $optvalue=>$text) {		
				$opt=$dropdown->addOption($optvalue,$text);
				if($optvalue==$value)
					$opt->selected=true;
			}
			$this->addField($label,$dropdown,$area,$translate);
		}
		
		public function addLink($text,$url) {
			if(is_null($area))
				$area=$this->lastArea;
			$link=new html_a($text,$url);
			if($unit!='')
				$cont->addEntity(new html_span($unit));
			$area->table->addEntity(new html_tr('',array(new html_td($link,2,'label'))));		
		}
		
		public function addLongTextField($id,$label,$value,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;

			$field=new html_td(new html_textarea($value));
			$field->id=$this->standardPrefix . $id;
			$this->addField($label,$field,$area);						
		}

		public function addCheckboxField($id,$label,$value,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			$field=new html_checkbox();
			$field->checked=$value;
			$field->id=$this->standardPrefix . $id;
			$this->addField($label,$field,$area);									
		}
				
		public function addDateField($id,$label,$value,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			$field=new html_text($value,'dateField');
			$field->id=$this->standardPrefix . $id;
			$this->addField($label,$field,$area);
			$this->fixDateFields=true;									
		}
		
		function addTeamRolesGrid($roles,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			$lang=$this->lang;
			$grid=new html_dataGrid();
			$grid->id=$this->standardPrefix . 'TeamRoles';
			$area->table->addEntity($grid);
			$grid->addColumns(array('',$lang->get('Start_date'),$lang->get('End_date'),$lang->get('Team'),$lang->get('Nr'),$lang->get('Role'),$lang->get('Primary'),''));
			$r=0;
			foreach($roles as $role) {
				$r++;

				$id=new html_hidden($role->id,$this->standardPrefix.'TeamRoleId'.$r);
				
				$startDate=new html_text($role->startDate,'dateField');
				$startDate->id=$this->standardPrefix . 'TeamRoleStartDate'.$r;

				$endDate=new html_text($role->endDate,'dateField');
				$endDate->id=$this->standardPrefix . 'TeamRoleEndDate'.$r;

				$team=new html_searchBox();
				$team->id=$this->standardPrefix . 'RoleTeam'.$r;
				$team->listURL='teams/teamJSON.php';
				$team->chosenId=$role->getTeam()->id;
				$team->chosenValue=$role->getTeam()->getName();
				$team->addText='+';
				$team->addFunction='addTeam(this.getParent())';
				
				$nr=new html_text($role->defaultShirtNumber,'shirtNumber');
				$nr->id=$this->standardPrefix.'RoleShirtNumber'.$r;
					
				$rolesb=new html_searchBox();
				$rolesb->id=$this->standardPrefix . 'TeamRole'.$r;
				$rolesb->listURL='roles/roleJSON.php';
				if(!is_null($this->dataReader))
					$rolesb->list=$this->dataReader->getRoleList(true);
				$rolesb->chosenId=$role->roleId;
				$rolesb->chosenValue=$role->getName();
				$rolesb->addText='+';
				$rolesb->addFunction='addRole(this.getParent())';
				
				$note=new html_editNote($role->privateComment,'&nbsp;');
				$note->id=$this->standardPrefix . 'TeamRoleNote'.$r;

				$primary=new html_checkbox();
				$primary->checked=$role->isPrimary;
				$primary->id=$this->standardPrefix.'TeamPrimaryRole'.$r;
				
				$row=$grid->addRow(array($id,$startDate,$endDate,$team,$nr,$rolesb,$primary,$note),'role');
			}
			$grid->addRow(array('',new html_button($lang->get('Add role'),'',"add".ucfirst($this->standardPrefix)."Role('Team');")));
			$this->fixDateFields=true;
			$this->fixSearchBoxes=true;									
		}

			
		function addOrganizationRolesGrid($roles,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			$lang=$this->lang;
			$grid=new html_dataGrid();
			$grid->id=$this->standardPrefix . 'OrganizationRoles';
			$area->table->addEntity($grid);
			$grid->addColumns(array('',$lang->get('Start_date'),$lang->get('End_date'),$lang->get('Organization'),$lang->get('Role'),$lang->get('Primary'),''));
			$r=0;
			foreach($roles as $role) {
				if(!is_null($role->organizationId) && $role->organizationId!=0) {
					$r++;
					
					$id=new html_hidden($role->id,$this->standardPrefix.'OrganizationRoleId'.$r);
					
					$startDate=new html_text($role->startDate,'dateField');
					$startDate->id=$this->standardPrefix . 'OrganizationRoleStartDate'.$r;
	
					$endDate=new html_text($role->endDate,'dateField');
					$endDate->id=$this->standardPrefix . 'OrganizationRoleEndDate'.$r;
	
					$team=new html_searchBox();
					$team->id=$this->standardPrefix . 'RoleOrganization'.$r;
					$team->listURL='organizations/organizationJSON.php';
					$team->chosenId=$role->getOrganization()->id;
					$team->chosenValue=$role->getOrganization()->getName();
					$team->addText='+';
					$team->addFunction='addTeam(this.getParent())';
	
					$rolesb=new html_searchBox();
					$rolesb->id=$this->standardPrefix . 'OrganizationRole'.$r;
					$rolesb->listURL='roles/roleJSON.php';
					if(!is_null($this->dataReader))
						$rolesb->list=$this->dataReader->getRoleList(true);
					$rolesb->chosenId=$role->roleId;
					$rolesb->chosenValue=$role->getName();
					$rolesb->addText='+';
					$rolesb->addFunction='addRole(this.getParent())';
					
					$primary=new html_checkbox();
					$primary->checked=$role->isPrimary;
					$primary->id=$this->standardPrefix.'OrganizationPrimaryRole'.$r;

					$note=new html_editNote($role->publicComment,'&nbsp;');
					$note->id=$this->standardPrefix . 'TeamRoleNote'.$r;
					
					$row=$grid->addRow(array($id,$startDate,$endDate,$team,$rolesb,$primary,$note),'role');
				}
			}
			$grid->addRow(array('',new html_button($lang->get('Add role'),'',"add".ucfirst($this->standardPrefix)."Role('Organization');")));
			$this->fixDateFields=true;
			$this->fixSearchBoxes=true;									
		}

		function addUpdatableDropDownField($id,$label,$value,$updateClass,$startValues=false,$replacableStartValues=false,$area=NULL,$translate=true) {
			if(is_null($area))
				$area=$this->lastArea;
			$cont=new html_empty();
			$field=new html_autoUpdateDropDown($updateClass);
			$field->id=$this->standardPrefix . $id;
			if($startValues) 
				foreach($startValues as $svalue=>$text)
					$field->addOption($svalue,$text);
			if($replacableStartValues) 
				foreach($replacableStartValues as $svalue=>$text)
					$field->addOption($svalue,$text,true);
			
			$field->setSelected($value);
			$cont->addEntity($field);
			if($unit!='')
				$cont->addEntity(new html_span($unit));
			$this->addField($label,$cont,$area,$translate);									
		}
		
		function addPeriodGrid($periods,$teams=false,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			$lang=$this->lang;
			$grid=new html_dataGrid();
			$grid->id=$this->standardPrefix . 'Periods';
			$area->table->addEntity($grid);
			$grid->addColumn("");
			$grid->addColumn($lang->get('Period_type'));
			$grid->addColumn($lang->get('Length'));
			$grid->addColumn($lang->get('Kick_off'));
			$grid->addColumn($lang->get('Direction'));
			$r=1;
			foreach($periods as $period) {
				$form=new form_periodForm('match','periods',$period,$r,$teams,$period->startingTeamId,$period->getStartingGeoDirection());
				$grid->addRow($form->getCells(),'period');
				$r++;
			}
			$grid->addRow(array('',new html_button($lang->get('Add period'),'',"add".ucfirst($this->standardPrefix)."Period();")));
			$grid->addRow(array('',new html_button($lang->get('Add standard_periods'),'',"add".ucfirst($this->standardPrefix)."StandardPeriods();")));
			$this->fixSearchBoxes=true;									
		}

		function addRefereeGrid($referees,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			$lang=$this->lang;
			$grid=new html_dataGrid();
			$grid->id=$this->standardPrefix . 'RefereeGrid';
			$area->table->addEntity($grid);
			$grid->addColumn("");
			$grid->addColumn($lang->get('Referee_role'));
			$grid->addColumn($lang->get('Referee'));
			$r=1;
			foreach($referees as $referee) {
				$form=new form_refereeForm('match','referees',$referee,$r);
				$grid->addRow($form->getCells(),'referee');
				$r++;
			}
			$grid->addRow(array('',new html_button($lang->get('Add referee'),'',"add".ucfirst($this->standardPrefix)."Referee();")));
			$this->fixSearchBoxes=true;									
		}		
		
		function addGoalGrid($prefix,$goals,$area=NULL) {
			$lang=$this->lang;
			if(is_null($area))
				$area=$this->lastArea;
			$g=1;
			foreach($goals as $goal) {
				$form=new form_goalForm($prefix,'goals',$goal,$g);
				$area->table->addEntity(new html_tr('goal',array($lang->get('Goal')." ".$g,new html_td($form))));
				$g++;
			}
		}
		
		function addSquadGrid($prefix,$squad,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			$lang=$this->lang;
			$grid=new html_dataGrid();
			$grid->id=$this->standardPrefix . $prefix . "SquadGrid";
			$area->table->addEntity($grid);
			$entire=new html_span($lang->get('Entire game'));
			$entire->addEntity(new html_tooltip('Uncheck if player did not play the entire game and add details under Substitutions.<br/>If unknown, uncheck without adding details.'));
			$grid->addColumns(array('','#',$lang->get('Player'),$lang->get('Role'),$entire,$lang->get('Distance'),$lang->get('Speed')));
			$r=0;
			foreach($squad as $player) {
				$form=new form_matchPlayerForm($this->standardPrefix . $prefix,'player',$player,$r);
				$grid->addRow($form->getCells(),'player');
				$r++;
			}
			$grid->addRow(array('',new html_button($lang->get('Add player'),'',"add".ucfirst($this->standardPrefix).$prefix."Player();")));
			$grid->addRow(array('',new html_button($lang->get('Create all roles'),'',"addAll".ucfirst($this->standardPrefix).$prefix."Roles();")));
			$allroles=$this->dataReader->getRoleById($this->conf->get('player_role_id',1))->getAllChildren();
			$roles=new baseClassList();
			$roles->Append($this->dataReader->getRoleById($this->conf->get('player_role_id',1)));
			$roles->merge($allroles);
			//$grid->addRow(array('',new html_button($lang->get('Add player with role:'),'',"add".ucfirst($this->standardPrefix).$prefix."PlayerWithRole();"),new html_dropDown('',$roles)));
			$this->fixSearchBoxes=true;									
		}		
				
		public function addSearchField($id,$label,$valueId,$valueText,$listUrl,$function,$list=NULL,$prefix=NULL,$class='',$showAdd=true,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			if(is_null($prefix))
				$prefix=$this->standardPrefix;
				
			$field=new html_searchBox();
			$field->cssClass=$class;
			$field->id=$prefix . $id;
			$field->list=$list;
			$field->chosenId=$valueId;
			$field->chosenValue=$valueText;
			$field->listURL=$listUrl;
			$field->addText='+';
			$field->addFunction=$function.'(this.getParent());';
			$field->findFunction=$function.'($("'.$prefix.$id.'"),-99);';
			$field->showAddButton=true;
			$this->addField($label,$field,$area);	
			$this->fixSearchBoxes=true;	
			return $field;				
		}
		
		function addAjaxField($id,$label,$valueId,$valueText,$listUrl,$function,$prefix=NULL,$class='',$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			if(is_null($prefix))
				$prefix=$this->standardPrefix;
				
			$field=new html_ajaxBox();
			$field->cssClass=$class;
			$field->id=$prefix . $id;
			$field->chosenId=$valueId;
			$field->chosenValue=$valueText;
			$field->listURL=$listUrl;
			$field->addText='+';
			$field->addFunction=$function.'(this.getParent());';
			$this->addField($label,$field,$area);	
			$this->fixAjaxBoxes=true;					
		}
		
		protected function addField($label,$field,$area,$translate=true) {
			if(is_null($area)) {
				$area=$this;
				if(is_null($this->table)) {
					$this->table=new html_table();
					$this->content->addEntity($this->table);
				}
			}
			if($translate)
				$label=$this->lang->get($label);
			$area->table->addEntity(new html_tr('',array(new html_td($label.':',1,'label'),$field)));		
		}
		
		//Special elements
		
		public function addHeadline($text,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
	
			$area->table->addEntity(new html_tr('',array(new html_p($this->lang->get($text),'smallheadline'))));
		}		
		
		public function addHiddenField($id,$value) {
			$this->hiddenFields[$this->standardPrefix . $id]=$value;
		}
		
		public function addList($id,$buttons=NULL,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			
			$list=new html_list();
			$list->id=$this->standardPrefix.$id;
			$area->table->addEntity(new html_tr('',array($list,$buttons)));
			return $list;
		}
		
		public function addMoveList($id,$list,$listFunction,$listVar,$inListValue,$unknownHeadline,$moveFunction,$moveToUnknownFunction,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;

			$unknownList=new html_list('citylist');
			$unknownList->id='unknown'.$id;		
			
			foreach($list as $item) {
				if(is_null($item->$listFunction()->$listVar))
					$unknownList->addOption($item->id,$item->getName());
			}
			$buttons=new html_table('moveButtons');
			$moveButton=new html_button($this->lang->get('Move to') . ' ' . $this->headline);
			$moveButton->id='move'.$id;
			$moveButton->onclick=$moveFunction.'()';	
			$buttons->addEntity(new html_tr('',array(new html_td($moveButton))));
			$area->table->addEntity(new html_tr('',array(new html_p($this->lang->get($unknownHeadline),'smallheadline'))));
			$area->table->addEntity(new html_tr('',array($unknownList,$buttons)));
			
			$myList=new html_list('citylist');
			$myList->id='my'.$id;
			foreach($list as $item) {
				if($item->$listFunction()->$listVar==$inListValue)
					$myList->addOption($item->id,$item->getName());
			}
			$buttons=new html_table('moveButtons');
			$buttons->addEntity(new html_tr('',array(new html_td(new html_button($this->lang->get('Merge'))))));
			$moveButton=new html_button($this->lang->get('Move to').' '.$this->lang->get('unknown'));
			$moveButton->id='move'.$id.'ToUnknown';
			$moveButton->onclick=$moveToUnknownFunction.'()';	
			$buttons->addEntity(new html_tr('',array(new html_td($moveButton,1,'moveButtons'))));
			$area->table->addEntity(new html_tr('',array(new html_p($this->lang->get($id.' in').' '.$this->headline,'smallheadline'))));
			$area->table->addEntity(new html_tr('',array($myList,$buttons)));		
		}
		
		function addDimensionsGrid($dimensions,$excludeDimension=NULL,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			$lang=$this->lang;
			$grid=new html_dataGrid();
			$grid->id=$this->standardPrefix . 'Dimensions';
			$area->table->addEntity($grid);
			$grid->addColumns(array('',$lang->get('Date')));
			if(!in_array('weight',$excludeDimension))
				$grid->addColumn($lang->get('Weight'));
			if(!in_array('height',$excludeDimension))
				$grid->addColumn($lang->get('Height'));
			if(!in_array('depth',$excludeDimension))
				$grid->addColumn($lang->get('Depth'));
			if(!in_array('length',$excludeDimension))
				$grid->addColumn($lang->get('Length'));
			if(!in_array('width',$excludeDimension))
				$grid->addColumn($lang->get('Width'));
			if(!in_array('area',$excludeDimension))
				$grid->addColumn($lang->get('Area'));
			if(!in_array('volume',$excludeDimension))
				$grid->addColumn($lang->get('Volume'));
				
			$r=0;
			foreach($dimensions as $dimension) {
				$r++;

				$id=new html_hidden($dimension->id,$this->standardPrefix.'DimensionId'.$r);
				
				$date=new html_text($dimension->date,'dateField dimensionDate');
				$date->id=$this->standardPrefix . 'DimensionDate'.$r;
				
				$weight=new html_text($dimension->weight);
				$weight->id=$this->standardPrefix.'Weight'.$r;

				$height=new html_text($dimension->height);
				$height->id=$this->standardPrefix.'Height'.$r;
				
				$depth=new html_text($dimension->depth);
				$depth->id=$this->standardPrefix.'Depth'.$r;
				
				$length=new html_text($dimension->length);
				$length->id=$this->standardPrefix.'Length'.$r;

				$width=new html_text($dimension->width);
				$width->id=$this->standardPrefix.'Width'.$r;

				$area=new html_text($dimension->area);
				$area->id=$this->standardPrefix.'Area'.$r;

				$volume=new html_text($dimension->volume);
				$volume->id=$this->standardPrefix.'Volume'.$r;
				
				$cells=array($id,$date);
				if(!in_array('weight',$excludeDimension))
					$cells[]=$weight;
				if(!in_array('height',$excludeDimension))
					$cells[]=$height;
				if(!in_array('depth',$excludeDimension))
					$cells[]=$depth;
				if(!in_array('length',$excludeDimension))
					$cells[]=$length;
				if(!in_array('width',$excludeDimension))
					$cells[]=$width;
				if(!in_array('area',$excludeDimension))
					$cells[]=$area;
				if(!in_array('volume',$excludeDimension))
					$cells[]=$volume;
				
				$grid->addRow($cells,'dimension');
			}
			$grid->addRow(array('',new html_button($lang->get('Add dimension'),'addDimension')));
			$cont="var showWeight=".(!in_array('weight',$excludeDimension)?'true':'false').";\n";
			$cont.="var showHeight=".(!in_array('height',$excludeDimension)?'true':'false').";\n";
			$cont.="var showDepth=".(!in_array('depth',$excludeDimension)?'true':'false').";\n";
			$cont.="var showLength=".(!in_array('length',$excludeDimension)?'true':'false').";\n";
			$cont.="var showWidth=".(!in_array('width',$excludeDimension)?'true':'false').";\n";
			$cont.="var showArea=".(!in_array('area',$excludeDimension)?'true':'false').";\n";
			$cont.="var showVolume=".(!in_array('volume',$excludeDimension)?'true':'false').";\n";
			$cont.="var table=$('$grid->id');";
			$cont.=implode('',file(__DIR__."/scripts/dimensionForm.js"));
//			$cont.="initDimensionForm();";
			$grid->loadScript=$cont;
			$this->fixDateFields=true;
		}
		
		function addImageField($id,$label,$fileId,$distinction='',$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;

			$field=new html_td();
			$field->id=$this->standardPrefix . $id;

			$conf=config_conf::getSingleton();
			$width=$conf->get('thumbnail_width',50);
			$height=$conf->get('thumbnail_height',50);
			
			$div=new html_div();
			$div->id=$this->standardPrefix.$id."Image";
			if(!is_null($fileId)) {
				$img=new html_img("common/getFile.php?id=$fileId&thumbnail&maxwidth=$width&maxheight=$height&width=$width&height=$height");
			} else {
				$img=new html_span($this->lang->get('No_image'));
			}
			$div->addEntity($img);
			
			$ip=new html_imagePicker();
			$ip->distinctionString=$distinction;
			$ip->id=$this->standardPrefix.$id."ImagePicker";
			$ip->imageContainer=$div;
			
			$input=new html_hidden();
			$input->value=$fileId;

			$field->addEntity($div);
			$field->addEntity($ip);
			$div->addEntity($input);
			$this->addField($label,$field,$area);			
		}
		
		function addImage() {
			$pic=$this->addExpandableArea('ImageDiv','image','Image');
			$upload=new html_imageUpload();
			$upload->lang=$lang;
			$upload->imageFilename=$filename;
			$upload->namePrefix=$this->standardPrefix;
			$pic->table->addEntity(new html_tr('',array($upload)));
		}
		
		function addImages($imageList,$table,$tableRowId,$prefix=false) {
			if(!$prefix)
				$prefix=$this->standardPrefix;
			$pic=$this->addExpandableArea('ImagesDiv','images','Images',$prefix);
			
			$list=new html_imageList();
			$list->id=$prefix."ImageList";
			$list->table=$table;
			$list->tableRowId=$tableRowId;
			foreach($imageList as $image) {
				$list->addImage($image);
			}
			$td=new html_td($list);
			$td->id=$prefix."ImageListTD";
			$pic->table->addEntity(new html_tr('',array($td)));
			$this->addImagePicker($prefix,$list);
			$this->lastArea->table->addEntity(new html_tr('',array(new html_a($this->lang->get('Remove_link_to_selected_images'),'javascript:removeImageLinkToSelected()'))));
		}
		
		function addImagePicker($prefix=false,$imageList=false) {
			if(!$prefix)
				$prefix=$this->standardPrefix;
			$area=$this->lastArea;
			$ip=new html_imagePicker();
			if($imageList)
				$ip->imageList=$imageList;
			$ip->id=$prefix."ImagePicker";
			$ip->onCompleteAjax='images/imageList.php?prefix='.$prefix;
			$ip->onCompleteAjaxContainer=$prefix."ImageListTD";
			$area->table->addEntity(new html_tr('',array($ip)));
		}
		
		function addLocation(locatable_inLocation $location,$expanderLabel='location',$prefix=NULL,$area=NULL) {
			$sess=new data_session();
			$loc=$this->addExpandableArea('Location',$expanderLabel,'Location',$prefix,$area);
			if(is_null($prefix))
				$prefix=$this->standardPrefix;

			if(is_a($location,'locatable_inArena'))
				$this->addSearchField('Arena','Arena',$location->getArena()->id,$location->getArena()->getName(),'arenas/arenaJSON.php','addArena',NULL,$prefix,'',$sess->checkUrl(false,$_SESSION['basedir'].'/arenas.php'));
			if(is_a($location,'locatable_inStreet')) {
				$this->addTextField('Street','Street_name',$location->streetName);
				$this->addTextField('StreetNumber','Street_number',$location->streetNumber);
				$this->addTextField('ZipCode','Zip_code',$location->zipCode);
				$this->addTextField('ZipArea','Zip_area',$location->zipArea);
			}
			if(is_a($location,'locatable_inCity'))
				$this->addSearchField('City','City',$location->getCity()->id,$location->getCity()->getName(),'cities/cityJSON.php','addCity',NULL,$prefix,'',$sess->checkUrl(false,$_SESSION['basedir'].'/cities.php'));
			if(is_a($location,'locatable_inState'))
				$this->addSearchField('State','State',$location->getState()->id,$location->getState()->getName(),'states/stateJSON.php','addState',NULL,$prefix,'',$sess->checkUrl(false,$_SESSION['basedir'].'/states.php'));
			if(!is_null($this->dataReader)) {
				$countries=$this->dataReader->getCountryList(true);
				$continents=$this->dataReader->getContinentList(true);
			}
			if(is_a($location,'locatable_inCountry'))
				$this->addSearchField('Country','Country',$location->getCountry()->id,$location->getCountry()->getName(),'countries/countryJSON.php','addCountry',$countries,$prefix,'',$sess->checkUrl(false,$_SESSION['basedir'].'/countries.php'));
			if(is_a($location,'locatable_inContinent')) 
				$this->addSearchField('Continent','Continent',$location->getContinent()->id,$location->getContinent()->getName(),'continents/continentJSON.php','addContinent',$continents,$prefix,'',$sess->checkUrl(false,$_SESSION['basedir'].'/continents.php'));
			$position=new html_mapLocation();
			$position->id=$prefix.'Map';
			$position->longitude=$location->getLongitude();
			$position->latitude=$location->getLatitude();
			$position->helpText=$this->lang->get('Click map to change coordinates');
			$position->resetButtonText=$this->lang->get('Revert position');
			$position->centerButtonText=$this->lang->get('Center coordinates on map');
			$position->findButtonText=$this->lang->get('Search on map');
			$position->addressButtonText=$this->lang->get('Get address');
			$loc->table->addEntity(new html_tr('',array($position)));
				
			$this->initMap=true;
			$loc->getDiv()->addEntity(new html_hidden($location->id,$prefix.'LocationId'));
		}
		
		function addSubstitutionsGrid($prefix,$subs,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			$lang=$this->lang;
			$grid=new html_dataGrid();
			$grid->id=$this->standardPrefix . $prefix . "SubstitutionsGrid";
			$area->table->addEntity($grid);
			$grid->addColumns(array('',$lang->get('Out'),$lang->get('In'),$lang->get('Time')));
			$r=1;
			foreach($subs as $sub) {
				$form=new form_substitutionForm($this->standardPrefix . $prefix,'match',$sub,$r);
				$grid->addRow($form->getCells(),'player');
				$r++;
			}			
			$grid->addRow(array('',new html_button($lang->get('Add substitution'),'',"add".ucfirst($this->standardPrefix).$prefix."Substitution();")));
			$this->fixSearchBoxes=true;									
		}
		
	function addCaptainsGrid($prefix,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			$lang=$this->lang;
			$grid=new html_dataGrid();
			$grid->id=$this->standardPrefix . $prefix . "CaptainsGrid";
			$area->table->addEntity($grid);
			$grid->addColumns(array('',$lang->get('Player'),$lang->get('Entire game'),$lang->get('Start_time'),$lang->get('End_time')));
			$grid->addRow(array('',new html_button($lang->get('Add captain'),'',"add".ucfirst($this->standardPrefix).$prefix."Captain();")));
			$this->fixSearchBoxes=true;									
		}

		function addMoMGrid($prefix,$area=NULL) {
			if(is_null($area))
				$area=$this->lastArea;
			$lang=$this->lang;
			$grid=new html_dataGrid();
			$grid->id=$this->standardPrefix . $prefix . "MoMGrid";
			$area->table->addEntity($grid);
			$grid->addColumns(array('',$lang->get('Player'),$lang->get('Awarding organization')));
			$grid->addRow(array('',new html_button($lang->get('Add player'),'',"add".ucfirst($this->standardPrefix).$prefix."MoM();")));
			$this->fixSearchBoxes=true;									
		}
				
		function createIcon($fileId) {
			if(is_null($fileId)) {
				$this->icon=NULL;
				return;
			}
			$width=$this->conf->get('icon_width',25);
			$height=$this->conf->get('icon_height',25);
			$this->icon=new html_img("common/getFile.php?id=".$fileId."&thumbnail&width=$width&height=$height&maxwidth=$width&maxheight=$height");
		}
	}
?>