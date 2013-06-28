<?php
	
	include "../_define.php";
	
	$dw=new data_dataWriter($db);
	
	$id=$dw->writeGeneric($_POST,'cardType');

	$dir=$dr->getGenericById($id,'cardType','ct','cardType');
			
	print $dir->getJSON();
	
?>