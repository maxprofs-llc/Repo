<?php
	include "../_define.php";

	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/persons.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	
	
	$dw=new data_dataWriter($db);
	
	$personid=$dw->writeGeneric($_POST,'person');	
	if($personid==-1) {
		$obj->status='error';
		$obj->statusMsg=$lang->get('Not_logged_in');
		die(json_encode($obj));
	}
	$dr=new data_dataReader($db,$lang);	
	
	/*
	foreach($_POST['roles'] as $role) {
		$role['personId']=$personid;
		$dw->writeGeneric($role,'personRole');
	}
	*/
	$obj=$dr->getPersonById($personid);
	$obj->status='ok';
	$obj->statusMsg=$lang->get('Person was saved');
	print $obj->getJSON();
	
?>