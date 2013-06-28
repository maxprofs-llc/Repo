<?php
	include_once('_define.php');

	include_once('matchesPage.php');

	$page=new matchesPage();

	$match=new html_expandableDiv($lang->get('Match').': ',$lang->get('Match').': ');
	$match->id='readMore';
	$page->contents->addEntity($match);

	$match->addEntity(new html_span($lang->get('Read').': '));
	$year=new html_dropDown();
	$year->id='year';
	for($y=date('Y');$y>=1891;$y--)
	{
		$year->addOption($y,$y);
	}
	$match->addEntity($year);
	$match->addEntity(new html_button($lang->get('Read'),'',"getYearMatches($('year').value)"));
	
	$dropdown=new html_dropDown();
	$dropdown->id='selectMatch';
	$selected=$dropdown->addOption('',$lang->get('Choose match').'...');
	$dropdown->addOption(-1,$lang->get('New match'));
	$dropdown->addOption(-2,$lang->get('New match with').' '.$myTeamName.' '.$lang->get('as home_team'));
	$dropdown->addOption(-3,$lang->get('New match with').' '.$myTeamName.' '.$lang->get('as away_team'));
		
	$matches=$dr->getMatchList(2011);	
	foreach($matches as $match) {
		$opt=$dropdown->addOption($match->id,$match->getName());
	}
	$selected->selected=true;
	
	$matchform=new html_div();
	$matchform->id="matchFormContents";
	
	$page->contents->addEntity($dropdown);
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($matchform);
	$page->printHTML();	
?>