<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Gender.php");
require_once(BASE_DIR . "models/class.Country.php");

$oUser = new User();
// make sure the user is a uber admin
loginRedirectUserAdmin($oUser, "admin_uber");
$oTemplate->assign("bIncludedFromAdmin", true);

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oGender = new Gender();
$oCountry = new Country();
$oArrayHelper = new ArrayHelper;
$oForm = new HTMLFormTemplate($oTemplate, "default", "get", $_SERVER['PHP_SELF']);

// *** GET POSTED EDIT/DELETE VALUES ***
$iIDEdit = $oHTTPContext->getInt("iIDEdit");
$iIDDelete = $oHTTPContext->getInt("iIDDelete");

$oPlayer = new Player();

if($oForm->isEditStart())
{
	$aPlayer = $oPlayer->getPlayer(($iIDEdit));
	$sPreInitials = $aPlayer['player_initials'];
	$sPreFirstName = $aPlayer['player_firstname'];
	$sPreLastName = $aPlayer['player_lastname'];
	$iPreIDGender = $aPlayerData['id_gender'];
	$sPreEmail = $aPlayerData['player_email'];
	$sPrePhone = $aPlayerData['player_phone'];
	$sPrePhoneMobile = $aPlayerData['player_phone_mobile'];
	$sPreAddressStreet = $aPlayerData['player_address_street'];
	$sPreAddressZip = $aPlayerData['player_address_zip'];
	$sPreAddressCity = $aPlayerData['player_address_city'];
	$iPreAddressRegion = $aPlayerData['player_address_region'];
}

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the submit-strings
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sSubmit = $oSmartyConfigFile->getStringFromDefinition("SUBMIT");
$sEdit = $oSmartyConfigFile->getStringFromDefinition("EDIT");

// *** INIT THE FORM ***
$oForm->initForm();

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sEdit, $aInputClasses["submit"], "edit");

// *** CREATE INPUTS ***
// the input-names
$sInputInitials = "sInitials";
$sInputFirstName = "sFirstName";
$sInputLastName = "sLastName";
$sInputGender = "iGender";
$sInputEmail = "sEmail";
$sInputPhone = "sPhone";
$sInputMobilePhone = "sMobilePhone";
$sInputCountry = "iCountry";
$sInputAddressStreet = "sAddressStreet";
$sInputAddressZip = "sAddressZip";
$sInputAddressCity = "sAddressCity";
$sInputAddressRegion = "sAddressRegion";

// get input values
$aGenderIDs = $oArrayHelper->assocToOrdered($oGender->getAllGenderIDs());
$aGenderNames = $oArrayHelper->assocToOrdered($oGender->getAllGenderNames());
$aCountryIDs = $oArrayHelper->assocToOrdered($oCountry->getAllCountriesIDs());
$aCountryNames = replaceCountryNames($oCountry->getAllCountries(), LANG_COUNTRY_FILE, true);

// create the selects

// *** GET THE POSTED VALUES (IF ANY)
$sUsername = $oHTTPContext->getString($sInputUsername);
$sFirstname = $oHTTPContext->getString($sInputFirstname);
$sLastname = $oHTTPContext->getString($sInputLastname);
$sPassword = $oHTTPContext->getString($sInputPassword);
$sPasswordVerify = $oHTTPContext->getString($sInputPasswordVerify);
$sEmail = $oHTTPContext->getString($sEmail);
$bUberAdmin = $oHTTPContext->getString($sInputUberAdmin);

// *** THE FORM IS POSTED ***
if($oForm->isSubmit())
{
	// check the username chars
	if(!$oUser->userNameCharsOk($sUsername))
		$oForm->setCustomError("invalidChars");

	// only check if it's not an edit-form
	if(!$oForm->isEditForm())
	{
		// check that the passwords are matching
		if($sPassword != $sPasswordVerify)
			$oForm->setCustomError("passwordMismatch");
		// check that there is no user with this name
		if($oUser->userExists($sUsername))
			$oForm->setCustomError("userNameExits");
	}		
}


// *** READY TO POST THE FORM
if($oForm->postData())
{
	$oUser->insertUser($sUsername, $sPassword, $sFirstname, $sLastname, $sEmail, $bUberAdmin);
}

// *** A POSTED EDIT ***
if($oForm->postDataEdit($iIDEdit))
{
	$oUser->updateUser($iIDEdit, $sUsername, $sFirstname, $sLastname, $sEmail, $bUberAdmin);
}

/* DISABLING THE DELETION SINCE THE DB-CONSTRAINTS OF USERS/LOGS ETC. */
/*
// *** DELETE POST(S) ***
if($oForm->isDeleteStart())
{
	$oAdminTask = new AdminTask();
	// check if we're able to delete this user
	if(!$oUser->deleteUser($oAdminTask, $iIDDelete))
	{
		// can't delete the user (since it's an uber-admin)
		$oForm->setCustomError("cannotDelete");
		$oForm->setDeleteFailed();
	}
	else
	{
		// we want to commit the delete already here
		$oForm->setDeleteCompleted();
	}			
}
*/

// *** END THE FORM ***
$oForm->endForm();
$oTemplate->assign("bIsLoggedIn", $oUser->isLoggedIn());
$oTemplate->assign("aUsers", $oUser->getAllUsers());
$oTemplate->display("admin/adminUser.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>