<?php
	include_once('../_define.php');

	if(isset($_GET['id']))
		$sports=$dr->getGenericById($_GET['id'],'sport','sp','sport');
	else
		$sports=$dr->getSportList(true);
	
	print $sports->getJSON();
?>