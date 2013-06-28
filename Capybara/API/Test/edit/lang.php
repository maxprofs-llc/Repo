<?php
	include_once('_define.php');

	include_once('langPage.php');

	$page=new langPage();
	
	$dropdown=new html_dropDown();
	$dropdown->id='selectLanguage';
	$selected=$dropdown->addOption('',$lang->get('Choose language').'...');
	//$dropdown->addOption(-1,$lang->get('New language'));
	
	foreach($languages as $code=>$langId) {
		$dropdown->addOption($langId,$code);
	}
	$page->contents->addEntity($dropdown);
	
	$langform=new html_div();
	$langform->id="langFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($langform);

	$page->printHTML();

?>