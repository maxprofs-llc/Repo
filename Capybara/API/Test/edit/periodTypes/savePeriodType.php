<?php
	
	include "../_define.php";
	
	$dw=new data_dataWriter($db);
	
	$id=$dw->writeGeneric($_POST,'periodType');

	$dir=$dr->getGenericById($id,'periodType','pt','match_periodType');
			
	print $dir->getJSON();
	
?>