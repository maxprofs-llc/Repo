<?php
	include_once('../_define.php');

	$sess->checkUrl(false,$_SESSION['basedir'].'/cohorts.php',true);
	
	$cohortid=$_GET['id'];
	
	if($cohortid>0)
		$cohort=$dr->getCohortById($cohortid);
	else {
		$cohort=new team_cohort();
		$cohort->id=-1;
	}

	if($cohortid==-99) {
		$form=new form_fetchFromMasterForm('cohort','ch','team_cohort');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	}	
	$form=new form_standardForm('cohort','cohorts');

	if(!is_null($cohort->id)) 
		$form->headline=$cohort->getName();
	else
		$form->headline=$lang->get('New cohort');
	
	//Info
	
	$cohortinfo=$form->addExpandableArea('Info','cohort_info','Cohort_information');
		
	$form->addLangField('Names','Name',$cohort->strings,'name');					//addLangField defaults to latest created area
	$form->addDateField('StartDate','Start_date',$cohort->startDate);
	$form->addDateField('EndDate','End_date',$cohort->endDate);
	$form->addLongTextField('PrivateComment','Internal comments',$cohort->privateComment);
	$form->addLangField('PublicComment','Public comments',$cohort->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveCohort';
	
	$form->addImage();
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($cohort),'cohort');
?>