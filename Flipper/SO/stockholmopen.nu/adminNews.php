<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.News.php");

$oUser = new User();
// make sure the user is a uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oNews = new News();
$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oForm = new HTMLFormTemplate($oTemplate, "default", "get", $_SERVER['PHP_SELF']);

// *** GET POSTED EDIT/DELETE VALUES ***
$iIDEdit = $oHTTPContext->getInt("iIDEdit");
$iIDDelete = $oHTTPContext->getInt("iIDDelete");

if($oForm->isEditStart())
{
	$aNews = $oNews->getNewsFromID(($iIDEdit));
	$sPreText = $aNews['news_text'];
}
else
{
	$sPreText = null;
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
$sInputText = "sText";

// create the selects
$oForm->createTextArea($sInputText, true, 5, 50, null, $sPreText, $aInputClasses["req"]);

// *** GET THE POSTED VALUES (IF ANY)
$sText = $oHTTPContext->getString($sInputText);

// *** THE FORM IS POSTED ***
if($oForm->isSubmit())
{
	// no verification needed... whatever is good
}


// *** READY TO POST THE FORM
if($oForm->postData())
{
	$oNews->insertNews($sText);
}

// *** A POSTED EDIT ***
if($oForm->postDataEdit($iIDEdit))
{
	$oNews->updateNews($iIDEdit, $sText);
}

// *** DELETE POST(S) ***
if($oForm->isDeleteStart())
{
	$oNews->deleteNews($iIDDelete);
	// we want to commit the delete already here
	$oForm->setDeleteCompleted();
}

// *** END THE FORM ***
$oForm->endForm();
$oTemplate->assign("aNews", $oNews->getNews());
$oTemplate->display("admin/adminNews.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>