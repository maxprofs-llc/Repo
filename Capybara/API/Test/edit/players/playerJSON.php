<?php
	include_once('../_define.php');

	$id=$_GET['id'];
	if(isset($_GET['teamid']))
		$teamid=$_GET['teamid'];
	else
		$teamid=1;
	
	if(isset($_GET['date']))
		$date=$_GET['date'];
	else
		$date=date('Y-m-d');
		
	$list=$dr->getPlayerList(true,true,$teamid,$date);
	
	//print $list->getJSON();
	print $list->getJSON();
?>