<?php
	include_once('_define.php');

	include_once('personsPage.php');

	$page=new personsPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectPerson';
	$selected=$dropdown->addOption('',$lang->get('Choose person').'...');
	$dropdown->addOption(-1,$lang->get('New person'));
	$dropdown->addOption(-2,$lang->get('New person in').' '.$myTeamName);
	$dropdown->addOption(-99,$lang->get('Get person from Master database'));
	
	$persons=$dr->getGenericKeyValueList('person','pe','person_person');	
	foreach($persons as $person) {
		$opt=$dropdown->addOption($person->id,$person->_string);
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Person').': '));
	$page->contents->addEntity($dropdown);
	
	$personform=new html_div();
	$personform->id="personFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($personform);
	
	$page->printHTML();
	
?>