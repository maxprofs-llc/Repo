<?php
	include_once('../_define.php');

	$periodTypeid=$_GET['id'];
	
	if($periodTypeid>0)
		$periodType=$dr->getGenericById($periodTypeid,'periodType','pt','match_periodType');
	else {
		$periodType=new match_periodType();
		$periodType->id=-1;
	}
	
	if($periodTypeid==-99) {
		$form=new form_fetchFromMasterForm('periodType','pt','match_periodType');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	} 
	
	$form=new form_standardForm('periodType','periodTypes');

	if(!is_null($periodType->id)) 
		$form->headline=$periodType->getName();
	else
		$form->headline=$lang->get('New period_type');
	
	//Info
	
	$periodTypeinfo=$form->addExpandableArea('Info','period_type_info','Period_type_info');
		
	$form->addLangField('Names','Name',$periodType->strings,'name');					//addLangField defaults to latest created area
	//$form->addLongTextField('PrivateComment','Internal comments',$periodType->privateComment);
	$form->addTextField('DefaultLength','Default_length',$periodType->defaultLength,$lang->get('minutes'));
	$form->addTextField('DefaultStartTime','Default_start_time',$periodType->defaultStartTime);
	$form->addCheckBoxField('Pause','Pause',$periodType->isPause);
	$form->addCheckBoxField('Effective','Effective_time',$periodType->isEffective);
	$form->addCheckBoxField('Extended','Extended_time',$periodType->isExtended);
	$form->addCheckBoxField('PenaltyShootout','Penalty_shootout',$periodType->isPenaltyShootout);
	$form->addLangField('PublicComment','Public comments',$periodType->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='savePeriodType';
		
	$form->printHTML();
	
	//helper::debugPrint(json_encode($empty),'empty');
?>