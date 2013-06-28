<?php
	include_once('_define.php');
	include_once('continentsPage.php');

	$page=new continentsPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectContinent';
	$selected=$dropdown->addOption('',$lang->get('Choose continent').'...');
	$dropdown->addOption(-1,$lang->get('New continent'));
	$dropdown->addOption(-99,$lang->get('Get continent from Master database'));
	
	$continents=$dr->getContinentList();	
	foreach($continents as $continent) {
		$opt=$dropdown->addOption($continent->id,$continent->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Continent').': '));
	$page->contents->addEntity($dropdown);
	
	$continentform=new html_div();
	$continentform->id="continentFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($continentform);
	
	$page->printHTML();
?>