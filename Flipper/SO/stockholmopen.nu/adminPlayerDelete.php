<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.SplitTeam.php");
require_once(BASE_DIR . "models/class.DivisionsToPlayers.php");

$oUser = new User();
// make sure the user is a uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oPlayer = new Player();

$oHTTPContext = new HTTPContext();
$oForm = new HTMLFormTemplate($oTemplate, "default", "get", $_SERVER['PHP_SELF']);

// get the posted vars
$iIDDelete = $oHTTPContext->getInt("iIDDelete");

// make sure it's a valid player id
$bValidPlayerID = $oPlayer->isValidPlayerID($iIDDelete);

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

$oForm->forcePost();

if($oForm->isDeleteSubmit())
{
	$oEntry = new Entry();
	// check if the player/team has played entries
	if(!$oEntry->playerHasPlayedEntries($iIDDelete))
	{
		// delete the divisions for this player first
		$oDivisionsToPlayers = new DivisionsToPlayers();
		$oDivisionsToPlayers->deleteForPlayer($iIDDelete);
		$oPlayer->deletePlayer($iIDDelete);
	}
	else
		die("Cannot delete the player/team aborting... everything"); // should only be able to get here if someone's messing with the url's
	
	if($oPlayer->playerIsInTeam($iIDDelete))
	{
		// check if it's a player who's in a team
		die("Cannot delete the player/team aborting... everything"); // should only be able to get here if someone's messing with the url's
	}
}

// *** END FORM ***
$oForm->endForm();

// get the selected player (to position 0 in the array so we can re-use a template)
$aPlayer[0] = $oPlayer->getPlayer($iIDDelete);
$oTemplate->assign("aPlayers", $aPlayer);

//printArray($aPlayer);
if($oPlayer->playerIsInTeam($iIDDelete))
{
	// can't delete a player who's in a team
	$oTemplate->display("errorPages/errorPlayerInTeam.tpl.php"); // display the error page	
}
else
{
	// if it's not a valid player id
	if(!$bValidPlayerID)
		$oTemplate->display("errorPages/errorPlayer.tpl.php"); // display the error page
	else
	$oTemplate->display("admin/adminPlayerDelete.tpl.php");
}

require_once(BASE_DIR . "includes/inc.end.php");
?>