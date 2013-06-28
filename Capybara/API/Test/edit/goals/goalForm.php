<?php
	include_once('../_define.php');

	$teamid=$_GET['teamid'];
	$goalnr=$_GET['goalnr'];
	$prefix=$_GET['prefix'];
	$goals=$_GET['goals'];
	
	$table=new html_table();
		
	for($g=$goalnr;$g<=$goals;$g++) {
		$form=new form_goalForm($prefix.'Team','goals',new match_goal(),$g);
		$table->addEntity(new html_tr('goal',array($lang->get('Goal')." ".$g,new html_td($form))));
	}
	$table->printHTML();
?>