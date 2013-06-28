<?php
	include "../_define.php";
	
	$id=$_GET['id'];

	$db->performDelete('fileConnector',$id);
	
	print "ok";
?>