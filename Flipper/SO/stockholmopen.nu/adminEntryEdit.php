<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");

$oUser = new User();
// make sure the user is a uber admin
loginRedirectUserAdmin($oUser, "admin_uber");
$oTemplate->assign("bIncludedFromAdmin", true);

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oEntry = new Entry();

$oDivisionsToYears = new DivisionsToYears();
$oHTTPContext = new HTTPContext();
$oArrayHelper = new ArrayHelper();
$oForm = new HTMLFormTemplate($oTemplate, "default", "get", $_SERVER['PHP_SELF']);

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();
// get the submit string
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sSubmit = $oSmartyConfigFile->getStringFromDefinition("SUBMIT");

// the input-names
$iInputYear = "iYear";
$sInputSearch = "iSearch";

$iYear = $oHTTPContext->getInt($iInputYear);
$iSearch = $oHTTPContext->getInt($sInputSearch);

// get all tournament years
$aTournamentYears = $oDivisionsToYears->getAllTournamentYears("DESC");
$aTournamentYears = $oArrayHelper->assocToOrdered($aTournamentYears);
$aTemp = $aTournamentYears;
$aTournamentYears = array("-");
$i = 0;
foreach($aTemp as $val)
{
	array_push($aTournamentYears, $val);	
}

// create the inputs
$oForm->createTextInput($sInputSearch, false, 6, 6, $iSearch, $aInputClasses['default']);
$oForm->createJavaScriptSelect($iInputYear, $_SERVER['PHP_SELF'], $aTournamentYears, false, $iYear, $aInputClasses["default"]);

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sSubmit, $aInputClasses["submit"], "submit");

// *** INIT THE FORM ***
$oForm->initForm();

// *** END FORM ***
$oForm->endForm();

$bNoEntriesFound = false;
if($iSearch == null)
{
	// get, and assign, all entries
	$aEntries = $oEntry->getEntriesForYear($iYear);
	if($aEntries == null && ($iYear != null && $iYear != "-"))
		$bNoEntriesFound = true;
}
else 
{
	$aEntries = $oEntry->getEntryData($iSearch);	
	if($aEntries == null)
		$bNoEntriesFound = true;
}

$oTemplate->assign("aEntries", $aEntries);
$oTemplate->assign("bNoEntriesFound", $bNoEntriesFound);
$oTemplate->display("admin/adminEntryEdit.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>