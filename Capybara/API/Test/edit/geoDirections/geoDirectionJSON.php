<?php
	include_once('../_define.php');

	$id=$_GET['id'];
	
	if(isset($_GET['id']))
		$out=$dr->getGeoDirectionById($id);
	else
		$out=$dr->getGeoDirectionList(true);
	print $out->getJSON();
?>