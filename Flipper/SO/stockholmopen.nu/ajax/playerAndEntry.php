<?php
$bExcludeInit = true;
// this won't be used, for now anyway, since it was slowing the page down and isn't really needed
require_once("../config/inc.config.php");
require_once(BASE_DIR . "ajax/ajaxHeader.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Entry.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oPlayer = new Player();
$oHTTPContext = new HTTPContext();

$iIDPlayer = $oHTTPContext->getInt("iIDPlayer");
$iIDEntry = $oHTTPContext->getInt("iIDEntry");
$bMatch = null;

if($iIDPlayer != null)
{
	// to only find the current year's players
	$aPlayer = $oPlayer->getPlayer($iIDPlayer, YEAR);
	$oEntry = new Entry();
	// check that the player's ID matches the entry ID
	$iIDPlayerForIDEntry = $oEntry->getPlayerIDForEntry($iIDEntry);
	
	if($iIDPlayerForIDEntry != $iIDPlayer)
		$bMatch = false;
	else
		$bMatch = true;
		
	$oTemplate->assign("bSearching", true);
}

if($aPlayer != null)
{
	$oTemplate->assign("aPlayer", $aPlayer);
	$oTemplate->assign("iIDPlayer", $iIDPlayer);
	$oTemplate->assign("iIDEntry", $iIDEntry);
	$oTemplate->assign("bMatch", $bMatch);
	$oTemplate->assign("bSearching", false);
}

$oTemplate->display("ajax/playerAndEntry.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>