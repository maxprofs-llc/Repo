<?php
	include_once('../_define.php');

	$sess->checkUrl(false,$_SESSION['basedir'].'/states.php',true);
	
	$stateid=$_GET['id'];
	
	if($stateid>0)
		$state=$dr->getStateById($stateid);
	else {
		$state=location_state::getUnknown();
	}
	
	if($stateid==-99) {
		$form=new form_fetchFromMasterForm('state','st','location_state');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	} 
	$form=new form_standardForm('state','states');

	if(!is_null($state->id)) 
		$form->headline=$state->getName();
	else
		$form->headline=$lang->get('New state');
	
	//Info
	
	$stateinfo=$form->addExpandableArea('Info','state_info','State_information');
		
	$form->addLangField('Names','Name',$state->strings,'name');					//addLangField defaults to latest created area
	$form->addLangField('FullNames','Full_name',$state->strings,'fullName');					//addLangField defaults to latest created area
	$form->addLangField('ShortNames','Short_name',$state->strings,'shortName');					//addLangField defaults to latest created area
	$form->addLangField('SortNames','Sort_name',$state->strings,'sortName');					//addLangField defaults to latest created area
	$form->addTextField('NativeName','Native_name',$state->nativeName);
	$form->addTextField('NativeFullName','Native_full_name',$state->nativeFullName);
	$form->addTextField('NativeShortName','Native_short_name',$state->nativeShortName);
	$form->addTextField('NativeSortName','Native_sort_name',$state->nativeShortName);
	if(is_null($state->getCapitalCity()))
		$capital=$dr->getCityById(NULL);
	else
		$capital=$state->getCapitalCity();
	$form->addSearchField('Capital','Capital',$capital->id,$capital->getName(),'cities/cityJSON.php?stateid='.$state->id,'addCity');
	//$form->addSearchField('Country','Country',$state->getCountry()->id,$state->getCountry()->getName(),'countries/countryJSON.php','addCountry');
	//$form->addSearchField('Continent','Continent',$state->getContinent()->id,$state->getContinent()->getName(),'continents/continentJSON.php','addContinent');
	$form->addLongTextField('PrivateComment','Internal comments',$country->privateComment);
	$form->addLangField('PublicComment','Public comments',$country->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveState';
	
	$form->addImage();
	$form->addLocation($state);
	
	if($stateid>0) {	
		$cities=$form->addExpandableArea('Cities','cities','Manage cities');
		$form->addMoveList('Cities',$dr->getCityList(),'getState','id',$state->id,'Cities in unknown state','moveCityToState','moveCityToUnknown');
	}

	$form->printHTML();
	
	//helper::debugPrint(json_encode($state),'state');
?>