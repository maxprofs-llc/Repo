<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.HTMLInput.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
require_once(BASE_DIR . "models/class.Division.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();

$iYear = $oHTTPContext->getInt("iYear");
$sDivision = $oHTTPContext->getString("sDivision");

if($iYear == null)
	$iYear = YEAR;
if($sDivision == null)
	$sDivision = "A";

$oEntry = new Entry();
$aPlayers = $oEntry->getNumberOfUniqueGames($iYear, $sDivision);

$oHTMLInput = new HTMLInput();
// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

$oDivisionsToYears = new DivisionsToYears();
$aTournamentYears = $oDivisionsToYears->getAllTournamentYears("DESC", true);
$aYears = array();
foreach($aTournamentYears as $year)
{
	array_push($aYears, $year['dty_year_for_division']);
}
$sJavascriptSelectYear = $oHTMLInput->getSelectID("iYear", $aYears, $aYears, $iYear, $aInputClasses["default"], "onchange=\"statsNoOfDifferentGames()\"");

$oDivision = new Division();
$aAllDivisions = $oDivisionsToYears->getDivisionsFromYear($iYear);
$aDivisions = array();
foreach($aAllDivisions as $division)
{	
	array_push($aDivisions, $division['division_name_short']);
}

$sJavascriptSelectDivision = $oHTMLInput->getSelectID("sDivision", $aDivisions, $aDivisions, $sDivision, $aInputClasses["default"], "onchange=\"statsNoOfDifferentGames()\"");
$oTemplate->assign("sJavascriptSelectYear", $sJavascriptSelectYear);
$oTemplate->assign("sJavascriptSelectDivision", $sJavascriptSelectDivision);

$oTemplate->assign("aPlayers", $aPlayers);
$oTemplate->assign("iYear", $iYear);
$oTemplate->assign("sDivision", $sDivision);
$oTemplate->assign("bDisplayUniqueGames", true);
$oTemplate->assign("bDisableHLLinks", true);
$oTemplate->display("statsNoOfDifferentGames.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>
