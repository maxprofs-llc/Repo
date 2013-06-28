<?php
	include_once('../_define.php');

	$id=$_GET['id'];
	
	if(isset($_GET['id']))
		$states=$dr->getGenericById($_GET['id'],'state','st','location_state');
	else
		$states=$dr->getStateList(true);
	
	print $states->getJSON();
?>