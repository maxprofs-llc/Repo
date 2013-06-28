<?php
	include_once('_define.php');
	include_once('sportsPage.php');

	$page=new sportsPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectSport';
	$selected=$dropdown->addOption('',$lang->get('Choose sport').'...');
	$dropdown->addOption(-1,$lang->get('New sport'));
	$dropdown->addOption(-99,$lang->get('Get sport from Master database'));
	
	$sports=$dr->getSportList();	
	foreach($sports as $sport) {
		$opt=$dropdown->addOption($sport->id,$sport->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Sport').': '));
	$page->contents->addEntity($dropdown);
	
	$sportform=new html_div();
	$sportform->id="sportFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($sportform);
	
	$page->printHTML();
?>