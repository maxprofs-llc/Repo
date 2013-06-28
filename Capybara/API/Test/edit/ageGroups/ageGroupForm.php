<?php
	include_once('../_define.php');

	$sess->checkUrl(false,$_SESSION['basedir'].'/ageGroups.php',true);
	
	$ageGroupid=$_GET['id'];
	
	if($ageGroupid>0)
		$ageGroup=$dr->getAgeGroupById($ageGroupid);
	else {
		$ageGroup=new team_ageGroup();
		$ageGroup->id=-1;
	}

	if($ageGroupid==-99) {
		$form=new form_fetchFromMasterForm('ageGroup','ag','team_ageGroup');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	}	
	$form=new form_standardForm('ageGroup','ageGroups');

	if(!is_null($ageGroup->id)) 
		$form->headline=$ageGroup->getName();
	else
		$form->headline=$lang->get('New age_group');
	
	//Info
	
	$ageGroupinfo=$form->addExpandableArea('Info','age_group_info','Age_group_information');
		
	$form->addLangField('Names','Name',$ageGroup->strings,'name');					//addLangField defaults to latest created area
	$form->addTextField('MinAge','Minimum_age',$ageGroup->minAge);
	$form->addTextField('MaxAge','Maximum_age',$ageGroup->maxAge);
	$form->addLongTextField('PrivateComment','Internal comments',$ageGroup->privateComment);
	$form->addLangField('PublicComment','Public comments',$ageGroup->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveAgeGroup';
	
	//$form->addImage();
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($ageGroup),'ageGroup');
?>