<?php
	include_once('../_define.php');

	$sess->checkUrl(false,$_SESSION['basedir'].'/organizations.php',true);
	
	$organizationid=$_GET['id'];
	
	if($organizationid>0)
		$organization=$dr->getOrganizationById($organizationid);
	else {
		$organization=new organization();
		$organization->id=-1;
	}
	
	if($organizationid==-99) {
		$form=new form_fetchFromMasterForm('organization','org','organization');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	} 
	$form=new form_standardForm('organization','organizations',$organization);

	if(!is_null($organization->id)) {
		$form->headline=$organization->getName();
		$form->createIcon($organization->getLogoImageId());
	}
	else
		$form->headline=$lang->get('New organization');
	$form->dataReader=$dr;
	
	//Info
	
	$organizationinfo=$form->addExpandableArea('Info','organization_info','Organization_information');
		
	$form->addLangField('Names','Name',$organization->strings,'name');					//addLangField defaults to latest created area
	$form->addLangField('FullNames','Full_name',$organization->strings,'fullName');					//addLangField defaults to latest created area
	$form->addLangField('NickNames','Nickname',$organization->strings,'nickName');					//addLangField defaults to latest created area
	$form->addLangField('ShortNames','Short_name',$organization->strings,'shortName');					//addLangField defaults to latest created area
	$form->addLangField('SortNames','Sort_name',$organization->strings,'sortName');					//addLangField defaults to latest created area
	$form->addTextField('NativeName','Native name',$organization->nativeName);
	$form->addTextField('NativeFullName','Native full_name',$organization->nativeFullName);
	$form->addTextField('NativeNickName','Native nickname',$organization->nativeNickName);
	$form->addTextField('NativeShortName','Native short_name',$organization->nativeShortName);
	$form->addTextField('NativeSortName','Native sort_name',$organization->nativeSortName);
	$form->addSearchField('OrganizationType','Organization type',$organization->getOrganizationType()->id,$organization->getOrganizationType()->getName(),'organizationTypes/organizationTypeJSON.php','addOrganizationType',NULL,NULL,NULL,$sess->checkUrl(false,$_SESSION['basedir'].'/organizationTypes.php'));
	$form->addSearchField('ParentOrganization','Parent organization',$organization->getParentOrganization()->id,$organization->getParentOrganization()->getName(),'organizations/organizationJSON.php','addOrganization',NULL,NULL,NULL,$sess->checkUrl(false,$_SESSION['basedir'].'/organizations.php'));
	$form->addDateField('FoundingDate','Founding_date',$organization->foundingDate);
	$form->addDateField('CessationDate','Cessation_date',$organization->cessationDate);
	$form->addLangField('Homepage','Homepage',$organization->strings,'url');
	$form->addImageField('Logo','Team logo',$organization->logoFileId,'Logo');
	$form->addLongTextField('PrivateComment','Internal comments',$organization->privateComment);
	$form->addLangField('PublicComment','Public comments',$organization->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveOrganization';
	
	$form->addImage();
	
	$form->addLocation($organization);
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($organization),'organization');
?>