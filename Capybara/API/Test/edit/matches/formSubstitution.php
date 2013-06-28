<?php
	include_once('../_define.php');
		
	if(!$playerno)
		$playerno=$_GET['no'];
	$side=$_GET['side'];
	
	$sub=new match_substitution();
	$form=new form_substitutionForm('match'.$side.'Team','match',$sub,$playerno);
	$form->printHTML();
	
	/*
	$form=new form_inlineForm(ucfirst($side).'SubPlayer','player','html_empty');

	$in=new html_autoUpdateDropDown('.match'.$side.'Player','substitute playerin');
	$in->id='match'.$side.'SubIn'.$no;
	$in->addOption(0,$lang->get('None'));
	$in->addOption('',$lang->get('Unknown_player'));
	$out=new html_autoUpdateDropDown('.match'.$side.'Player','substitute playerout');
	$out->id='match'.$side.'SubOut'.$no;
	$out->addOption(0,$lang->get('None'));
	$out->addOption('',$lang->get('Unknown_player'));
	$time=new html_text('','substitute time');
	$time->id='match'.$side.'SubTime'.$no;
	
	$form->content->addEntity(new html_td(''));
	$form->content->addEntity(new html_td(''));
	$form->content->addEntity(new html_td($in));
	$form->content->addEntity(new html_td($out));
	$form->content->addEntity(new html_td($time));
	$form->content->addEntity(new html_td(new html_a($lang->get('Delete'),"javascript:delete".$side."Sub($no)",'delete')));
	
	$form->printHTML();
	*/
?>
	