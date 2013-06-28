<?php
	include_once('../_define.php');

	$emptyid=$_GET['id'];
	
	if($emptyid>0)
		$empty=$dr->getEmptyById($emptyid);
	else {
		$empty=new team_empty();
		$empty->id=-1;
	}
	
	$form=new form_standardForm('empty','emptys');

	if(!is_null($empty->id)) 
		$form->headline=$empty->getName();
	else
		$form->headline=$lang->get('New empty');
	
	//Info
	
	$emptyinfo=$form->addExpandableArea('Info','empty_info','Empty_information');
		
	$form->addLangField('Names','Name',$empty->strings,'name');					//addLangField defaults to latest created area
	$form->addLongTextField('PrivateComment','Internal comments',$empty->privateComment);
	$form->addLangField('PublicComment','Public comments',$empty->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveEmpty';
	
	$form->addImage();
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($empty),'empty');
?>