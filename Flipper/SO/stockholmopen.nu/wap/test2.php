<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.DivisionsToPlayers.php");

$oEntry = new Entry();
$oPlayer = new Player();

$aEntry = $oEntry->getAllEntriesForPlayer("3059");

printArray($aEntry);
?>
