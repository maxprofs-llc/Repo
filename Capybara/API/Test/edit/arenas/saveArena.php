<?php
	include "../_define.php";

	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/arenas.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	

	$dw=new data_dataWriter($db);
	
	$arenaid=$dw->writeGeneric($_POST,'arena');	
	
	print $dr->getArenaById($arenaid)->getJSON();
	
?>