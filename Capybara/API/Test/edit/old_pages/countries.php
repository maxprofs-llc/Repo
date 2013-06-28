<?php
	include_once('_define.php');
	include_once('countriesPage.php');

	$page=new countriesPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectCountry';
	$selected=$dropdown->addOption('',$lang->get('Choose country').'...');
	$dropdown->addOption(-1,$lang->get('New country'));
	$dropdown->addOption(-99,$lang->get('Get country from Master database'));
	
	$countries=&$dr->getCountryList();

	foreach($countries as $country) {
		$opt=$dropdown->addOption($country->id,$country->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Country').': '));
	$page->contents->addEntity($dropdown);
	
	$countryform=new html_div();
	$countryform->id="countryFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($countryform);
	$page->printHTML();
?>