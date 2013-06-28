<?php
	include_once('_define.php');
	include_once('usersPage.php');

	$db = new data_readOnlyDatabase();
	$db->selectDB($conf->get('db_security_database'));
	$dr=new data_dataReader($db,$lang);
	
	$page=new usersPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectUser';
	$selected=$dropdown->addOption('',$lang->get('Choose user').'...');
	$dropdown->addOption(-1,$lang->get('New user'));
	$dropdown->addOption(-2,$lang->get('New administrator'));
	$dropdown->addOption(-3,$lang->get('New super_user'));
	
	$users=$dr->getUserKeyValueList();	
	foreach($users as $user) {
		$opt=$dropdown->addOption($user->id,$user->_name);
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('User').': '));
	$page->contents->addEntity($dropdown);
	
	$userform=new html_div();
	$userform->id="userFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($userform);
	
	$page->printHTML();
?>