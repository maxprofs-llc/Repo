<?php
	include('../_define.php');

	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/lang.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	
	
	$string=str_replace(' ','_',$_GET['string']);
	$translation=$_GET['translation'];
	
	print $lang->saveToDb($string,$translation);
?>