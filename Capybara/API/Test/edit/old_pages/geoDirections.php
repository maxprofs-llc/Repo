<?php
	include_once('_define.php');
	include_once('geoDirectionsPage.php');

	$page=new geoDirectionsPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectGeoDirection';
	$selected=$dropdown->addOption('',$lang->get('Choose geographical_direction').'...');
	$dropdown->addOption(-1,$lang->get('New geographical_direction'));
	
	$geoDirections=$dr->getGeoDirectionList();	
	foreach($geoDirections as $geoDirection) {
		$opt=$dropdown->addOption($geoDirection->id,$geoDirection->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Geographical_direction').': '));
	$page->contents->addEntity($dropdown);
	
	$geoDirectionForm=new html_div();
	$geoDirectionForm->id="geoDirectionFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($geoDirectionForm);
	
	$page->printHTML();
?>