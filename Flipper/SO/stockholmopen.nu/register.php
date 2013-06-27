<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.Validator.php");
require_once(BASE_DIR . "classes/class.String.php");
require_once(BASE_DIR . "classes/class.Mail.php");
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "models/class.DivisionsToPlayers.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Gender.php");
require_once(BASE_DIR . "models/class.Country.php");
require_once(BASE_DIR . "models/class.Division.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.DivisionsToPlayers.php");
require_once(BASE_DIR . "functions/func.replaceCountryNames.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oSmartyConfigFile = new SmartyConfigFile(MENU_CONFIG_FILE);
$bDisplayRegister = $oSmartyConfigFile->getStringFromDefinition("MENU_DISPLAY_REGISTER");
$bDisplayRegisterMain = $oSmartyConfigFile->getStringFromDefinition("MENU_DISPLAY_REG_MAIN");
$oHTTPContext = new HTTPContext();
$oDivisionsToPlayers = new DivisionsToPlayers();
$iIDEdit = $oHTTPContext->getString("iIDEdit");

// if any of these two above are true, we've chosen to disable the registration (in the menu)
// and it makes no sense to be able to use this file then
if($bDisplayRegister == "false" || $bDisplayRegisterMain == "false")
{
	// unless we're editing a player...
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
$oGender = new Gender();
$oCountry = new Country();
$oArrayHelper = new ArrayHelper;
$oValidator = new Validator();
$oDivision = new Division();

if($iIDEdit == null)
	$oForm = new HTMLFormTemplate($oTemplate, "verify", "post", $_SERVER['PHP_SELF'], "form", false, false, true);
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

$sPreInitials = null;
$sPreFirstName = null;
$sPreLastName = null;
$iPreYearBorn = null;
$iPreGender = null;
$sPreEmail = null;
$sPrePhone = null;
$sPreMobilePhone = null;
$iPreCountry = null;
$sPreAddressStreet = null;
$sPreAddressZip = null;
$sPreAddressCity = null;
$sPreAddressRegion = null;	

// if we're editing, pre-select values for the form
if($iIDEdit != null)
{
	$aPlayer = $oPlayer->getPlayer($iIDEdit);
	$sPreInitials = $aPlayer['player_initials'];
	$sPreFirstName = $aPlayer['player_firstname'];
	$sPreLastName = $aPlayer['player_lastname'];
	$iPreYearBorn = $aPlayer['player_year_born'];
	$iPreGender = $aPlayer['id_gender'];
	$sPreEmail = $aPlayer['player_email'];
	$sPrePhone = $aPlayer['player_phone'];
	$sPreMobilePhone = $aPlayer['player_phone_mobile'];
	$iPreCountry = $aPlayer['id_country'];
	$sPreAddressStreet = $aPlayer['player_address_street'];
	$sPreAddressZip = $aPlayer['player_address_zip'];
	$sPreAddressCity = $aPlayer['player_address_city'];
	$sPreAddressRegion = $aPlayer['player_address_region'];	
}


// *** CREATE INPUTS ***
$aYearArray = array();
// build the year-born select value array
for($i = YEAR; $i > (YEAR-150); $i--)
	array_push($aYearArray, $i);

// the input-names
$sInputInitials = "sInitials";
$sInputFirstName = "sFirstName";
$sInputLastName = "sLastName";
$sInputYearBorn = "iYearBorn";
$sInputGender = "iGender";
$sInputEmail = "sEmail";
$sInputPhone = "sPhone";
$sInputMobilePhone = "sMobilePhone";
$sInputCountry = "iCountry";
$sInputAddressStreet = "sAddressStreet";
$sInputAddressZip = "sAddressZip";
$sInputAddressCity = "sAddressCity";
$sInputAddressRegion = "sAddressRegion";
$sInputMainTournament = "sMainTournament";
$sInputClassics = "sClassics";
$sInputJuniors = "sJuniors";

// get input values
$aGenderIDs = $oArrayHelper->assocToOrdered($oGender->getAllGenderIDs());
$aGenderNames = $oArrayHelper->assocToOrdered($oGender->getAllGenderNames());
$aCountryIDs = $oArrayHelper->assocToOrdered($oCountry->getAllCountriesIDs());
$aCountryNames = replaceCountryNames($oCountry->getAllCountries(), LANG_COUNTRY_FILE, true);

$oForm->createTextInput($sInputInitials, true, 3, 3, $sPreInitials, $aInputClasses["req"], false, null, "onblur=\"checkNotNull('" . $sInputInitials . "')\"");
$oForm->createTextInput($sInputFirstName, true, 16, 32, $sPreFirstName, $aInputClasses["req"], false, null, "onblur=\"checkNotNull('" . $sInputFirstName . "')\"");
$oForm->createTextInput($sInputLastName, true, 16, 32, $sPreLastName, $aInputClasses["req"], false, null, "onblur=\"checkNotNull('" . $sInputLastName . "')\"");
$oForm->createSelectID($sInputGender, $aGenderIDs, $aGenderNames, true, $iPreGender, $aInputClasses["req"], "onblur=\"checkNotNull('" . $sInputGender . "')\"");
$oForm->createTextInput($sInputEmail, true, 32, 64, $sPreEmail, $aInputClasses["req"], false, null, "onblur=\"checkEmail()\"");
$oForm->createTextInput($sInputPhone, false, 16, 16, $sPrePhone, $aInputClasses["default"]);
$oForm->createTextInput($sInputMobilePhone, false, 16, 16, $sPreMobilePhone, $aInputClasses["default"]);
$oForm->createSelectID($sInputCountry, $aCountryIDs, $aCountryNames, true, $iPreCountry, $aInputClasses["req"], "onblur=\"checkNotNull('" . $sInputCountry . "')\"");
$oForm->createTextInput($sInputAddressStreet, true, 32, 32, $sPreAddressStreet, $aInputClasses["req"]);
$oForm->createTextInput($sInputAddressZip, true, 6, 12, $sPreAddressZip, $aInputClasses["req"]);
$oForm->createTextInput($sInputAddressCity, true, 32, 32, $sPreAddressCity, $aInputClasses["req"]);
$oForm->createTextInput($sInputAddressRegion, false, 32, 32, $sPreAddressRegion, $aInputClasses["default"]);
$oForm->createSelect($sInputYearBorn, $aYearArray, true, $iPreYearBorn, $aInputClasses["req"], "onblur=\"checkNotNull('" . $sInputYearBorn . "')\"");

// if we're editing we need a hidden input for the edit-id
if($iIDEdit != null)
{
	$sInputEdit = "iIDEdit";
	$oForm->createHiddenInput($sInputEdit, $iIDEdit, true);
}

// ugly, never the less... get "Yes" and "No" from the smarty language file
$oSmartyConfigFile = new SmartyConfigFile(TEMPLATE_LANG_FILE);
$sYes = $oSmartyConfigFile->getStringFromDefinition("YES");
$sNo = $oSmartyConfigFile->getStringFromDefinition("NO");
$aYesNo = array($sYes, $sNo);

$sPreADiv = false;
$sPreCDiv = false;
$sPreJDiv = false;

if($iIDEdit != null)
{
	// find out if the player is in any of the divisions
	if($oDivisionsToPlayers->playerIsInDivision("A", $iIDEdit))
		$sPreADiv = true;
	if($oDivisionsToPlayers->playerIsInDivision("C", $iIDEdit))
		$sPreCDiv = true;
	if($oDivisionsToPlayers->playerIsInDivision("J", $iIDEdit))
		$sPreJDiv = true;	
}

// create the division selects, if the divisions are active
if(TS_NORMAL_DIVISIONS_ACTIVE == true)
{
	$sInputDivision = "iDivision";
	$aDivisionIDs = $oArrayHelper->assocToOrdered($oDivision->getAllDivisionIDsByYear(YEAR, false, true));
	$aDivisionNames = $oArrayHelper->assocToOrdered($oDivision->getAllDivisionNamesByYear(YEAR, false, true));
	$oForm->createSelectID($sInputDivision, $aDivisionIDs, $aDivisionNames, true, null, $aInputClasses["req"], "onblur=\"checkNotNull('" . $sInputDivision . "')\"");
}
else
{
	// we want a check-box for the a-division, but only if classics or juniors are active, if not there is only one division, right
	if(TS_CLASSICS_ACTIVE || TS_JUNIORS_ACTIVE)
		$oForm->createCheckBox($sInputMainTournament, null, false, $sPreADiv, $aInputClasses["default"], null, null, null, $aYesNo);	
}
	
// create the classics check-box if classics is active
if(TS_CLASSICS_ACTIVE)
{
	$oForm->createCheckBox($sInputClassics, null, false, $sPreCDiv, $aInputClasses["default"], null, null, null, $aYesNo);
}
	
// create the juniors check-box if juniors is active
if(TS_JUNIORS_ACTIVE)
{
	$oForm->createCheckBox($sInputJuniors, null, false, $sPreJDiv, $aInputClasses["default"], null, null, null, $aYesNo);
}

// *** INIT THE FORM ***
$oForm->initForm();

// *** THE FORM IS POSTED ***
if($oForm->isSubmit())
{
	if(TS_NORMAL_DIVISIONS_ACTIVE == true)
		$iDivision = $oHTTPContext->getInt($sInputDivision);
	else
		$iDivision = null;

	$iCountry = $oHTTPContext->getInt($sInputCountry);
	$iYearBorn = $oHTTPContext->getInt($sInputYearBorn);
	$iGender = $oHTTPContext->getInt($sInputGender);
	$sInitials = $oHTTPContext->getString($sInputInitials);
	$sFirstName = $oHTTPContext->getString($sInputFirstName);
	$sLastName = $oHTTPContext->getString($sInputLastName);
	$sEmail = $oHTTPContext->getString($sInputEmail);
	$sPhone = $oHTTPContext->getString($sInputPhone);
	$sMobilePhone = $oHTTPContext->getString($sInputMobilePhone);
	$sAddressStreet = $oHTTPContext->getString($sInputAddressStreet);
	$sAddressZip = $oHTTPContext->getString($sInputAddressZip);
	$sAddressCity = $oHTTPContext->getString($sInputAddressCity);
	$sAddressRegion = $oHTTPContext->getString($sInputAddressRegion);
	$sMainTournament = $oHTTPContext->getString($sInputMainTournament);
	$sClassics = $oHTTPContext->getString($sInputClassics);
	$sJuniors = $oHTTPContext->getString($sInputJuniors);
	
	// *** SET CUSTOM ERRORS ***
	if(!$oValidator->validEmail($sEmail))
		$oForm->setCustomError("invalidEmail");
	if(!$oValidator->validValues($aYearArray, $iYearBorn))
		$oForm->setCustomError("invalidYear");
	if(!$oValidator->validValues($aGenderIDs, $iGender))
		$oForm->setCustomError("invalidGender");
	if(!$oValidator->validValues($aCountryIDs, $iCountry))
		$oForm->setCustomError("invalidCountry");

	// check if the player is too old for juniors
	if($sJuniors == "on")
	{
		$iPlayerAge = YEAR - $iYearBorn;
		if($iPlayerAge > (TS_JUNIORS_MAX_AGE+1))
			$oForm->setCustomError("tooOldForJuniors");
	}
	
		
	if(TS_NORMAL_DIVISIONS_ACTIVE == true)
	{	
		if(!$oValidator->validValues($aDivisionIDs, $iDivision))
			$oForm->setCustomError("invalidDivision");
	}

	// make initials to uppercase
	$sInitials = strtoupper($sInitials);
	
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
		$oLogFile->writeFailedForm(LOG_FILE_FORMS_FAILED, "register", $sError);
	}
}

// log a required-fields missing error
if($oForm->hasReqFieldsMissing())
{
	$oLogFile = new LogFile();
	$oLogFile->writeFailedForm(LOG_FILE_FORMS_FAILED, "register", "required fields missing");
}

// *** READY TO POST THE FORM
if(($oForm->postData() || $oForm->isEditSubmit()) && !$oForm->hasErrors())
{
	if($iIDEdit != null)
	{
		// delete all the divisions for this player
		$oDivisionsToPlayers->deleteDivisions($iIDEdit);		
		$oPlayer->updatePlayer($iIDEdit, $iGender, $iCountry, $sFirstName, $sLastName, $sAddressStreet, $sAddressZip, $sAddressCity, $sAddressRegion, $sPhone, $sMobilePhone, $sEmail, $sInitials, $iYearBorn);
	}
	else
	{
		$iIDPlayer = $oPlayer->insertPlayer($iGender, $iCountry, $sFirstName, $sLastName, $sAddressStreet, $sAddressZip, $sAddressCity, $sAddressRegion, $sPhone, $sMobilePhone, $sEmail, $sInitials, YEAR, $iYearBorn);
	}
		// insert all divisions... even if we're editing since they have been deleted above
		if($iIDEdit != null)
			$iIDPlayer = $iIDEdit;
			
		// if classics or junior's are active
		if(TS_JUNIORS_ACTIVE || TS_CLASSICS_ACTIVE)
		{
			// if we've chosen to enter the "main tournament" (will be used if the normal (eg. A,B,C) divisions are disabled
			if($sMainTournament == "on")
			{
				$iIDDivision = $oDivision->getDivisionIDFromShortName("A");
				$oDivisionsToPlayers->insertDivision($iIDDivision, $iIDPlayer);
			}	
	
			// if classics is set we want to put in that division into the players_to_divisions table
			if($sClassics == "on")
			{
				$iIDDivision = $oDivision->getDivisionIDFromShortName("C");
				$oDivisionsToPlayers->insertDivision($iIDDivision, $iIDPlayer);
			}

			// if juniors is set we want to put in that division into the players_to_divisions table
			if($sJuniors == "on")
			{
				$iIDDivision = $oDivision->getDivisionIDFromShortName("J");
				$oDivisionsToPlayers->insertDivision($iIDDivision, $iIDPlayer);
			}	
		}
		else
		{
			// there is only the main division...
			$iIDDivision = $oDivision->getDivisionIDFromShortName("A");
			$oDivisionsToPlayers->insertDivision($iIDDivision, $iIDPlayer);
		}

	if($iIDEdit == null)
	{
		$oMail = new Mail();
		$oMail->sendRegistrationNotificationMain(unserialize(EMAIL_NOTIFICATIONS), $iCountry, $iDivision, $sFirstName, $sLastName, $sAddressStreet, $sAddressZip, $sAddressCity, $sAddressRegion, $sPhone, $sMobilePhone, $sEmail, $sInitials, $sMainTournament, $sClassics, $sJuniors, $sEmail);
	}
}

// *** END THE FORM ***
$oForm->endForm();

$oTemplate->assign("iIDEdit", $iIDEdit);
$oTemplate->assign("bDivisionsActive", TS_NORMAL_DIVISIONS_ACTIVE);
$oTemplate->assign("bClassicsActive", TS_CLASSICS_ACTIVE);
$oTemplate->assign("bJuniorsActive", TS_JUNIORS_ACTIVE);
$oTemplate->display("register.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>