<?php
	include_once('../_define.php');

	$sess->checkUrl(false,$_SESSION['basedir'].'/teams.php',true);
	
	$teamid=$_GET['id'];
	
	if($teamid>0)
		$team=$dr->getTeamById($teamid);
	else {
		$team=new team();
		$team->id=-1;
	}
	
	if($teamid==-99) {
		$form=new form_fetchFromMasterForm('team','te','team');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	} 
	$form=new form_standardForm('team','teams');
	$form->dataReader=$dr;
	
	if(!is_null($team->id)) {
		$form->headline=$team->getName();
		$form->createIcon($team->getLogoImageId());
	}
	else
		$form->headline=$lang->get('New team');
	
	//Info
	
	$teaminfo=$form->addExpandableArea('Info','team_info','Team_information');
		
	$form->addLangField('Names','Name',$team->strings,'name');					//addLangField defaults to latest created area
	$form->addLangField('ShortNames','Short_name',$team->strings,'shortName');					//addLangField defaults to latest created area
	$form->addLangField('FullNames','Full name',$team->strings,'fullName');					//addLangField defaults to latest created area
	$form->addLangField('NickNames','Nick_name',$team->strings,'nickName');					//addLangField defaults to latest created area
	$form->addLangField('SortNames','Sort_name',$team->strings,'sortName');					//addLangField defaults to latest created area
	$form->addTextField('NativeName','Native_name',$team->nativeName);
	$form->addTextField('NativeShortName','Native_short_name',$team->nativeName);
	$form->addTextField('NativeFullName','Native_full_name',$team->nativeFullName);
	$form->addTextField('NativeNickName','Native_nick_name',$team->nativeNickName);
	$form->addTextField('NativeSortName','Native_sort_name',$team->nativeSortName);
	$form->addSearchField('Organization','Organization',$team->getOrganization()->id,$team->getOrganization()->getName(),'organizations/organizationJSON.php','addOrganization',NULL,NULL,NULL,$sess->checkUrl(false,$_SESSION['basedir'].'/organizations.php'));
	$form->addSearchField('Arena','Home_arena',$team->getHomeArena()->id,$team->getHomeArena()->getName(),'arenas/arenaJSON.php','addArena',NULL,NULL,NULL,$sess->checkUrl(false,$_SESSION['basedir'].'/arenas.php'));
	$form->addSearchField('Sport','Sport',$team->getSport()->id,$team->getSport()->getName(),'sports/sportJSON.php','addSport',$dr->getSportList(),NULL,NULL,$sess->checkUrl(false,$_SESSION['basedir'].'/sports.php'));
	$form->addSearchField('Gender','Gender',$team->getGender()->id,$team->getGender()->getName(),'genders/genderJSON.php','addGender',$dr->getGenderList(),NULL,NULL,$sess->checkUrl(false,$_SESSION['basedir'].'/genders.php'));
	$form->addSearchField('Section','Section',$team->getSection()->id,$team->getSection()->getName(),'sections/sectionJSON.php','addSection',$dr->getSectionList(),NULL,NULL,$sess->checkUrl(false,$_SESSION['basedir'].'/sections.php'));
	$form->addSearchField('Cohort','Cohort',$team->getCohort()->id,$team->getCohort()->getName(),'cohorts/cohortJSON.php','addCohort',NULL,NULL,NULL,$sess->checkUrl(false,$_SESSION['basedir'].'/cohorts.php'));
	$form->addSearchField('AgeGroup','Age_group',$team->getAgeGroup()->id,$team->getAgeGroup()->getName(),'ageGroups/ageGroupJSON.php','addAgeGroup',NULL,NULL,NULL,$sess->checkUrl(false,$_SESSION['basedir'].'/ageGroups.php'));
	$form->addDateField('FoundingDate','Founding_date',$team->foundingDate);
	$form->addDateField('CessationDate','Cessation_date',$team->cessationDate);
	$form->addLangField('Homepage','Homepage',$team->strings,'url');
	$form->addImageField('Logo','Team logo',$team->logoFileId,'Logo');
	$form->addLongTextField('PrivateComment','Internal comments',$team->privateComment);
	$form->addLangField('PublicComment','Public comments',$team->strings,'publicComment');
	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveTeam';
	
	$form->addLocation($team);
	
	$imageList=$dr->getImageList('team',$team->id);
	$form->addImages($imageList,'team',$team->id);
			
	$form->printHTML();
	
	//helper::debugPrint(json_encode($team),'team');
?>