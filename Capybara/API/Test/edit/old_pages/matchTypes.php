<?php
	include_once('_define.php');
	include_once('matchTypesPage.php');

	$page=new matchTypesPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectMatchType';
	$selected=$dropdown->addOption('',$lang->get('Choose match_type').'...');
	$dropdown->addOption(-1,$lang->get('New match_type'));
	
	$matchTypes=$dr->getMatchTypeList();	
	foreach($matchTypes as $matchType) {
		$opt=$dropdown->addOption($matchType->id,$matchType->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Match_type').': '));
	$page->contents->addEntity($dropdown);
	
	$matchTypeform=new html_div();
	$matchTypeform->id="matchTypeFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($matchTypeform);
	
	$page->printHTML();
?>