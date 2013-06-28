<?php
	include_once('_define.php');
	include_once('statesPage.php');

	$page=new statesPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectState';
	$selected=$dropdown->addOption('',$lang->get('Choose state').'...');
	$dropdown->addOption(-1,$lang->get('New state'));
	$dropdown->addOption(-99,$lang->get('Get state from Master database'));
	
	$states=$dr->getStateList();	
	foreach($states as $state) {
		$opt=$dropdown->addOption($state->id,$state->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('State').': '));
	$page->contents->addEntity($dropdown);
	
	$stateform=new html_div();
	$stateform->id="stateFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($stateform);
	
	$page->printHTML();
?>