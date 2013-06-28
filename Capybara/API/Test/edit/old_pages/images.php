<?php
	include_once('_define.php');
	include_once('imagesPage.php');
	
	$page=new imagesPage();
	
	$imageForm=new html_div();
	$imageForm->id="imageFormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($imageForm);
	$page->printHTML();
	
?>