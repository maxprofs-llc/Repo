<?php
	include_once('../_define.php');

	$id=$_GET['id'];
	
	$list=$dr->getGenericList('cardType','ct','cardType');
	print $list->getJSON();
?>