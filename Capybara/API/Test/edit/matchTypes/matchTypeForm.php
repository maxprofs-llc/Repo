<?php
	include_once('../_define.php');

	$matchTypeId=$_GET['id'];
	
	if($matchTypeId>0)
		$matchType=$dr->getMatchTypeById($matchTypeId);
	else {
		$matchType=new matchType();
		$matchType->id=-1;
	}
	
	$form=new form_standardForm('matchType','matchTypes');

	if(!is_null($matchType->id)) 
		$form->headline=$matchType->getName();
	else
		$form->headline=$lang->get('New match_type');
	
	//Info
	
	$matchTypeinfo=$form->addExpandableArea('Info','match_type_info','Match_type_information');
		
	$form->addLangField('Names','Name',$matchType->strings,'name');					//addLangField defaults to latest created area
	$form->addLongTextField('PrivateComment','Internal comments',$country->privateComment);
	$form->addLangField('PublicComment','Public comments',$country->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveMatchType';
	
	//$form->addImage();
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($matchType),'matchType');
?>