<?php
$bExcludeInit = true;
require_once("../config/inc.config.php");
require_once(BASE_DIR . "ajax/ajaxHeader.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "models/class.Player.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oPlayer = new Player();
$oHTTPContext = new HTTPContext();
$iIDPlayer = $oHTTPContext->getInt("iIDPlayer");

$aPlayer = null;
if($iIDPlayer != null)
{
	// to only find the current year's players
	$aPlayer = $oPlayer->getPlayer($iIDPlayer, YEAR);
	$oTemplate->assign("bSearching", true);
}

if($aPlayer != null)
{
	$oTemplate->assign("aPlayer", $aPlayer);
	$oTemplate->assign("bSearching", false);
}

$oTemplate->display("ajax/player.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>