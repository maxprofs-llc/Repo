<?php
// hard-coded stuff, for just two lang files (en & sv)
require_once("../config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Player.php");
$oUser = new User();
// make sure the user is an uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

require_once("toolsMenu.php");

echo "<h2>Checking players for " . YEAR . "</h2>";

$oDivisionsToYears = new DivisionsToYears();
$aDivisions = $oDivisionsToYears->getDivisionsFromYear(YEAR);
$oPlayer = new Player();
$aPlayers = $oPlayer->getPlayers(YEAR);

$bOutPut = false;
foreach($aPlayers as $player)
{
	$iCount = $oPlayer->getPlayerCountForName($player['player_firstname'], $player['player_lastname'], YEAR);

	if($iCount > 1)
	{
		$bOutput = true;
		echo $player['player_firstname'] . " " . $player['player_lastname'] . " (" . $player['id_player'] . ")<br />";
	}
}

if($bOutput)
{
	echo "<br /><i>I guess something's wrong above?!</i>";
}

require_once(BASE_DIR . "includes/inc.end.php");
?>