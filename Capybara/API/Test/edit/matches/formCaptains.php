<?php
	include_once('../_define.php');

	$side=$_GET['side'];
	$no=$_GET['no'];
	
	$form=new form_inlineForm(ucfirst($side).'Captain','player','html_empty');

	$player=new html_autoUpdateDropDown('.match'.$side.'TeamPlayer','captain player');
	$player->id='match'.$side.'Captain'.$no;
	$player->addOption(0,$lang->get('None'));
	$player->addOption('',$lang->get('Unknown_player'));

	$entire=new html_checkbox();
	$entire->id='match'.$side.'CaptainEntireGame'.$no;
	$entire->checked=true;
	
	$starttime=new html_text('','captain time');
	$starttime->id='match'.$side.'CaptainStartTime'.$no;
	
	$endtime=new html_text('','captain time');
	$endtime->id='match'.$side.'CaptainEndTime'.$no;
	
	$form->content->addEntity(new html_td(''));
	$form->content->addEntity(new html_td(''));
	$form->content->addEntity(new html_td($player));
	$form->content->addEntity(new html_td($entire));
	$form->content->addEntity(new html_td($starttime));
	$form->content->addEntity(new html_td($endtime));
	$form->content->addEntity(new html_td(new html_a($lang->get('Delete'),"javascript:delete".$side."Captain($no)",'delete')));
	
	$form->printHTML();
?>
	