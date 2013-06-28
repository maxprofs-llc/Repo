<?php
	
	include "../_define.php";
	
	$dw=new data_dataWriter($db);
	
	$id=$dw->writeGeneric($_POST,'matchType');

	$matchtype=$dr->getMatchTypeById($id);
			
	print $matchtype->getJSON();
	
?>