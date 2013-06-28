<?php
	include_once('../_define.php');

	$f=$_GET['formation'];
	
	$formation=new formation($f);
	
	$roles=$formation->getDefaultRoles();
	
	$playerno=$_GET['no'];
	$roleid=false;
	foreach($roles as $role) {
		//if($roleid)
			print "<tr class='player'>";
		$roleid=$role->id;
		include "matchPlayerForm.php";
		$playerno+=1;
		print "</tr>";
	}
	print "<script>fixSearchBoxes(true)</script>";
?>