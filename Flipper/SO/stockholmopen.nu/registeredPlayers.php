<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Division.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
require_once(BASE_DIR . "models/class.Player.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oPlayer = new Player();
$oDivision = new Division();
$oDivisionsToYears = new DivisionsToYears();

$iYear = $oHTTPContext->getInt("iYear");
$sDivision = $oHTTPContext->getString("sDivision");
$sSort = $oHTTPContext->getString("sSort");

// default to the current year
if($iYear == null)
	$iYear = YEAR;
// default to A division
if($sDivision == null)
	$sDivision = "A";	
// default to sort by paid-fee
if($sSort == null)
	$sSort = "paid";
	
$aPlayers = $oPlayer->getPlayers($iYear, $sDivision, $sSort);

$sDivisionLongName = $oDivision->getDivisionLongNameFromShortName($sDivision);
$bDivisionIsFree = $oDivisionsToYears->divisionIsFree($sDivision, $iYear);
$iNumberOfCountries = $oPlayer->getCountryCountFromYearAndDivision(YEAR, $sDivision);

$oTemplate->assign("iNumberOfCountries", $iNumberOfCountries);
$oTemplate->assign("bDivisionIsFree", $bDivisionIsFree);
$oTemplate->assign("iNoOfPlayers", count($aPlayers));
$oTemplate->assign("iNoOfPlayers", count($aPlayers));
$oTemplate->assign("iPlayersWithEntranceFee", $oPlayer->getNumberOfPlayersWithEntranceFee($iYear, $sDivision));
$oTemplate->assign("bIncludedFromReg", true);
$oTemplate->assign("aPlayers", $aPlayers);
$oTemplate->assign("iYear", $iYear);
$oTemplate->assign("sDivision", $sDivision);
$oTemplate->assign("sDivisionLongName", $sDivisionLongName);
$oTemplate->assign("sSort", $sSort);
$oTemplate->assign("sLinkMain", $_SERVER['PHP_SELF'] . "?iYear=" . $iYear . "&amp;sDivision=" . $sDivision);
$oTemplate->display("registeredPlayers.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>
