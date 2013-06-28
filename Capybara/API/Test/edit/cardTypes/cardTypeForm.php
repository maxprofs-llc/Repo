<?php
	include_once('../_define.php');

	$cardTypeid=$_GET['id'];
	
	if($cardTypeid>0)
		$cardType=$dr->getGenericById($cardTypeid,'cardType','ct','cardType');
	else {
		$cardType=new cardType();
		$cardType->id=-1;
	}
	
	$form=new form_standardForm('cardType','cardTypes');

	if(!is_null($cardType->id)) 
		$form->headline=$cardType->getName();
	else
		$form->headline=$lang->get('New card_type');
	
	//Info
	
	$cardTypeinfo=$form->addExpandableArea('Info','card_type_info','Card_type_info');
		
	$form->addLangField('Names','Name',$cardType->strings,'name');					//addLangField defaults to latest created area
	//$form->addLongTextField('PrivateComment','Internal comments',$cardType->privateComment);
	$form->addLangField('PublicComment','Public comments',$cardType->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveCardType';
		
	$form->printHTML();
	
	//helper::debugPrint(json_encode($empty),'empty');
?>