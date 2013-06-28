<?php
	
	include "../_define.php";
	
	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/states.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	
	
	$dw=new data_dataWriter($db);
	
	$stateid=$dw->writeGeneric($_POST,'state');

	$state=$dr->getStateById($stateid);
	
	if(!is_null($state->getCapitalCity()->id))
		$dw->writeGeneric(array('id'=>$state->getCapitalCity()->id,'stateId'=>$state->id),'city');
		
	print $state->getJSON();
	
?>