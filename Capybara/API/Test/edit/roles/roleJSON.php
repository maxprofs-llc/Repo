<?php
	include_once('../_define.php');

	if(isset($_GET['countryid']))
		$cid=$_GET['countryid'];
	else
		$cid=false;
			
	if(isset($_GET['stateid']))
		$sid=$_GET['stateid'];
	else
		$sid=false;
		
	if(isset($_GET['id']))
		$list=$dr->getGenericById($_GET['id'],'role','ro','person_role');
	else
		$list=$dr->getRoleList(true,$cid,$sid);

	print $list->getJSON();
?>