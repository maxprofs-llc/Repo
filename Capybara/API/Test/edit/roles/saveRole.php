<?php
	include "../_define.php";

	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/roles.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	
	
	$dw=new data_dataWriter($db);
	
	$id=$dw->writeGeneric($_POST,'role');	
	
	$obj=$dr->getRoleById($id);
	$obj->status='ok';
	$obj->statusMsg=$lang->get('Role was saved');
	print $obj->getJSON();
	
?>