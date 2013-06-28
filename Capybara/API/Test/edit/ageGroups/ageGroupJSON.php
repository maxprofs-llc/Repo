<?php
	include_once('../_define.php');

	$id=$_GET['id'];
	
	if(isset($_GET['id']))
		$list=$dr->getGenericById($_GET['id'],'ageGroup','ag','team_ageGroup');
	else
		$list=$dr->getAgeGroupList(true,true);
	
	print $list->getJSON();
?>