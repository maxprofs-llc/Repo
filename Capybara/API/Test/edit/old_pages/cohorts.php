<?php
	include_once('_define.php');
	include_once('cohortsPage.php');

	$page=new cohortsPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectCohort';
	$selected=$dropdown->addOption('',$lang->get('Choose cohort').'...');
	$dropdown->addOption(-1,$lang->get('New cohort'));
	$dropdown->addOption(-99,$lang->get('Get cohort from Master database'));
	
	$cohorts=$dr->getCohortList();	
	foreach($cohorts as $cohort) {
		$opt=$dropdown->addOption($cohort->id,$cohort->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Cohort').': '));
	$page->contents->addEntity($dropdown);
	
	$cohortform=new html_div();
	$cohortform->id="cohortFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($cohortform);
	
	$page->printHTML();
?>