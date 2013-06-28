<?php
	include_once('_define.php');
	include_once('precipitationTypesPage.php');

	$page=new precipitationTypesPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectPrecipitationType';
	$selected=$dropdown->addOption('',$lang->get('Choose precipitation_type').'...');
	$dropdown->addOption(-1,$lang->get('New precipitation_type'));
	
	$precipitationTypes=$dr->getPrecipitationTypeList();	
	foreach($precipitationTypes as $precipitationType) {
		$opt=$dropdown->addOption($precipitationType->id,$precipitationType->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Precipitation_type').': '));
	$page->contents->addEntity($dropdown);
	
	$precipitationTypeForm=new html_div();
	$precipitationTypeForm->id="precipitationTypeFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($precipitationTypeForm);
	
	$page->printHTML();
?>