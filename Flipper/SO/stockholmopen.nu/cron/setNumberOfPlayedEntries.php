<?php
ini_set("max_execution_time", 600);
ini_set("memory_limit", "64M");

// well... we want to exclude the init-file... ehm
$bExcludeInit = true;
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "functions/func.detectCommandLine.php");

// detect if we're running from command line or not
if(!detectCommandLine())
{
	// if we're not running from command-line we have to be logged in as uber-admin
	$oUser = new User();
	// make sure the user is a scorekeep admin
	loginRedirectUserAdmin($oUser, "admin_scorekeep");
}

$oPlayer = new Player();
$oDivisionsToYears = new DivisionsToYears();
$aDivisions = $oDivisionsToYears->getDivisionsFromYear(YEAR);
$oEntry = new Entry();

foreach($aDivisions as $division)
{
	$aPlayers = $oPlayer->getPlayers(YEAR, $division['division_name_short']);
	foreach($aPlayers as $player)
	{
		$oEntry->setNumberOfPlayedEntries($player['id_player'], $division['divisions_id_division']);		
	}
}

echo date("Y-m-d H:i:s") . " - Done with correcting the number of played entries. It's hard work though\n";
?>