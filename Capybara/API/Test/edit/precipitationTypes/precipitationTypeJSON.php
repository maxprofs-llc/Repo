<?php
	include_once('../_define.php');

	$id=$_GET['id'];
	
	if(isset($_GET['id'])) 
		$out=$dr->getPrecipitationTypeById($id);
	else
		$out=$dr->getPrecipitationTypeList(true,true);
	print $out->getJSON();
?>