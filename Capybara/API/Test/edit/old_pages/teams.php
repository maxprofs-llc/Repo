<?php
	include_once('_define.php');
	include_once('teamsPage.php');

	$page=new teamsPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectTeam';
	$selected=$dropdown->addOption('',$lang->get('Choose team').'...');
	$dropdown->addOption(-1,$lang->get('New team'));
	$dropdown->addOption(-99,$lang->get('Get team from Master database'));
	
	$teams=$dr->getGenericKeyValueList('team','te','team',false);	
	foreach($teams as $team) {
		$opt=$dropdown->addOption($team->id,$team->_longString);
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Team').': '));
	$page->contents->addEntity($dropdown);
	
	$teamform=new html_div();
	$teamform->id="teamFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($teamform);
	
	$page->printHTML();
?>