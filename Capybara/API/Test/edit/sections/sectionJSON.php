<?php
	include_once('../_define.php');

	if(isset($_GET['id']))
		$sections=$dr->getGenericById($_GET['id'],'section','se','team_section');
	else
		$sections=$dr->getSectionList(true);
	
	print $sections->getJSON();
?>