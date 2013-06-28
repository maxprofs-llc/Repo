<?php
	
	include "../_define.php";

	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/cohorts.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	
	
	$dw=new data_dataWriter($db);
	
	$id=$dw->writeGeneric($_POST,'cohort');

	$cohort=$dr->getCohortById($id);
			
	print $cohort->getJSON();
	
?>