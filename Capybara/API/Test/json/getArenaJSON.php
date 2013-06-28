<?php

	include_once('_define.php');

	$arenas=$dr->getArenaList(true);

	print $arenas->getJSON(false);

?>