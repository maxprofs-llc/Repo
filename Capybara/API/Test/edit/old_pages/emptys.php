<?php
	include_once('_define.php');
	include_once('emptysPage.php');

	$page=new emptysPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectEmpty';
	$selected=$dropdown->addOption('',$lang->get('Choose empty').'...');
	$dropdown->addOption(-1,$lang->get('New empty'));
	
	$emptys=$dr->getEmptyList();	
	foreach($emptys as $empty) {
		$opt=$dropdown->addOption($empty->id,$empty->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Empty').': '));
	$page->contents->addEntity($dropdown);
	
	$emptyform=new html_div();
	$emptyform->id="emptyFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($emptyform);
	
	$page->printHTML();
?>