<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.Standings.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oStandings = new Standings();
$oHTTPContext = new HTTPContext();

$iLimit = $oHTTPContext->getString("iLimit");
if($iLimit == null)
	$iLimit = 20;

$oForm = new HTMLFormTemplate($oTemplate, "default", "get", $_SERVER['PHP_SELF']);

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// the input-names
$sInputLimit = "iLimit";

$oForm->createJavaScriptNumberSelect($sInputLimit, $_SERVER['PHP_SELF'], 50, false, $iLimit, $aInputClasses["default"], "?");
$oForm->initForm();
$oTemplate = $oForm->endForm();
	
$aBestEntries = $oStandings->getAllTimeTopEntries($iLimit);
	
$oTemplate->assign("bDisplayEntries", true);
$oTemplate->assign("bHideNoOfEntries", true);
$oTemplate->assign("bHidePositionChange", true);
$oTemplate->assign("bDisableHLLinks", true);
$oTemplate->assign("bDisplayDivisions", true);
$oTemplate->assign("bDisplayYears", true);
$oTemplate->assign("aPlayers", $aBestEntries);
$oTemplate->display("statsBestEntries.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>
