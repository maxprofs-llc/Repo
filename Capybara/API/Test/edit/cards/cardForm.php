<?php
	include_once('../_define.php');

	$teamid=$_GET['teamid'];
	$c=$_GET['cardnr'];
	$prefix=$_GET['prefix'];
	
	$form=new form_inlineForm('Card','cards','html_table');
	$form->fixSearchBoxes=true;
	
	//$players=$dr->getPersonList(true,true,$teamid);
	$p=person_person::getUnknown();
	
	$tr=new html_tr('card');
	$label=new html_td(array(new html_span($lang->get('Card').'<br/>'),new html_a($lang->get('Delete card'),'javascript:deleteCard("'.$prefix.'",'.$c.')','delete')));
	$tr->addEntity($label);
	
	$goal=new html_td();
	
	$table=new html_table();
	$table->id=$prefix.'Card'.$c;

	//-
	$types=$dr->getGenericList('cardType','ct','cardType');
	
	$type=new html_searchBox();
	$type->cssClass='cardType';
	$type->id=$prefix.'CardType'.$c;
	$type->list=$types;
	//$scorer->list=$players;
	$type->chosenValue='';
	$type->chosenId='';
	$type->addText='+';
	$type->addFunction='addCardType(this.getParent());';
		
	/*
	$player=new html_searchBox();
	$player->cssClass='cardPlayer';
	$player->id=$prefix.'CardPlayer'.$c;
	$player->listURL='players/playerJSON.php?teamid='.$teamid;
	//$scorer->list=$players;
	$player->chosenValue=$p->getName();
	$player->chosenId=$p->id;
	$player->addText='+';
	$player->addFunction='addPlayer(this.getParent());';
*/
	$player=new html_autoUpdateDropDown('.'.$prefix.'Player','card player');
	$player->id=$prefix.'CardPlayer'.$c;
	$player->addOption('',$lang->get('Unknown_person'));
	
	$time=new html_text();
	$time->id=$prefix.'CardTime'.$c;

	$period=new html_searchBox();
	$period->cssClass='period';
	$period->id=$prefix.'CardPeriod'.$c;
	$period->listURL="periods/periodJSON.php";
	$period->chosenValue='';
	$period->chosenId='';
	$period->addText='+';
	$period->addFunction='addPeriod(this.getParent());';
			
	$comment=new html_multiText();
	$comment->id=$prefix.'CardComment'.$c;
	$comment->defaultLabel=$lang->getLanguage();
	foreach($languages as $code => $langId) {
		$comment->addTextInput($code,'');
	}
	
	$table->addEntity(new html_tr('',array($lang->get('Type').':',$type)));
	$table->addEntity(new html_tr('',array($lang->get('Player').':',$player)));
	$table->addEntity(new html_tr('',array($lang->get('Game_time').':',$time)));
	$table->addEntity(new html_tr('',array($lang->get('Period').':',$period)));
	$table->addEntity(new html_tr('',array($lang->get('Public comments').':',$comment)));
	
	$goal->addEntity($table);
	$tr->addEntity($goal);
	$form->content->addEntity($tr);

	$form->printHTML();
?>