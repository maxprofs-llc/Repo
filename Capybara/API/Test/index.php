<?php
	include "_define.php";
	
	if(isset($_GET['id'])) {
		$role=$dr->getRoleById($_GET['id']);
		$checkrole=$dr->getRoleById($_GET['check']);
		$list=$role->getAllChildren();
		
		print "Children of ".$role->getName().":<br>";
		foreach($list as $r) {
			print $r->id.": ".$r->getName()."<br>";
		}
		print "Parent of ".$role->getName().": ".$role->getParentRole()->getName()."<br>";
		print "Immediate children of ".$role->getName().": ".$role->childRoles->count()."<br>";
		print "Inheritive children of ".$role->getName().": ".count($role->getAllChildren())."<br>";
		print $role->getName()." is child of ".$checkrole->getName().": ".($role->isChildOf($checkrole) ? 'Yes':'No');
	}	
	$rolelist="";
	foreach($dr->getRoleList(false,false) as $r) {
		$rolelist.="<option value='$r->id'>".$r->id.": ".$r->getName()."</option>";
	}
?>
<form action='index.php' method='GET'>
	Role 1: <select name='id'><?php print $rolelist ?></select><br />
	Role 2: <select name='check'><?php print $rolelist ?></select><br />
	<input type="submit" />	
</form>