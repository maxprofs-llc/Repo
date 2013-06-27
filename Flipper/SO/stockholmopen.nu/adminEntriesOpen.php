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
// make sure the user is an entry admin
loginRedirectUserAdmin($oUser, "admin_entry_edit");
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
// the input-names
$iInputYear = "iYear";

$iYear = $oHTTPContext->getInt($iInputYear);
if($iYear == null)
	$iYear = YEAR;

// get all tournament years
$aTournamentYears = $oDivisionsToYears->getAllTournamentYears("DESC");
$aTournamentYears = $oArrayHelper->assocToOrdered($aTournamentYears);
$oForm->createJavaScriptSelect($iInputYear, $_SERVER['PHP_SELF'], $aTournamentYears, false, $iYear, $aInputClasses["default"]);

// *** INIT THE FORM ***
$oForm->initForm();
// *** END FORM ***
$oTemplate = $oForm->endForm();

// get, and assign, all open entris
$oTemplate->assign("aEntries", $oEntry->getOpenEntriesForYear($iYear));
$oTemplate->display("admin/adminEntriesOpen.tpl.php");
require_once(BASE_DIR . "includes/inc.end.php");
?>