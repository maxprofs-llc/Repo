<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "classes/class.Validator.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");

$oUser = new User();
$aTasks = $oUser->getAllAdminTasksForLoggedInUser();
// make sure the user is a scorekeep admin
loginRedirectUserAdmin($oUser, "admin_scorekeep");

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

$oPlayer = new Player();
$oDivisionsToYears = new DivisionsToYears();
$oHTTPContext = new HTTPContext();
$oArrayHelper = new ArrayHelper();
$oValidator = new Validator();
$oForm = new HTMLFormTemplate($oTemplate, "default", "post", $_SERVER['PHP_SELF'], "form");

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the proceed-string
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sSubmit = $oSmartyConfigFile->getStringFromDefinition("PROCEED");

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sSubmit, $aInputClasses["submit"]);

// the input-names
$sInputIDPlayer = "iIDPlayer";
$sInputIDEntry = "iIDEntry";

/// *** CREATE ALL INPUTS ***
// removing this ajax-stuff for now
//$oForm->createTextInput($sInputIDPlayer, true, 5, 5, null, $aInputClasses["req"], false, null, "onkeyup=\"displayPlayerAndEntry()\"");
//$oForm->createTextInput($sInputIDEntry, true, 5, 7, null, $aInputClasses["req"], false, null, "onkeyup=\"displayPlayerAndEntry()\"");
$oForm->createTextInput($sInputIDPlayer, true, 5, 5, null, $aInputClasses["req"], false, null);
$oForm->createTextInput($sInputIDEntry, true, 5, 7, null, $aInputClasses["req"], false, null);

// *** INIT THE FORM ***
$oForm->initForm();

// *** THE FORM IS POSTED ***
if($oForm->isSubmit())
{
	// get valid values for the player input
	$aPlayers = $oArrayHelper->assocToOrderedByKey($oPlayer->getPlayers(YEAR), "id_player");

	$iIDPlayer = $oHTTPContext->getInt($sInputIDPlayer);
	$iIDEntry = $oHTTPContext->getInt($sInputIDEntry);
	
	if(!$oValidator->validValues($aPlayers, $iIDPlayer))
		$oForm->setCustomError("invalidPlayerID");

	$oEntry = new Entry();
	
	// make sure there's an entry with this id
	if(!$oEntry->isValidEntryID($iIDEntry))
		$oForm->setCustomError("invalidEntryID");	

	if(!$oForm->hasErrors())
	{
		// check that the player's ID matches the entry ID
		$iIDPlayerForIDEntry = $oEntry->getPlayerIDForEntry($iIDEntry);
		if($iIDPlayerForIDEntry != $iIDPlayer)
			$oForm->setCustomError("entryPlayerMismatch");
	}
	
	// check if the entry is voided
	if(!$oForm->hasErrors())
	{
		// unless it's an entry admin that is logged in
		if(!$oUser->isUberAdmin())
		{
			if($oEntry->isVoided($iIDEntry))
				$oForm->setCustomError("entryVoided");
		}				
	}

	// check if the entry is completed (all scores registered)
	if(!$oForm->hasErrors())
	{
		// unless it's an entry admin that is logged in
		if(!$oUser->isUberAdmin())
		{
			if($oEntry->isCompleted($iIDEntry))
				$oForm->setCustomError("entryCompleted");
		}
	}
}

// *** READY TO POST THE FORM
if($oForm->postData())
{
	// redirect to the score-registration
	header("Location: " . BASE_URL . "adminEntryReg.php?iIDPlayer=" . $iIDPlayer . "&iIDEntry=" . $iIDEntry);
}

// *** END THE FORM ***
$oForm->endForm();

// assign all divisions for this year
$oTemplate->assign("aDivisions", $oDivisionsToYears->getDivisionsFromYear(YEAR));
$oTemplate->display("admin/adminEntryRegStart.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>