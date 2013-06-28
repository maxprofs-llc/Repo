<?php
	include_once('../_define.php');

	$prefix=$_GET['prefix'];
	$r=$_GET['no'];
	
	$role=new person_personRole();
		
	$form=new form_inlineForm('Role','role','html_empty');
	
	$id=new html_hidden($role->id,'person'.$prefix.'RoleId'.$r);
	
	$startDate=new html_text($role->startDate,'dateField');
	$startDate->id='person'.$prefix.'RoleStartDate'.$r;

	$endDate=new html_text($role->endDate,'dateField');
	$endDate->id='person'.$prefix.'RoleEndDate'.$r;

	$team=new html_searchBox();
	$team->id='personRole'.$prefix.$r;
	$team->listURL='teams/teamJSON.php';
	$team->chosenId=$role->getTeam()->id;
	$team->chosenValue=$role->getTeam()->getName();
	$team->addText='+';
	$team->addFunction='addTeam(this.getParent())';
	$team->findFunction='addTeam($("'.$team->id.'"),-99)';
	
	if($prefix=='Team') {
		$nr=new html_text('','shirtNumber');
		$nr->id='personRoleShirtNumber'.$r;
	}

	$rolesb=new html_searchBox();
	$rolesb->id='person'.$prefix.'Role'.$r;
	$rolesb->listURL='roles/roleJSON.php';
	$rolesb->list=$dr->getRoleList(true);
	$rolesb->chosenId=$role->roleId;
	$rolesb->chosenValue=$role->getName();
	$rolesb->addText='+';
	$rolesb->addFunction='addRole(this.getParent())';
	$rolesb->findFunction='addRole($("'.$rolesb->id.'"),-99)';
	
	$primary=new html_checkbox();
	$primary->checked=$role->isPrimary;
	$primary->id='person'.$prefix.'PrimaryRole'.$r;
	
	$note=new html_editNote('','&nbsp;');
	$note->id='person'.$prefix.'RoleNote'.$r;
	
	if($prefix=='Team') 
		$cells=array($id,$startDate,$endDate,$team,$nr,$rolesb,$primary,$note);
	else
		$cells=array($id,$startDate,$endDate,$team,$rolesb,$primary,$note);
	$row=new html_dataGridRow();
	foreach($cells as $cellContents) {
		$cell=new html_dataGridCell($cellContents);
		$row->addCell($cell);
	}

	print $row->headerCell->printHTML();
	foreach($row->cells as $cell) {
		$cell->contents->printHTML();
	}
?>