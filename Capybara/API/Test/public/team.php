<?php
	include "../_define.php";

	$id=$_GET['id'];
	
	$team=$dr->getTeamById($id);
	
	$table=new html_table();
	$table->id='teamTable';
	$table->style="color: blue;";

	$table->addEntity(new html_tr('',array(new html_td($lang->get('Name')),new html_td($team->name))));
	$table->addEntity(new html_tr('',array(new html_td($lang->get('Organization')),new html_td($team->getOrganization()->getName()))));
	
	$table->printHTML();
	
?>