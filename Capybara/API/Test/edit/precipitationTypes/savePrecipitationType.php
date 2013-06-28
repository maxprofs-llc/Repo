<?php
	
	include "../_define.php";
	
	$dw=new data_dataWriter($db);
	
	$id=$dw->writeGeneric($_POST,'precipitationType');

	$dir=$dr->getPrecipitationTypeById($id);
			
	print $dir->getJSON();
	
?>