<?php
	include_once('../_define.php');
	
	$sess->checkUrl(false,$_SESSION['basedir'].'/persons.php',true);
	
	$personid=$_GET['id'];
	
	if($personid>0)
		$person=$dr->getPersonById($personid);
	else {
		$person=person_person::getUnknown();
		if($personid==-2) {
			$person->motherOrganizationId=$myTeam;
		}
	}
	
	if($personid==-99) {
		$form=new form_fetchFromMasterForm('person','pe','person_person');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	} 
	$form=new form_standardForm('person','persons');
	$form->dataReader=$dr;
	
	if($person->id!=NULL) 
		$form->headline=$person->getName();
	else 
		$form->headline=$lang->get('New person');
	
	//Info
	
	$countryinfo=$form->addExpandableArea('Info','person_info','Person_information');	
		
	$form->addLangField('Names','Name',$person->strings,'name');					//addLangField defaults to latest created area
	$form->addLangField('FirstNames','First_name',$person->strings,'firstName');	//addLangField defaults to latest created area
	$form->addLangField('LastNames','Last_name',$person->strings,'lastName');		//addLangField defaults to latest created area
	$form->addLangField('FullNames','Full_name',$person->strings,'fullName');		//addLangField defaults to latest created area
	$form->addLangField('NickNames','Nickname',$person->strings,'nickNames');		//addLangField defaults to latest created area
	$form->addTextField('NativeName','Native_name',$person->nativeName);
	$form->addDateField('BirthDate','Birth_date',$person->birthDate);
	$form->addDateField('DeceaseDate','Decease_date',$person->deceaseDate);
	$form->addSearchField('MotherOrganization','Mother_organization',$person->getMotherOrganization()->id,$person->getMotherOrganization()->getName(),'organizations/organizationJSON.php','addOrganization');
	$form->addLongTextField('PrivateComment','Internal comments',$person->privateComment);
	$form->addLangField('PublicComment','Public comments',$person->strings,'publicComment');
	
	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='savePerson';
	
	$imageList=$dr->getImageList('person',$person->id);
	$form->addImages($imageList,'person',$person->id);
	
	$form->addExpandableArea('PersonDimensionsDiv','dimensions','Dimensions');
	$form->addDimensionsGrid($person->dimensions,array('depth','length','width','area','volume'));
	
	$form->addLocation($person);
	$form->addLocation($person->birthLocation,'birth_place','personBirth');
	
	$form->addExpandableArea('TeamRolesDiv','team_roles','Team roles');
	$form->addTeamRolesGrid($person->roles);

	$form->addExpandableArea('OrganizationRolesDiv','organization_roles','Organization roles');
	//$form->addOrganizationRolesGrid($person->roles);
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($person),'person');
?>