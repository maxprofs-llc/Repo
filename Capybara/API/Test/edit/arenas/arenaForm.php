<?php
	include_once('../_define.php');
	
	$sess->checkUrl(false,$_SESSION['basedir'].'/arenas.php',true);
	
	$arenaid=$_GET['id'];
	
	if($arenaid>0)
		$arena=$dr->getArenaById($arenaid);
	else
		$arena=new arena();
	
	if($arenaid==-99) {
		$form=new form_fetchFromMasterForm('arena','ar','arena');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	}
	$form=new form_standardForm('arena','arenas');

	if(!is_null($arena->id)) 
		$form->headline=$arena->getName();
	else
		$form->headline=$lang->get('New arena');

	//Info

	$arenainfo=$form->addExpandableArea('Info','arena_info','Arena_information');
	
	$form->addLangField('Names','Name',$arena->strings,'name');					//addLangField defaults to latest created area
	$form->addTextField('NativeName','Native_name',$arena->nativeName);
	$form->addTextField('Linkaddress','Homepage',$arena->url);
	$form->addLongTextField('PrivateComment','Internal comments',$arena->privateComment);
	$form->addLangField('PublicComment','Public comments',$arena->strings,'publicComment');
	
	$form->addLocation($arena);
	
	$imageList=$dr->getImageList('arena',$arena->id);
	$form->addImages($imageList,'arena',$arena->id);
	
	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveArena';
			
	$form->printHTML();

?>