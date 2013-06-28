<?php
	include_once('../_define.php');
		
	if(isset($_GET['id']))
		$arenas=$dr->getGenericById($_GET['id'],'arena','ar','arena');
	else
		$arenas=$dr->getArenaList(true);

	print $arenas->getJSON();
?>