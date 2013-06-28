<?php
	include_once('../_define.php');
	
	if(isset($_GET['id']))
		$list=$dr->getGenericById($_GET['id'],'organization','org','organization');
	else
		$list=$dr->getGenericKeyValueList('organization','org','organization',true,true);
	
	print $list->getJSON();
?>