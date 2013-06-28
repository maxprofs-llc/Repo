<?php
	include_once('../_define.php');
	
	$sess->checkUrl(false,$_SESSION['basedir'].'/cities.php',true);
	
	$cityid=$_GET['id'];
	if($cityid==-99) {
		$form=new form_fetchFromMasterForm('city','ci','location_city');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	}
		
	if($cityid>0)
		$city=$dr->getCityById($cityid);
	else {
		$city=location_city::getUnknown();
	}
	
	$form=new form_standardForm('city','cities',$city);

	if(!is_null($city->id)) 
		$form->headline=$city->getName();
	else 
		$form->headline=$lang->get('New city');
	
	//Info
	
	$countryinfo=$form->addExpandableArea('Info','city_info','City_information');	
		
	$form->addLangField('Names','Name',$city->strings,'name');					//addLangField defaults to latest created area

	$form->addTextField('NativeName','Native_name',$city->nativeName);
	//$form->addSearchField('State','State',$city->getState()->id,$city->getState()->getName(),'states/stateJSON.php','addState');
	//$form->addSearchField('Country','Country',$city->getCountry()->id,$city->getCountry()->getName(),'countries/countryJSON.php','addCountry');
	//$form->addSearchField('Continent','Continent',$city->getContinent()->id,$city->getContinent()->getName(),'continents/continentJSON.php','addContinent');
	$form->addLangField('Linkaddress','Homepage',$city->strings,'url');
	$form->addLongTextField('PrivateComment','Internal comments',$city->privateComment);
	$form->addLangField('PublicComment','Public comments',$city->strings,'publicComment');
	
	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveCity';
	
	$form->addImage();
	$form->addLocation($city);

	$form->printHTML();
	
	//helper::debugPrint(json_encode($city),'city');
?>