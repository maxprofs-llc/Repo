<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.Validator.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "classes/class.Mail.php");
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.SplitTeam.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oSmartyConfigFile = new SmartyConfigFile(MENU_CONFIG_FILE);
$bDisplayRegister = $oSmartyConfigFile->getStringFromDefinition("MENU_DISPLAY_REGISTER");
$bDisplayRegisterSplit = $oSmartyConfigFile->getStringFromDefinition("MENU_DISPLAY_REG_SPLIT");
$oHTTPContext = new HTTPContext();
$iIDEdit = $oHTTPContext->getString("iIDEdit");

// if any of these two above are true, we've chosen to disable the registration (in the menu)
// and it makes no sense to be able to use this file then
if($bDisplayRegister == "false" || $bDisplayRegisterSplit == "false")
{
	// unless we're editing a team...
	if($iIDEdit == null)
	{
		$oTemplate->display("errorPages/errorRegDisabled.tpl.php");
		exit;
	}	
}

if($iIDEdit != null)
{
	// if ID-edit is set we have to be logged in as uber-admin
	$oUser = new User();
	// make sure the user is an uber admin
	loginRedirectUserAdmin($oUser, "admin_uber");
}

$oPlayer = new Player();
$oSplitTeam = new SplitTeam();
$oValidator = new Validator();
$oArrayHelper = new ArrayHelper;

if($iIDEdit == null)
	$oForm = new HTMLFormTemplate($oTemplate, "verify", "post", $_SERVER['PHP_SELF'], "form");
else
	$oForm = new HTMLFormTemplate($oTemplate, null, "post", $_SERVER['PHP_SELF'], "form");

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the buttons-strings
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sProceed = $oSmartyConfigFile->getStringFromDefinition("PROCEED");
$sSubmit = $oSmartyConfigFile->getStringFromDefinition("SUBMIT");
$sGoBack = $oSmartyConfigFile->getStringFromDefinition("GO_BACK");
$sEdit = $oSmartyConfigFile->getStringFromDefinition("EDIT");

// *** CREATE THE SUBMIT BUTTON(S) ***
if($iIDEdit == null)
{
	$oForm->createFormSubmit($sProceed, $aInputClasses["submit"], "verProceed");
	$oForm->createFormSubmit($sSubmit, $aInputClasses["submit"], "verSubmit");
	$oForm->createFormSubmit($sGoBack, $aInputClasses["submit"], "verBack");
}
else
{
	$oForm->createFormSubmit($sEdit, $aInputClasses["submit"], "edit");
}

// *** CREATE INPUTS ***
$iPreIDPlayer1 = null;
$iPreIDPlayer2 = null;
$sPreInitials = null;
$sPreTeamName = null;

if($iIDEdit != null)
{
	$aPlayer = $oPlayer->getPlayer($iIDEdit);
	$iPreIDPlayer1 = $aPlayer['split_1_id_player'];
	$iPreIDPlayer2 = $aPlayer['split_2_id_player'];
	$sPreInitials = $aPlayer['player_initials'];	
	$sPreTeamName = $aPlayer['player_firstname'];	
}

// the input names
$sInputTeamName = "sTeamName";
$sInputInitials = "sInitials";
$sInputIDPlayer1 = "iIDPlayer1";
$sInputIDPlayer2 = "iIDPlayer2";

// get input values
$aPlayers = $oPlayer->getPlayers(YEAR, null, "nameAsc", false, true);
$aPlayerIDs = $oArrayHelper->assocToOrderedByKey($aPlayers, "id_player");
$aPlayerFirstNames = $oArrayHelper->assocToOrderedByKey($aPlayers, "player_firstname");
$aPlayerLastNames = $oArrayHelper->assocToOrderedByKey($aPlayers, "player_lastname");
$aPlayerInitials = $oArrayHelper->assocToOrderedByKey($aPlayers, "player_initials");
$aPlayerNames = $oArrayHelper->mergeTwoArraysWithDivider($aPlayerFirstNames, $aPlayerLastNames, " ");
$aPlayerNames = $oArrayHelper->mergeTwoArraysWithDivider($aPlayerNames, $aPlayerInitials, " - ");

$oForm->createTextInput($sInputTeamName, true, 24, 32, $sPreTeamName, $aInputClasses["req"]);
$oForm->createTextInput($sInputInitials, true, 3, 3, $sPreInitials, $aInputClasses["req"]);
$oForm->createSelectID($sInputIDPlayer1, $aPlayerIDs, $aPlayerNames, true, $iPreIDPlayer1, $aInputClasses["req"]);
$oForm->createSelectID($sInputIDPlayer2, $aPlayerIDs, $aPlayerNames, true, $iPreIDPlayer2, $aInputClasses["req"]);

