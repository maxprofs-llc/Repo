<?php
	include_once('_define.php');
	include_once('cardTypesPage.php');

	$page=new cardTypesPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectCardType';
	$selected=$dropdown->addOption('',$lang->get('Choose card_type').'...');
	$dropdown->addOption(-1,$lang->get('New card_type'));
	
	$cardTypes=$dr->getGenericList('cardType','ct','cardType');	
	foreach($cardTypes as $cardType) {
		$opt=$dropdown->addOption($cardType->id,$cardType->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Card_type').': '));
	$page->contents->addEntity($dropdown);
	
	$cardTypeForm=new html_div();
	$cardTypeForm->id="cardTypeFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($cardTypeForm);
	
	$page->printHTML();
?>