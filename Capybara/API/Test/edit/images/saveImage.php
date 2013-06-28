<?php
	include "../_define.php";

	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/images.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	
	
	$dw=new data_dataWriter($db);
	
	$table=$_GET['table'];
	$rowId=$_GET['rowId'];
	$imageId=$_GET['imageId'];
	
	$id=$dw->writeGeneric(array('tableRowId'=>$rowId,'tableName'=>$table,'fileId'=>$imageId),'fileConnector');
	
	print json_encode(array("id"=>$id));
?>