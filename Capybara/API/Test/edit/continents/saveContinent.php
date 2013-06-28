<?php
	
	include "../_define.php";

	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/continents.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	
	
	$dw=new data_dataWriter($db);
	
	$continentid=$dw->writeGeneric($_POST,'continent');
	
	print $dr->getContinentById($continentid)->getJSON();
	
?>