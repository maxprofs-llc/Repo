<?php
$bExcludeInit = true;
require_once("../config/inc.config.php");
require_once(BASE_DIR . "ajax/ajaxHeader.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.Entry.php");

// KLUDGE: but store the open histograms in a session var
$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$iIDGame = $oHTTPContext->getInt("iIDGame");
$sDivision = $oHTTPContext->getString("sDivision");
$iYear = $oHTTPContext->getInt("iYear");

$sSessionString = "gameOpenHistoGram#".$iIDGame.$sDivision.$iYear;

if(!isset($_SESSION[$sSessionString]))
{
	$oEntry = new Entry();
	$aHistogramData = $oEntry->getHistogramDataForGame($iIDGame, $sDivision, $iYear);
	$oTemplate->assign("aHistogramData", $aHistogramData);
	$oTemplate->display("ajax/gameHistogram.tpl.php");
	$_SESSION[$sSessionString] = true;
}
else
{
	unset($_SESSION[$sSessionString]);
}

require_once(BASE_DIR . "includes/inc.end.php");
?>