<?php
	
	include "../_define.php";

	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/ageGroups.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}
	$dw=new data_dataWriter($db);
	
	$id=$dw->writeGeneric($_POST,'ageGroup');
	if(id==-1) {
		$obj->status='error';
		$obj->statusMsg=$lang->get('Not_logged_in');
		die(json_encode($obj));
	}
	$ageGroup=$dr->getAgeGroupById($id);
			
	print $ageGroup->getJSON();
	
?>