<?php
	include_once('../_define.php');

	$sess->checkUrl(false,$_SESSION['basedir'].'/sports.php',true);
	
	$sportid=$_GET['id'];
	
	if($sportid>0)
		$sport=$dr->getSportById($sportid);
	else {
		$sport=new sport();
		$sport->id=-1;
	}
	
	if($sportid==-99) {
		$form=new form_fetchFromMasterForm('sport','sp','sport');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	} 
	$form=new form_standardForm('sport','sports');

	if(!is_null($sport->id)) 
		$form->headline=$sport->getName();
	else
		$form->headline=$lang->get('New sport');
	
	//Info
	
	$sportinfo=$form->addExpandableArea('Info','sport_info','Sport_information');
		
	$form->addLangField('Names','Name',$sport->strings,'name');					//addLangField defaults to latest created area
	$form->addLongTextField('PrivateComment','Internal comments',$sport->privateComment);
	$form->addLangField('PublicComment','Public comments',$sport->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveSport';
	
	//$form->addImage();
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($sport),'sport');
?>