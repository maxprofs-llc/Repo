<?php
	include_once('../_define.php');

	$geoDirectionid=$_GET['id'];
	
	if($geoDirectionid>0)
		$geoDirection=$dr->getGeoDirectionById($geoDirectionid);
	else {
		$geoDirection=new geoDirection();
		$geoDirection->id=-1;
	}
	
	if($geoDirectionid==-99) {
		$form=new form_fetchFromMasterForm('geoDirection','gd','geoDirection');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	}
	
	$form=new form_standardForm('geoDirection','geoDirections');

	if(!is_null($geoDirection->id)) 
		$form->headline=$geoDirection->getName();
	else
		$form->headline=$lang->get('New geographical_direction');
	
	//Info
	
	$geoDirectioninfo=$form->addExpandableArea('Info','geographical_direction_info','Geographical_direction_information');
		
	$form->addLangField('Names','Name',$geoDirection->strings,'name');					//addLangField defaults to latest created area
	$form->addLangField('ShortNames','Short_name',$geoDirection->strings,'shortName');					//addLangField defaults to latest created area
	$form->addTextField('Degrees','Degrees',$geoDirection->degrees,'°');
	//$form->addLongTextField('PrivateComment','Internal comments',$geoDirection->privateComment);
	$form->addLangField('PublicComment','Public comments',$geoDirection->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveGeoDirection';
		
	$form->printHTML();
	
	//helper::debugPrint(json_encode($empty),'empty');
?>