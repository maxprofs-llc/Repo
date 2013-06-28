<?php
	include_once('../_define.php');

	if(isset($_GET['id']))
		$countries=$dr->getGenericById($_GET['id'],'country','co','location_country');
	else
		$countries=$dr->getCountryList(true);
	
	print $countries->getJSON();
?>