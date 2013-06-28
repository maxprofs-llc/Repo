<?php
	include_once('../_define.php');

	$id=$_GET['id'];
	
	$list=$dr->getEmptyList(true);
	
	print $list->getJSON();
?>