<?php
	include_once('../_define.php');

	$sess->checkUrl(false,$_SESSION['basedir'].'/genders.php',true);
	
	$genderid=$_GET['id'];
	
	if($genderid>0)
		$gender=$dr->getGenderById($genderid);
	else {
		$gender=new gender();
		$gender->id=-1;
	}

	if($genderid==-99) {
		$form=new form_fetchFromMasterForm('gender','ge','gender');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	}	
	$form=new form_standardForm('gender','genders');

	if(!is_null($gender->id)) 
		$form->headline=$gender->getName();
	else
		$form->headline=$lang->get('New gender');
	
	//Info
	
	$genderinfo=$form->addExpandableArea('Info','gender_info','Gender_information');
		
	$form->addLangField('Names','Name',$gender->strings,'name');					//addLangField defaults to latest created area
	$form->addLongTextField('PrivateComment','Internal comments',$country->privateComment);
	$form->addLangField('PublicComment','Public comments',$country->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveGender';
	
	//$form->addImage();
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($gender),'gender');
?>