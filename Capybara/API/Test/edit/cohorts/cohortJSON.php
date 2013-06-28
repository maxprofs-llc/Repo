<?php
	include_once('../_define.php');

	if(isset($_GET['id']))
		$list=$dr->getGenericById($_GET['id'],'cohort','ch','team_cohort');
	else
		$list=$dr->getCohortList(true,true);
	
	print $list->getJSON();
?>