<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "models/class.Player.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();

$oForm = new HTMLFormTemplate($oTemplate, null, "post", $_SERVER['PHP_SELF'], "form");
$oUser = new User();
// make sure the user is a scorekeep admin
loginRedirectUserAdmin($oUser, "admin_scorekeep");

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the buttons-strings
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sProceed = $oSmartyConfigFile->getStringFromDefinition("PROCEED");

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sProceed, $aInputClasses["submit"]);

// *** CREATE INPUTS ***
// the input-names
$sInputIDTeam = "iIDTeam";

$oForm->createTextInput($sInputIDTeam, true, 7, 7, null, $aInputClasses["req"]);

// *** INIT THE FORM ***
$oForm->initForm();

// *** THE FORM IS POSTED ***
if($oForm->isSubmit())
{
	$iIDTeam = $oHTTPContext->getInt($sInputIDTeam);
	$oPlayer = new Player();
	if(!$oPlayer->isSplitTeam($iIDTeam))
		$oForm->setCustomError("notSplitTeam");
	else
	{
		$aPlayer = $oPlayer->getPlayer($iIDTeam);
		if(isset($aPlayer['player_year_entered']))
		{
			// we should only be able to void teams for the current year, right?
			if($aPlayer['player_year_entered'] != YEAR)
				$oForm->setCustomError("notCurrentYear");
		}
	}
}

// *** READY TO POST THE FORM
if($oForm->postData())
{
	// everything is ok...
	header("location: adminVoidSplit.php?iIDTeam=" . $iIDTeam);
}

// *** END THE FORM ***
$oForm->endForm();

$oTemplate->display("admin/adminVoidSplitStart.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>