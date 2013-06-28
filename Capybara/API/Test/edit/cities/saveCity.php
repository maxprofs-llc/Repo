<?php
	include "../_define.php";
	
	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/cities.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}
	
	$dw=new data_dataWriter($db);
	
	$cityid=$dw->writeGeneric($_POST,'city');	
	$dr=new data_dataReader($db,$lang);	
	
	$obj=$dr->getCityById($cityid);
	$obj->status='ok';
	$obj->statusMsg=$lang->get('City was saved');
	print $obj->getJSON();
	
?>