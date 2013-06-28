<?php
	include_once('_define.php');
	include_once('periodTypesPage.php');

	$page=new periodTypesPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectPeriodType';
	$selected=$dropdown->addOption('',$lang->get('Choose period_type').'...');
	$dropdown->addOption(-1,$lang->get('New period_type'));
	
	$periodTypes=$dr->getGenericList('periodType','pt','match_periodType',false);	
	foreach($periodTypes as $periodType) {
		$opt=$dropdown->addOption($periodType->id,$periodType->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Period_type').': '));
	$page->contents->addEntity($dropdown);
	
	$periodTypeForm=new html_div();
	$periodTypeForm->id="periodTypeFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($periodTypeForm);
	
	$page->printHTML();
?>