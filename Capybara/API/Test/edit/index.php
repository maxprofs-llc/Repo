<?php
	include_once('_define.php');

			$page=new pages_editPage();
			$page->contents->addEntity(new html_div('AIK','teamLogo'));
			$page->printHTML();	


/*
$page=new pages_editPage();

$page->contents->addEntity(new html_div('AIK','teamLogo'));

$page->printHTML();
*/
?>