// if we're editing we need a hidden input for the edit-id
if($iIDEdit != null)
{
	$sInputEdit = "iIDEdit";
	$oForm->createHiddenInput($sInputEdit, $iIDEdit, true);
}

// *** INIT THE FORM ***
$oForm->initForm();

// *** THE FORM IS POSTED ***
if($oForm->isSubmit())
{
	// get the posted values
	$sInitials = strtoupper($oHTTPContext->getString($sInputInitials));
	$sTeamName = $oHTTPContext->getString($sInputTeamName);
	$iIDPlayer1 = $oHTTPContext->getInt($sInputIDPlayer1);
	$iIDPlayer2 = $oHTTPContext->getInt($sInputIDPlayer2);
	
	// make sure we have two different player-id's
	if($iIDPlayer1 == $iIDPlayer2)
		$oForm->setCustomError("samePlayer");
		
	if(!$oValidator->validValues($aPlayerIDs, $iIDPlayer1))
		$oForm->setCustomError("invalidPlayer");
	if(!$oValidator->validValues($aPlayerIDs, $iIDPlayer2))
		$oForm->setCustomError("invalidPlayer");
		
	$aTeams = $oSplitTeam->getTeams(YEAR);
	
	// check that the team-name is unique and that both players aren't in a non-voided team
	foreach($aTeams as $team)
	{
		if($team['player_firstname'] == $sTeamName)
		{
			if($iIDEdit != null)
			{
				// we don't need to set this error if we're editing and the team-id is the same as we're editing, right. I.e. the team itself
				if($team['id_player'] != $iIDEdit)
					$oForm->setCustomError("notUniqueName");					
			}
			else
				$oForm->setCustomError("notUniqueName");			
		}
		
		if(($team['team_split_id_player_1'] == $iIDPlayer1 || $team['team_split_id_player_2'] == $iIDPlayer1) && $team['player_is_split_team_voided'] != 1)		
		{
			if($iIDEdit != null)
			{
				// we don't need to set this error if we're editing and the team-id is the same as we're editing, right. I.e. the team itself
				if($team['id_player'] != $iIDEdit)
					$oForm->setCustomError("player1InNonVoidedTeam");
			}
			else
				$oForm->setCustomError("player1InNonVoidedTeam");
		}
		
		if(($team['team_split_id_player_1'] == $iIDPlayer2 || $team['team_split_id_player_2'] == $iIDPlayer2) && $team['player_is_split_team_voided'] != 1)		
		{
			if($iIDEdit != null)
			{
				// we don't need to set this error if we're editing and the team-id is the same as we're editing, right. I.e. the team itself
				if($team['id_player'] != $iIDEdit)
					$oForm->setCustomError("player1InNonVoidedTeam");
			}
			else
				$oForm->setCustomError("player2InNonVoidedTeam");
		}		
	}
	
	// log all form errors
	if($oForm->hasErrors())
	{
		// store all errors in a string
		$aCustomErrors = $oForm->getCustomErrors();
		$sError = null;
		foreach($aCustomErrors as $key => $val) 
		{
			// if the key isn't numeric, it's a custom error
			if(!is_numeric($key))
			{
				$sError .= $key . " ";	
			}
		} 		

		$oLogFile = new LogFile();
		$oLogFile->writeFailedForm(LOG_FILE_FORMS_FAILED, "registerTeam", $sError);
	}
}

// log a required-fields missing error
if($oForm->hasReqFieldsMissing())
{
	$oLogFile = new LogFile();
	$oLogFile->writeFailedForm(LOG_FILE_FORMS_FAILED, "registerTeam", "required fields missing");
}

//$oForm->forcePost();

// *** READY TO POST THE FORM
if(($oForm->postData() || $oForm->isEditSubmit()) && !$oForm->hasErrors())
{
	if($iIDEdit == null)
	{
		$oSplitTeam->insertTeam($sInitials, $sTeamName, $iIDPlayer1, $iIDPlayer2, YEAR);
		$oMail = new Mail();
		$oMail->sendRegistrationNotificationSplit(unserialize(EMAIL_NOTIFICATIONS), $sInitials, $sTeamName, $iIDPlayer1, $iIDPlayer2);
	}
	else 
	{
		// we're editing a team
		// ... have to get the team id
		$iIDTeam = $oSplitTeam->getTeamIDFromPlayerID($iIDEdit);
		$oSplitTeam->updateTeam($iIDTeam, $iIDEdit, $sInitials, $sTeamName, $iIDPlayer1, $iIDPlayer2);
	}
	
}

// *** END THE FORM ***
$oForm->endForm();

$oTemplate->assign("iIDEdit", $iIDEdit);
$oTemplate->display("registerSplit.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>