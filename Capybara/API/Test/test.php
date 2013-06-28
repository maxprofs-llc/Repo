<?php 
	include "_define.php";

	$dr=new data_dataReader($db, $lang);
	$match=$dr->getMatchById(17);
	
	die($match->getMe()->getWarnings()->getJSON());
	
?>