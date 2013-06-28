<?php
	include_once('_define.php');
	include_once('organizationTypesPage.php');

	$page=new organizationTypesPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectOrganizationType';
	$selected=$dropdown->addOption('',$lang->get('Choose organization_type').'...');
	$dropdown->addOption(-1,$lang->get('New organization_type'));
	$dropdown->addOption(-99,$lang->get('Get organization_type from Master database'));
	
	$organizationTypes=$dr->getOrganizationTypeList();	
	foreach($organizationTypes as $organizationType) {
		$opt=$dropdown->addOption($organizationType->id,$organizationType->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Organization_type').': '));
	$page->contents->addEntity($dropdown);
	
	$organizationTypeform=new html_div();
	$organizationTypeform->id="organizationTypeFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($organizationTypeform);
	
	$page->printHTML();
?>