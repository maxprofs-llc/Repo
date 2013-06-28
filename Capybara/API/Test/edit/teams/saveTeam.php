<?php
	
	include "../_define.php";
	
	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/teams.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	
	
	$dw=new data_dataWriter($db);
	
	$id=$dw->writeGeneric($_POST,'team');

	$team=$dr->getTeamById($id);
			
	print $team->getJSON();
	
?>