<?php
	include_once('../_define.php');

	$sess->checkUrl(false,$_SESSION['basedir'].'/countries.php',true);
	
	$countryid=$_GET['id'];
	
	if($countryid>0)
		$country=$dr->getCountryById($countryid);
	else
		$country=location_country::getUnknown();

	if($countryid==-99) {
		$form=new form_fetchFromMasterForm('country','co','location_country');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	}
	$form=new form_standardForm('country','countries');

	if(!is_null($country->id)) 
		$form->headline=$country->getName();
	else
		$form->headline=$lang->get('New country');
	
	//Info
	
	$countryinfo=$form->addExpandableArea('Info','country_info','Country_information');
	
	$form->addLangField('Names','Name',$country->strings,'name');					//addLangField defaults to latest created area
	$form->addTextField('NativeName','Native_name',$country->nativeName);
	$form->addTextField('Iso2','ISO_2',$country->iso2);
	$form->addTextField('Iso3','ISO_3',$country->iso3);
	$form->addTextField('NumCode','Number_code',$country->numCode);
	$cc=$country->getCapitalCity();
	if(is_null($cc))
		$cc=location_city::getUnknown();
	$form->addSearchField('Capital','Capital',$cc->id,$cc->getName(),'cities/cityJSON.php?countryid='.$country->id,'addCity');
	//$form->addSearchField('Continent','Continent',$country->getContinent()->id,$country->getContinent()->getName(),'continents/continentJSON.php','addContinent');
	$form->addLongTextField('PrivateComment','Internal comments',$country->privateComment);
	$form->addLangField('PublicComment','Public comments',$country->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveCountry';
	
	$form->addImage();
	$form->addLocation($country);

	
	if($countryid>0) {	
		$cities=$form->addExpandableArea('Cities','cities','Manage cities');
		$form->addMoveList('Cities',$dr->getCityList(),'getCountry','id',$countryid,'Cities in unknown country','moveCityToCountry','moveCityToUnknown');
	
		$states=$form->addExpandableArea('States','states','Manage states');
		$form->addMoveList('States',$dr->getStateList(),'getCountry','id',$countryid,'States in unknown country','moveStateToCountry','moveStateToUnknown');
	}
	
	$form->printHTML();

	
	//helper::debugPrint(json_encode($country),'country');
?>