<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Entry.php");

$oUser = new User();
// make sure the user is a uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oSmartyConfigFile = new SmartyConfigFile(MENU_CONFIG_FILE);
$bDisplayRegister = $oSmartyConfigFile->getStringFromDefinition("MENU_DISPLAY_ENTRY_REG");
// if this is true, we've chosen to disable the registration (in the menu)
// and it makes no sense to be able to use this file then
if($bDisplayRegister == "false")
{
	$oTemplate->display("errorPages/errorEntryRegDisabled.tpl.php");
	exit;
}

$oEntry = new Entry();

$oHTTPContext = new HTTPContext();
$oForm = new HTMLFormTemplate($oTemplate, "default", "get", $_SERVER['PHP_SELF']);

// get the posted vars
$iIDDelete = $oHTTPContext->getInt("iIDDelete");

// make sure it's a valid entry id
$bValidEntryID = $oEntry->isValidEntryID($iIDDelete);

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the delete string
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sDelete = $oSmartyConfigFile->getStringFromDefinition("DELETE");

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sDelete, $aInputClasses["submit"], "delete");

// *** CREATE INPUTS ***
// add hidden inputs to the form end string
$oForm->addHiddenInputToFormEnd("iIDDelete", $iIDDelete, true);

// *** INIT FORM ***
$oForm->initForm();

$bDeleted = false;
if($oForm->isDeleteSubmit())
{
	$oEntry->deleteEntry($iIDDelete);
	// write to the log file
	$oLogFile = new LogFile();
	$oLogFile->writeEntryAction(LOG_FILE_ENTRIES, $oUser->getLoggedInUsername(), $iIDDelete, "delete");	
	$bDeleted = true;
	// we have to re-calculate the scores here
	$bNoConfig = true;
	$bNoOutput = true;
	require_once(STANDINGS_CALCULATIONS_FILE);
}

// *** END FORM ***
$oForm->endForm();

// if it's not a valid entry id
if(!$bValidEntryID)
{
	$oTemplate->display("errorPages/errorEntry.tpl.php"); // display the error page
}
elseif($bDeleted)
{
	$oTemplate->display("admin/adminEntryDeleted.tpl.php");
}
else
{
	// get the selected entry
	$aEntry = $oEntry->getEntryData($iIDDelete);
	$oTemplate->assign("aEntry", $aEntry);
	$oTemplate->assign("aPlayers", $aEntry);
	$oTemplate->display("admin/adminEntryDelete.tpl.php");
}

require_once(BASE_DIR . "includes/inc.end.php");
?>