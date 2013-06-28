<?php
	include_once('../_define.php');

	if(isset($_GET['id']))
		$genders=$dr->getGenericById($_GET['id'],'gender','ge','gender');
	else
		$genders=$dr->getGenderList(true);
	
	print $genders->getJSON();
?>