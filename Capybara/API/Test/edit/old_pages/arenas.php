<?php
	include_once('_define.php');

	include_once('arenasPage.php');

	$page=new arenasPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectArena';
	$selected=$dropdown->addOption('',$lang->get('Choose arena').'...');
	$dropdown->addOption(-1,$lang->get('New arena'));
	$dropdown->addOption(-99,$lang->get('Get arena from Master database'));
	
	$arenas=$dr->getArenaList();	
	foreach($arenas as $arena) {
		$opt=$dropdown->addOption($arena->id,$arena->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Arena').': '));
	$page->contents->addEntity($dropdown);
	
	$arenaform=new html_div();
	$arenaform->id="arenaFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($arenaform);
	
	$page->printHTML();
	
?>