<?php
	include "_define.php";

	$head=new html_head();
	$head->addJavascript('edit/common/mootools-1.2.4-core.js');
	$head->addJavascript('edit/common/mootools-1.2.5.1-more.js');
	$head->printHTML();
	
	$test=new html_autoUpdateComboBox('.player');
	
	$text=new html_text('','player');
	$dropdown=new html_dropdown('player');
	$dropdown->addOption('1','Johan');
	$dropdown->addOption('2','Hšgfeldt');
	
	$text->printHTML();
	$dropdown->printHTML();
	$test->printHTML();
	
?>