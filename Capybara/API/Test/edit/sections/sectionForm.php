<?php
	include_once('../_define.php');

	$sess->checkUrl(false,$_SESSION['basedir'].'/sections.php',true);
	
	$sectionid=$_GET['id'];
	
	if($sectionid>0)
		$section=$dr->getSectionById($sectionid);
	else {
		$section=new team_section();
		$section->id=-1;
	}
	
	if($sectionid==-99) {
		$form=new form_fetchFromMasterForm('section','se','team_section');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	} 
	$form=new form_standardForm('section','sections');

	if(!is_null($section->id)) 
		$form->headline=$section->getName();
	else
		$form->headline=$lang->get('New section');
	
	//Info
	
	$sectioninfo=$form->addExpandableArea('Info','section_info','Section_information');
		
	$form->addLangField('Names','Name',$section->strings,'name');					//addLangField defaults to latest created area
	$form->addLongTextField('PrivateComment','Internal comments',$section->privateComment);
	$form->addLangField('PublicComment','Public comments',$section->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveSection';
	
	//$form->addImage();
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($section),'section');
?>