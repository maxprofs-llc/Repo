<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");

$oUser = new User();
// make sure the user is a uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);

$oDivisionsToYears = new DivisionsToYears();
$oPlayer = new Player();
// get all divisions
$aDivisions = $oDivisionsToYears->getDivisionsFromYear(YEAR);

$aPlayers = array();
foreach($aDivisions as $division)
{
	$aPlayersTemp = $oPlayer->getPlayers(YEAR, $division['division_name_short'], "nameAsc");
	foreach($aPlayersTemp as $player)
	{
		array_push($aPlayers, $player);
	}
}
//printArray($aPlayers);
$oTemplate->assign("aPlayers", $aPlayers);
$oTemplate->assign("bDisplayDivisionHeadlines", true);
$oTemplate->assign("bDisplayDivisions", true);
$oTemplate->assign("bDisplayEdit", true);
$oTemplate->assign("bDisableHLLinks", true);
$oTemplate->assign("bIncludedFromAdmin", true);
$oTemplate->display("admin/adminPlayersEdit.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>