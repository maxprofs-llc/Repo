<?php
	include_once('../_define.php');
	
	$sess->checkUrl(false,$_SESSION['basedir'].'/users.php',true);
	
	$db = new data_securityDatabase();
	$db->selectDB($conf->get('db_security_database'));
	$dr=new data_dataReader($db,$lang);
	
	$userid=$_GET['id'];
	
	if($userid>0)
		$user=$dr->getUserById($userid);
	else {
		$user=new user_user();
		$user->id=-1;
	}
	
	$form=new form_standardForm('user','users');
	$form->dataReader=$dr;
	
	if(!is_null($user->id)) {
		$form->headline=$user->getName();
	}
	else
		$form->headline=$lang->get('New user');
	
	//Info
	
	$userinfo=$form->addExpandableArea('Info','user_info','User_information');
		
	$form->addTextField('Firstname','First_name',$user->firstname);
	$form->addTextField('Lastname','Last_name',$user->lastname);
	$form->addTextField('Email','Email',$user->email);
	$form->addTextField('Phone','Phone number',$user->phone);
	$form->addLongTextField('PrivateComment','Internal comments',$user->privateComment);
	$form->addLangField('PublicComment','Public comments',$user->strings,'publicComment');
	
	if($userid!=$sess->getLoggedInUserId()) {
		$priviliges=$form->addExpandableArea('UserPrivileges','user_privileges','User_privileges');
		$buttons=new html_table();
		$buttons->addEntity(new html_tr('',array(new html_button($lang->get('Add privilege'),'',"addPrivilege('Grant')"))));
		$buttons->addEntity(new html_tr('',array(new html_button($lang->get('Remove privilege'),'',"removePrivilege('Grant')"))));
		/*
		$buttons->addEntity(new html_tr('',array(new html_button($lang->get('Create admin'),'','CreateAdmin()'))));
		$buttons->addEntity(new html_tr('',array(new html_button($lang->get('Create team admin'),'','CreateTeamAdmin()'))));
		$buttons->addEntity(new html_tr('',array(new html_button($lang->get('Create user'),'','CreateUser()'))));
		$buttons->addEntity(new html_tr('',array(new html_button($lang->get('Create team user'),'','CreateTeamUser()'))));
		*/
		$form->addHeadline('Grant access');
		$list=$form->addList('GrantPrivileges',$buttons);
		foreach($user->privileges as $priv) {
			if($priv->privileges)
				$list->addOption($priv->scope,$priv->scope);
		}
	
		$buttons=new html_table();
		$buttons->addEntity(new html_tr('',array(new html_button($lang->get('Add privilege'),'',"addPrivilege('Deny')"))));
		$buttons->addEntity(new html_tr('',array(new html_button($lang->get('Remove privilege'),'',"removePrivilege('Deny')"))));
		$form->addHeadline('Deny access');
		$list=$form->addList('DenyPrivileges',$buttons);
		foreach($user->privileges as $priv) {
			if(!$priv->privileges)
				$list->addOption($priv->scope,$priv->scope);
		}
		$configs=array_merge(array(''=>''),$conf->availableFiles());
		$preferences=$form->addExpandableArea('Preferences','preferences','Preferences');
		$form->addDropdownField('ConfigFile','Configuration_file',$configs,$user->configFile);
	}
	
	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveUser';
					
	$form->printHTML();
	
	//helper::debugPrint(json_encode($user),'user');
?>