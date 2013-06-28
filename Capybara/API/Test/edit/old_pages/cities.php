<?php
	include_once('_define.php');
	include_once('citiesPage.php');

	$page=new citiesPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectCity';
	$selected=$dropdown->addOption('',$lang->get('Choose city').'...');
	$dropdown->addOption(-1,$lang->get('New city'));
	$dropdown->addOption(-99,$lang->get('Get city from Master database'));
	
	$cities=$dr->getCityList();	
	foreach($cities as $city) {
		$opt=$dropdown->addOption($city->id,$city->getLocationString());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('City').': '));
	$page->contents->addEntity($dropdown);
	
	$cityform=new html_div();
	$cityform->id="cityFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($cityform);
	
	$page->printHTML();
?>