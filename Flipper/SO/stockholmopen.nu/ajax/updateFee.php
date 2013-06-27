<?php
$bExcludeInit = true;
require_once("../config/inc.config.php");
require_once(BASE_DIR . "ajax/ajaxHeader.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.User.php");

// make sure the user is an uber-admin
$oUser = new User();
if(!$oUser->isUberAdmin())
	exit;
	
$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oPlayer = new Player();
$oHTTPContext = new HTTPContext();
$bChecked = $oHTTPContext->getString("bChecked");

// the division will be the last char in the string
$sInput = $oHTTPContext->getString("sInput");
$iIDPlayer = substr($sInput,0,(strlen($sInput)-1));
$sDivision = substr($sInput,(strlen($sInput)-1),1);

if($bChecked == "true")
{
	$oPlayer->setEntrancFeePaid($iIDPlayer, $sDivision);
}

if($bChecked == "false")
{
	$oPlayer->setEntrancFeeNonPaid($iIDPlayer, $sDivision);
}

$oTemplate->assign("bChecked", $bChecked);
$oTemplate->display("ajax/updateFee.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>