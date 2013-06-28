<?php
	include "../_define.php";
	
	$allRoles=$dr->getRoleList();
	$roles=new baseClassList();
	$roles->Append($dr->getRoleById(NULL));
	foreach($allRoles as $role) {
		if($role->isChildOf($dr->getRoleById($conf->get('referee_role_id',65))) || $role->id==$conf->get('referee_role_id',65))
			$roles->Append($role);
	}
	
	print $roles->getJSON();
?>