<?php
	
	include "../_define.php";
	
	$dw=new data_dataWriter($db);
	
	$id=$dw->writeGeneric($_POST,'empty');

	$empty=$dr->getEmptyById($id);
			
	print $empty->getJSON();
	
?>