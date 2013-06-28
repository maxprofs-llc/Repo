<?php
	include_once('../_define.php');
	
	$sess->checkUrl(false,$_SESSION['basedir'].'/roles.php',true);
	
	$roleid=$_GET['id'];
	
	if($roleid>0)
		$role=$dr->getRoleById($roleid);
	else {
		$role=person_role::getUnknown();
		if($roleid==-2) {
			$role->motherOrganization=$dr->getOrganizationById($myTeam);
		}
	}
	
	if($roleid==-99) {
		$form=new form_fetchFromMasterForm('role','ro','person_role');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	} 
	$form=new form_standardForm('role','roles',$role);
	$form->dataReader=$dr;
	
	if(!is_null($role->id)) 
		$form->headline=$role->getName();
	else 
		$form->headline=$lang->get('New role');
	
	//Info
	
	$countryinfo=$form->addExpandableArea('Info','role_info','Role_information');	
		
	$form->addLangField('Names','Name',$role->strings,'name');					//addLangField defaults to latest created area
	$form->addLangField('FullNames','Full_name',$role->strings,'fullName');		//addLangField defaults to latest created area
	$form->addLangField('ShortNames','Short_name',$role->strings,'shortName');		//addLangField defaults to latest created area
	$parentRole=$role->getParentRole();
	if(is_null($parentRole))
		$parentRole=person_role::getUnknown();
	$form->addSearchField('ParentRole','Parent_role',$role->parentRoleId,$parentRole->getName(),'roles/roleJSON.php','addRole',$dr->getRoleList(true,true));
	$form->addLongTextField('PrivateComment','Internal comments',$role->privateComment);
	$form->addLangField('PublicComment','Public comments',$role->strings,'publicComment');
	
	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveRole';
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($role),'role');
?>