<?php
	include_once('../_define.php');

	if(isset($_GET['id']))
		$organizationTypes=$dr->getGenericById($_GET['id'],'organizationType','ot','organizationType');
	else
		$organizationTypes=$dr->getOrganizationTypeList(true);
	
	print $organizationTypes->getJSON();
?>