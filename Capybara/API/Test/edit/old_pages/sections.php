<?php
	include_once('_define.php');
	include_once('sectionsPage.php');

	$page=new sectionsPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectSection';
	$selected=$dropdown->addOption('',$lang->get('Choose section').'...');
	$dropdown->addOption(-1,$lang->get('New section'));
	$dropdown->addOption(-99,$lang->get('Get sections from Master database'));
	
	$sections=$dr->getSectionList();	
	foreach($sections as $section) {
		$opt=$dropdown->addOption($section->id,$section->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Section').': '));
	$page->contents->addEntity($dropdown);
	
	$sectionform=new html_div();
	$sectionform->id="sectionFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($sectionform);
	
	$page->printHTML();
?>