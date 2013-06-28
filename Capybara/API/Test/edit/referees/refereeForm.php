<?php
	include_once('../_define.php');

	$refno=$_GET['no'];

	if(!$refno)
		$refno=$_GET['no'];
	
	$ref=new person_referee();	
	$form=new form_refereeForm('match','referees',$ref,$refno);
	
	$form->printHTML();

?>