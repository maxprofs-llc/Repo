<?php
	include_once('../_define.php');

	$side=$_GET['side'];
	$no=$_GET['no'];
	
	$form=new form_inlineForm(ucfirst($side).'MoM','player','html_empty');

	$player=new html_autoUpdateDropDown('.match'.$side.'TeamPlayer','captain player');
	$player->id='match'.$side.'MoM'.$no;
	$player->addOption(0,$lang->get('None'));
	$player->addOption('',$lang->get('Unknown_player'));
	
	$org=new html_searchBox();
	$org->cssClass='mom organization';
	$org->id='match'.$side.'MoMOrganization'.$no;
	$org->chosenId='';
	$org->chosenValue=$lang->get('Unknown_organization');
	$org->listURL='organizations/organizationJSON.php';
	$org->addText='+';
	$org->addFunction='addOrganization(this.getParent());';
	$org->findFunction='addOrganization($("match'.$side.'MoMOrganization'.$no.'"),-99);';
	$org->showAddButton=true;
		
	$form->content->addEntity(new html_td(''));
	$form->content->addEntity(new html_td(''));
	$form->content->addEntity(new html_td($player));
	$form->content->addEntity(new html_td($org));
	$form->content->addEntity(new html_td(new html_a($lang->get('Delete'),"javascript:delete".$side."MoM($no)",'delete')));
	
	$form->printHTML();
?>
	