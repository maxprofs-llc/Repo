<?php
	include_once('../_define.php');

	$sess->checkUrl(false,$_SESSION['basedir'].'/continents.php',true);
	
	$continentid=$_GET['id'];
	
	if($continentid>0)
		$continent=$dr->getContinentById($continentid);
	else
		$continent=location_continent::getUnknown();

	if($continentid==-99) {
		$form=new form_fetchFromMasterForm('continent','cn','location_continent');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	}		
	$form=new form_standardForm('continent','continents');
	
	if(!is_null($continent->id)) 
		$form->headline=$continent->getName();
	else
		$form->headline=$lang->get('New continent');
	
	//Info
	
	$continentinfo=$form->addExpandableArea('Info','continent_info','Continent_information');
	
	$form->addLangField('Names','Name',$continent->strings,'name');					//addLangField defaults to latest created area
	$form->addLangField('ShortNames','Short_name',$continent->strings,'shortName');
	$form->addLongTextField('PrivateComment','Internal comments',$continent->privateComment);
	$form->addLangField('PublicComment','Public comments',$continent->strings,'publicComment');

	
	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveContinent';
	
	$form->addImage();
	$form->addLocation($continent);
	
	//Add to seperate tab later //-
		
	if($continentid>0) {	
		
		$cities=$form->addExpandableArea('Cities','cities','Manage cities');
		$form->addMoveList('Cities',$dr->getCityList(),'getContinent','id',$continent->id,'Cities in unknown continent','moveCityToContinent','moveCityToUnknown');
		
		$states=$form->addExpandableArea('States','states','Manage states');
		$form->addMoveList('States',$dr->getStateList(),'getContinent','id',$continent->id,'States in unknown continent','moveStateToContinent','moveStateToUnknown');
		
		$countries=$form->addExpandableArea('Countries','countries','Manage countries');
		$form->addMoveList('Countries',$dr->getCountryList(),'getContinent','id',$continent->id,'Countries in unknown continent','moveCountryToContinent','moveCountryToUnknown');
		
	}
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($continent),'continent');
?>