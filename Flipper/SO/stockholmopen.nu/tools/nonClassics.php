<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Player.php");
$oUser = new User();
// make sure the user is an uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

require_once("toolsMenu.php");

echo "<h2>Players who are not in classics " . YEAR . "</h2>";

$oDivisionsToYears = new DivisionsToYears();
$aDivisions = $oDivisionsToYears->getDivisionsFromYear(YEAR);
$oPlayer = new Player();

$aAPlayersTemp = $oPlayer->getPlayers(YEAR, "A");
$aCPlayersTemp = $oPlayer->getPlayers(YEAR, "C");

$aAPlayers = array();
$aCPlayers = array();
$aNonClassics = array();

foreach($aAPlayersTemp as $player)
{
	array_push($aAPlayers, $player['player_firstname'] . " " . $player['player_lastname']);
}

foreach($aCPlayersTemp as $player)
{
	array_push($aCPlayers, $player['player_firstname'] . " " . $player['player_lastname']);
}

foreach($aAPlayers as $player)
{
	if(!in_array($player, $aCPlayers))
		array_push($aNonClassics, $player);
}

sort($aNonClassics);

foreach($aNonClassics as $player)
{
	echo $player . "<br />";
}

$aNonA = array();

foreach($aCPlayers as $player)
{
	if(!in_array($player, $aAPlayers))
		array_push($aNonA, $player);
}

echo "<h2>Players who are not in classics " . YEAR . "</h2>";
echo "<i>...probably none...</i><br /><br />";

foreach($aNonA as $player)
{
	echo $player . "<br />";
}

require_once(BASE_DIR . "includes/inc.end.php");