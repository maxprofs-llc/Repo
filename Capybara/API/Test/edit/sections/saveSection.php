<?php
	
	include "../_define.php";
	
	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/sections.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	
	
	$dw=new data_dataWriter($db);
	
	$sectionid=$dw->writeGeneric($_POST,'section');

	$section=$dr->getSectionById($sectionid);
			
	print $section->getJSON();
	
?>