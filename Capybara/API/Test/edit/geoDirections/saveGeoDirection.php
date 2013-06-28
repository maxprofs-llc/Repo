<?php
	
	include "../_define.php";
	
	$dw=new data_dataWriter($db);
	
	$id=$dw->writeGeneric($_POST,'geoDirection');

	$dir=$dr->getGeoDirectionById($id);
			
	print $dir->getJSON();
	
?>