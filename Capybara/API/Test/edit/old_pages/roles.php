<?php
	include_once('_define.php');

	include_once('rolesPage.php');

	$page=new rolesPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectRole';
	$selected=$dropdown->addOption('',$lang->get('Choose role').'...');
	$dropdown->addOption(-1,$lang->get('New role'));
	$dropdown->addOption(-99,$lang->get('Get role from Master database'));
	
	$roles=$dr->getRoleList();	
	foreach($roles as $role) {
		$opt=$dropdown->addOption($role->id,$role->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Role').': '));
	$page->contents->addEntity($dropdown);
	
	$roleform=new html_div();
	$roleform->id="roleFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($roleform);
	
	$page->printHTML();
	
?>