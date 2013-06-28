<?php
	include_once('../_define.php');

	if(isset($_GET['id']))
		$conts=$dr->getGenericById($_GET['id'],'continent','cn','location_continent');
	else
		$conts=$dr->getContinentList(true);
	
	print $conts->getJSON();
?>