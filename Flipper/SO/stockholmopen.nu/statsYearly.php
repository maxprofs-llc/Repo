<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.HTMLInput.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "models/class.TournamentStats.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oTournamentStats = new TournamentStats();
$oHTTPContext = new HTTPContext();
$iYear = $oHTTPContext->getInt("iYear");

if($iYear == null)
	$iYear = YEAR;
	
$aStats = $oTournamentStats->getYearlyStats($iYear);

$oDivisionsToYears = new DivisionsToYears();
$oHTMLInput = new HTMLInput();
$aTournamentYears = $oDivisionsToYears->getAllTournamentYears("DESC", true);
$aYears = array();
foreach($aTournamentYears as $year)
{
	array_push($aYears, $year['dty_year_for_division']);
}

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();
$sJavascriptSelectYear = $oHTMLInput->getJavaScriptSelect("iYear", $_SERVER['PHP_SELF'], $aYears, $iYear, $aInputClasses["default"]);

$oTemplate->assign("iYear", $iYear);
$oTemplate->assign("aStats", $aStats);
$oTemplate->assign("sSelectYear", $sJavascriptSelectYear);
$oTemplate->display("statsYearly.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>
