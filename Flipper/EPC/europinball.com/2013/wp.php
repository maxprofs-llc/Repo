<?php

function customTemplate($page) {
	switch($page) {
		case 'players':
			include($_SERVER['DOCUMENT_ROOT'].'/2013/player.php');
	  break;
		case 'editplayer':
			include($_SERVER['DOCUMENT_ROOT'].'/2013/edit.php');
	  break;
		case 'registration':
			include($_SERVER['DOCUMENT_ROOT'].'/2013/reg.php');
	  break;
	}
}

?>
