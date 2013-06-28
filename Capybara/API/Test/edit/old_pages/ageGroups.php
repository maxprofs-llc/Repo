<?php
	include_once('_define.php');
	include_once('ageGroupsPage.php');

	$page=new ageGroupsPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectAgeGroup';
	$selected=$dropdown->addOption('',$lang->get('Choose age_group').'...');
	$dropdown->addOption(-1,$lang->get('New age_group'));
	$dropdown->addOption(-99,$lang->get('Get age_group from Master database'));
	
	$ageGroups=$dr->getAgeGroupList();	
	foreach($ageGroups as $ageGroup) {
		$opt=$dropdown->addOption($ageGroup->id,$ageGroup->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Age_group').': '));
	$page->contents->addEntity($dropdown);
	
	$ageGroupform=new html_div();
	$ageGroupform->id="ageGroupFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($ageGroupform);
	
	$page->printHTML();
?>