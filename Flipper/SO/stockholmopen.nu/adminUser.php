<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.User.php");

$oUser = new User();
// make sure the user is a uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oForm = new HTMLFormTemplate($oTemplate, "default", "post", $_SERVER['PHP_SELF']);

// *** GET POSTED EDIT/DELETE VALUES ***
$iIDEdit = $oHTTPContext->getInt("iIDEdit");
$iIDDelete = $oHTTPContext->getInt("iIDDelete");

if($oForm->isEditStart())
{
	$aUserData = $oUser->getUserDataFromID($iIDEdit);
	$sPreUsername = $aUserData['user_username'];
	$sPreFirstname = $aUserData['user_firstf'];
	$sPreLastname = $aUserData['user_lastname'];
	$sPreEmail = $aUserData['user_email'];
}
else
{
	$sPreUsername = null;
	$sPreFirstname = null;
	$sPreLastname = null;
	$sPreEmail = null;	
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
$oForm->createFormSubmit($sSubmit, $aInputClasses["submit"], "submit");
$oForm->createFormSubmit($sEdit, $aInputClasses["submit"], "edit");

// *** CREATE INPUTS ***
// the input-names
$sInputUsername = "sUsername";
$sInputFirstname = "sFirstname";
$sInputLastname = "sLastname";
$sEmail = "sEmail";
$sInputPassword = "sPassword";
$sInputPasswordVerify = "sPasswordVerify";
$sInputUberAdmin = "sUberAdmin";

// create the selects
$oForm->createTextInput($sInputUsername, true, 12, 12, $sPreUsername, $aInputClasses["req"]);
$oForm->createTextInput($sInputFirstname, true, 16, 32, $sPreFirstname, $aInputClasses["req"]);
$oForm->createTextInput($sInputLastname, true, 16, 32, $sPreLastname, $aInputClasses["req"]);
$oForm->createTextInput($sEmail, true, 32, 128, $sPreEmail, $aInputClasses["req"]);

// only create if it's not an edit-form
if(!$oForm->isEditForm())
{
	$oForm->createPasswordInput($sInputPassword, true, 16, 16, null, $aInputClasses["req"]);
	$oForm->createPasswordInput($sInputPasswordVerify, true, 16, 16, null, $aInputClasses["req"]);
}

// find out if the selected user is an uber-admin
$sChecked = false;
if($oUser->isUberAdmin($iIDEdit) && $iIDEdit != null)
	$sChecked = true;
	
$oForm->createCheckBox($sInputUberAdmin, null, false, $sChecked, $aInputClasses['default']);

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
	// check if we're able to delete this user
	if(!$oUser->deleteUser($iIDDelete))
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