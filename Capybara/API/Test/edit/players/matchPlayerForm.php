<?php
	include_once('../_define.php');

	if(!$playerno)
		$playerno=$_GET['no'];
	$side=$_GET['side'];

	$player=new person_player();
	$form=new form_matchPlayerForm('match'.$side.'Team','players',$player,$playerno);

	$form->printHTML();
?>