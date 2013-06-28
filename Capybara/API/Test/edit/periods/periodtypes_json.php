<?php
	include_once('../../var_definition.php');
	include_once($VAR_inc_path . 'classes/all_classes.php');
	include_once($VAR_inc_path . 'Class_Database.php');
	include_once($VAR_inc_path . 'Class_Simple_stats.php');

	$db = new stats ('read_only');
	$db->select_db('aik_fotboll_stats');

	$dr=new dataReader($db);

	$types=$dr->getPeriodTypeList();
	
	print json_encode($types);
?>