<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.User.php");

$oUser = new User();
// make sure the user is an uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oForm = new HTMLFormTemplate($oTemplate, "default", "post", $_SERVER['PHP_SELF']);

// *** GET POSTED EDIT/DELETE VALUES ***
// get the edit id, if any...
$iIDEdit = $oHTTPContext->getInt("iIDEdit");

$oForm->isEditStart();

// *** GET POSTED EDIT/DELETE VALUES ***
$iIDEdit = $oHTTPContext->getInt("iIDEdit");
// get the user's data
$aUserData = $oUser->getUserDataFromID($iIDEdit);

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the submit-strings
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sEdit = $oSmartyConfigFile->getStringFromDefinition("EDIT");

// *** INIT THE FORM ***
$oForm->initForm();

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sEdit, $aInputClasses["submit"], "edit");

// *** CREATE THE INPUTS ***
// the input-names
$sInputPassword = "sPassword";
$sInputPasswordVerify = "sPasswordVerify";

$oForm->createPasswordInput($sInputPassword, true, 16, 16, null, $aInputClasses["req"]);
$oForm->createPasswordInput($sInputPasswordVerify, true, 16, 16, null, $aInputClasses["req"]);

// get the submit-string
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sSubmit = $oSmartyConfigFile->getStringFromDefinition("SUBMIT");
// create the submit-button
$oForm->createFormSubmit($sSubmit, $aInputClasses["submit"]);

// *** GET THE POSTED VALUES (IF ANY)
$sPassword = $oHTTPContext->getString($sInputPassword);
$sPasswordVerify = $oHTTPContext->getString($sInputPasswordVerify);

// *** THE FORM IS POSTED ***
if($oForm->isSubmit())
{
	// check that the passwords are matching
	if($sPassword != $sPasswordVerify)
	{
		$oForm->setCustomError("passwordMismatch");		
	}
}

// *** A POSTED EDIT ***
if($oForm->postDataEdit())
{
	$oUser->updatePassword($iIDEdit, $sPassword);
}

// *** END THE FORM ***
$oForm->endForm();

$oTemplate->assign("sUsername", $aUserData['user_username']);
$oTemplate->assign("aUsers", $oUser->getAllUsers());
$oTemplate->display("admin/adminUserPassword.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>
