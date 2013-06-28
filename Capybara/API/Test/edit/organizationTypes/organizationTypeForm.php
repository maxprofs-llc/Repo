<?php
	include_once('../_define.php');

	$sess->checkUrl(false,$_SESSION['basedir'].'/organizationTypes.php',true);
	
	$organizationTypeId=$_GET['id'];
	
	if($organizationTypeId>0)
		$organizationType=$dr->getOrganizationTypeById($organizationTypeId);
	else {
		$organizationType=new organizationType();
		$organizationType->id=-1;
	}

	if($organizationTypeId==-99) {
		$form=new form_fetchFromMasterForm('organizationType','ot','organizationType');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	}	
	$form=new form_standardForm('organizationType','organizationTypes');

	if(!is_null($organizationType->id)) 
		$form->headline=$organizationType->getName();
	else
		$form->headline=$lang->get('New organization_type');
	
	//Info
	
	$organizationTypeinfo=$form->addExpandableArea('Info','organization_type_info','Organization_type_information');
		
	$form->addLangField('Names','Name',$organizationType->strings,'name');					//addLangField defaults to latest created area
	$form->addLongTextField('PrivateComment','Internal comments',$organizationType->privateComment);
	$form->addSearchField('ParentOrganizationType','Parent organization_type',$organizationType->parentOrganizationType->id,$organizationType->parentOrganizationType->getName(),'','addOrganizationType',$dr->getOrganizationTypeList());
	$form->addLangField('PublicComment','Public comments',$organizationType->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveOrganizationType';
	
	$form->addImage();
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($organizationType),'organizationType');
?>