<?php
	include_once('../_define.php');

	$precipitationTypeid=$_GET['id'];
	
	if($precipitationTypeid>0)
		$precipitationType=$dr->getPrecipitationTypeById($precipitationTypeid);
	else {
		$precipitationType=new precipitationType();
		$precipitationType->id=-1;
	}

	if($precipitationTypeid==-99) {
		$form=new form_fetchFromMasterForm('precipitationType','pt','weather_precipitationType');
		$form->showSave=(!isset($_GET['nosave']));
		$form->printHTML();
		die();
	}
	$form=new form_standardForm('precipitationType','precipitationTypes');

	if(!is_null($precipitationType->id)) 
		$form->headline=$precipitationType->getName();
	else
		$form->headline=$lang->get('New precipitation_type');
	
	//Info
	
	$precipitationTypeinfo=$form->addExpandableArea('Info','precipitation_type_info','Precipitation_type_info');
		
	$form->addLangField('Names','Name',$precipitationType->strings,'name');					//addLangField defaults to latest created area
	//$form->addLongTextField('PrivateComment','Internal comments',$precipitationType->privateComment);
	$form->addLangField('PublicComment','Public comments',$precipitationType->strings,'publicComment');

	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='savePrecipitationType';
		
	$form->printHTML();
	
	//helper::debugPrint(json_encode($empty),'empty');
?>