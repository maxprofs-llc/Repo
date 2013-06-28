<?php
	
	include "../_define.php";

	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/genders.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	
	
	$dw=new data_dataWriter($db);
	
	$genderid=$dw->writeGeneric($_POST,'gender');

	$gender=$dr->getGenderById($genderid);
			
	print $gender->getJSON();
	
?>