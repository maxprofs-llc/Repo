<?php
	include_once('../_define.php');

	$id=$_GET['id'];
	
	if(isset($_GET['id']))
		$out=$dr->getGenericById($id,'periodType','pt','match_periodType');
	else
		$out=$dr->getGenericList('periodType','pt','match_periodType',true);
	print $out->getJSON();
?>