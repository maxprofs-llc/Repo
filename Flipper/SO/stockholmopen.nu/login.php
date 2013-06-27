<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.User.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oUser = new User();
$oHTTPContext = new HTTPContext();
$oForm = new HTMLFormTemplate($oTemplate, "default", "post", $_SERVER['PHP_SELF']);

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the submit-string
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sSubmit = $oSmartyConfigFile->getStringFromDefinition("SUBMIT");

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sSubmit, $aInputClasses["submit"]);

// the input-names
$sInputUsername = "sUsername";
$sInputPassword = "sPassword";

/// *** CREATE ALL INPUTS ***
$oForm->createTextInput($sInputUsername, true, 16, 16, null, $aInputClasses["req"]);
$oForm->createPasswordInput($sInputPassword, true, 16, 16, null, $aInputClasses["req"]);

// *** INIT THE FORM ***
$oForm->initForm();

// these values come's from an ajax form...
$sUsername = $oHTTPContext->getString($sInputUsername);
$sPassword = $oHTTPContext->getString($sInputPassword);
$sRedirect = $oHTTPContext->getString("sRedirect");


// *** THE FORM IS POSTED ***
if($oForm->isSubmit() || ($sUsername != null && $sPassword != null))
{
	if(!$oUser->logIn($sUsername, $sPassword))
		$oForm->setCustomError("loginFailed");
	else
	{
		// redirect this way since we're using the ajax-form too
		header("Location: " . BASE_URL . "loggedIn.php");
		//header("Location: " . $sRedirect);
	}
}

// *** READY TO POST THE FORM
if($oForm->postData())
{
	// redirect (to make everything update)
	header("Location: loggedIn.php");
	//header("Location: index.php");
}

// *** END THE FORM ***
$oForm->endForm();

$oTemplate->assign("bIsLoggedIn", $oUser->isLoggedIn());
$oTemplate->display("login.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>