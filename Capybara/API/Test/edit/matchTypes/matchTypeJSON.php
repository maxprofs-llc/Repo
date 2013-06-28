<?php
	include_once('../_define.php');

	$id=$_GET['id'];
	
	$matchTypes=$dr->getMatchTypeList(true);
	
	print $matchTypes->getJSON();
?>