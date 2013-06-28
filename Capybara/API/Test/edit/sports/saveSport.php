<?php
	
	include "../_define.php";
	
	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/sports.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	
	
	$dw=new data_dataWriter($db);
	
	$sportid=$dw->writeGeneric($_POST,'sport');

	$sport=$dr->getSportById($sportid);
			
	print $sport->getJSON();
	
?>