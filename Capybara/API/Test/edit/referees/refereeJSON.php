<?php
	include_once('../_define.php');

	$id=$_GET['id'];
	
	if(isset($_GET['date']))
		$date=$_GET['date'];
	else
		$date=date('Y-m-d');
		
	$list=$dr->getRefereeList(true,true,$date);
	
	//print $list->getJSON();
	print $list->getJSON();
?>