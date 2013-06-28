<?php
	include_once('_define.php');
	include_once('gendersPage.php');

	$page=new gendersPage();

	$dropdown=new html_dropDown();
	$dropdown->id='selectGender';
	$selected=$dropdown->addOption('',$lang->get('Choose gender').'...');
	$dropdown->addOption(-1,$lang->get('New gender'));
	$dropdown->addOption(-99,$lang->get('Get gender from Master database'));
	
	$genders=$dr->getGenderList();	
	foreach($genders as $gender) {
		$opt=$dropdown->addOption($gender->id,$gender->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get('Gender').': '));
	$page->contents->addEntity($dropdown);
	
	$genderform=new html_div();
	$genderform->id="genderFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($genderform);
	
	$page->printHTML();
?>