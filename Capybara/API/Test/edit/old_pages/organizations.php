<?php
	include_once('_define.php');
	include_once('organizationsPage.php');

	$page=new organizationsPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectOrganization';
	$selected=$dropdown->addOption('',$lang->get('Choose organization').'...');
	$dropdown->addOption(-1,$lang->get('New organization'));
	$dropdown->addOption(-99,$lang->get('Get organization from Master database'));
	
	$organizations=$dr->getOrganizationList();	
	foreach($organizations as $organization) {
		$opt=$dropdown->addOption($organization->id,$organization->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Organization').': '));
	$page->contents->addEntity($dropdown);
	
	$organizationform=new html_div();
	$organizationform->id="organizationFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($organizationform);
	
	$page->printHTML();
?>