<?php
	include_once('../_define.php');

	if(!$periodno)
		$periodno=$_GET['no'];
	$side=$_GET['side'];

	$period=new match_period();
	
	$form=new form_periodForm('match','periods',$period,$periodno);
	
	$form->printHTML();
	
	/*
	$form=new form_inlineForm(ucfirst($side).'Period','periods','html_empty');
	$form->fixSearchBoxes=true;
		
	$type=new html_searchBox();
	$type->cssClass='matchPeriodType';
	$type->id='matchPeriodType'.$periodno;
	$type->list=$dr->getGenericList('periodType','pt','match_periodType');
	//$scorer->list=$periods;
	$type->chosenValue=$period->getName();
	$type->chosenId=$period->id;
	$type->addText='+';
	$type->addFunction='addPeriodType(this.getParent());';

	$normal=new html_time('','time');
	$normal->id='matchPeriodTime'.$periodno;
		
	//$extra=new html_text('','extraTime');
	//$extra->id='matchPeriodExtraTime'.$periodno;
	
	$kickoff=new html_autoUpdateDropDown('.matchTeam','kickoff');
	$kickoff->id='matchPeriodKickOff'.$periodno;
	$kickoff->addOption('',$lang->get('Unknown_team'));
	
	$direction=new html_searchBox();
	$direction->cssClass='matchPeriodDirection';
	$direction->id='matchPeriodDirection'.$periodno;
	$direction->list=$dr->getGeoDirectionList(true);
	//$scorer->list=$periods;
	$direction->chosenValue='';
	$direction->chosenId='';
	$direction->addText='+';
	$direction->addFunction='addGeoDirection(this.getParent());';
		
	$form->content->cssClass='period';
	$form->content->addEntity(new html_td(''));
	$form->content->addEntity(new html_td(''));
	$form->content->addEntity(new html_td($type));
	$form->content->addEntity(new html_td($normal));
	$form->content->addEntity(new html_td($kickoff));
	$form->content->addEntity(new html_td($direction));
	$form->content->addEntity(new html_td(new html_a($lang->get('Delete'),"javascript:deleteMatchPeriod($periodno)",'delete')));
	
	$form->printHTML();
*/
?>