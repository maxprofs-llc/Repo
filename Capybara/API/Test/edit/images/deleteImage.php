<?php
	include "../_define.php";

	$id=$_GET['id'];
	
	$db->performDelete('fileConnector',false,array("fileId=$id"));
	$db->performDelete('file',$id);
	print "ok";
?>