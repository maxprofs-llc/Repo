<?php
	include_once('../_define.php');
	
	if(!isset($_GET['id']))	
		$list=$dr->getGenericKeyValueList('team','te','team',true);
	else
		$list=$dr->getGenericById($_GET['id'],'team','te','team');
	print $list->getJSON();
?>