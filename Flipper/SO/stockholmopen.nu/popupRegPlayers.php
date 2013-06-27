<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Player.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oPlayer = new Player();

$iYear = $oHTTPContext->getInt("iYear");
$sDivision = $oHTTPContext->getString("sDivision");

$aPlayers = $oPlayer->getPlayers($iYear, $sDivision, "nameAsc");
$oTemplate->assign("aPlayers", $aPlayers);
$oTemplate->assign("iYear", $iYear);
$oTemplate->assign("sDivision", $sDivision);
$oTemplate->assign("bDisableHLLinks", "true");
$oTemplate->assign("bDisableLinks", "true");
$oTemplate->assign("bDisplayIDs", "true");

$oUser = new User();
// Check if the user is a scorekeep admin
if($oUser->isScorekeepAdmin($iIDUser)) {
  $oTemplate->assign("bIncludedFromAdmin", true);
}

$oTemplate->display("popupRegPlayers.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>