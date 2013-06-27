<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "classes/class.Validator.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Game.php");
require_once(BASE_DIR . "models/class.GameManufacturer.php");

$oUser = new User();
// make sure the user is an uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oGame = new Game();
$oGameManufacturer = new GameManufacturer();
$oHTTPContext = new HTTPContext();
$oArrayHelper = new ArrayHelper();
$oValidator = new Validator();
$oForm = new HTMLFormTemplate($oTemplate, "default", "get", $_SERVER['PHP_SELF']);

// *** GET POSTED EDIT/DELETE VALUES ***
// get the edit id, if any...
$iIDEdit = $oHTTPContext->getInt("iIDEdit");

// *** INIT THE FORM ***
$oForm->initForm();

// get pre-selected values for the form if it's the start of an edit
if($oForm->isEditStart())
{
	$aGame = $oGame->getGame(($iIDEdit));
	$sPreGameName = $aGame[0]['game_name'];
	$iPreIDIPDB = $aGame[0]['game_ipdb_id'];
	$sPreLinkRulesheet = $aGame[0]['game_link_rulesheet'];
	$iPreYear = $aGame[0]['game_year_released'];	
	$iPreIDManufacturer = $aGame[0]['game_manufacturers_id_game_manufacturer'];	
}
else
{
	$sPreGameName =null;
	$iPreIDIPDB = null;
	$sPreLinkRulesheet = "http://";
	$iPreYear = null;
	$iPreIDManufacturer = null;
}

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the submit-strings
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sSubmit = $oSmartyConfigFile->getStringFromDefinition("SUBMIT");
$sEdit = $oSmartyConfigFile->getStringFromDefinition("EDIT");

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sSubmit, $aInputClasses["submit"], "submit");
$oForm->createFormSubmit($sEdit, $aInputClasses["submit"], "edit");

// *** CREATE THE INPUTS ***
// the input-names
$sInputGameName = "sGameName";
$sInputIPDB = "iIDIPDB";
$sInputRulesheet = "sLinkRulesheet";
$sInputYear = "iYearReleased";
$sInputManufacturer = "iIDManufacturer";

// get the value for the inputs
$aManufacturerIDs = $oArrayHelper->assocToOrdered($oGameManufacturer->getAllManufacturerIDs());
$aManufacturerNames = $oArrayHelper->assocToOrdered($oGameManufacturer->getAllManufacturerNames());

$oForm->createTextInput($sInputGameName, true, 48, 64, $sPreGameName, $aInputClasses["req"]);
$oForm->createTextInput($sInputIPDB, false, 6, 6, $iPreIDIPDB, $aInputClasses["default"]);
$oForm->createTextInput($sInputRulesheet, false, 48, 255, $sPreLinkRulesheet, $aInputClasses["default"]);
$oForm->createSelectYear($sInputYear, true, 1900, $iPreYear, $aInputClasses["req"]);
$oForm->createSelectID($sInputManufacturer, $aManufacturerIDs, $aManufacturerNames, null, $iPreIDManufacturer, $aInputClasses["req"]);

// *** GET THE POSTED VALUES (IF ANY)
$sGameName = $oHTTPContext->getString($sInputGameName);
$iIDIPDB = $oHTTPContext->getString($sInputIPDB);
$sLinkRulesheet = $oHTTPContext->getString($sInputRulesheet);
$iYear = $oHTTPContext->getString($sInputYear);
$iIDManufacturer = $oHTTPContext->getInt($sInputManufacturer);

// *** THE FORM IS POSTED ***
if($oForm->isSubmit())
{
	// *** SET CUSTOM ERROR(S) ***

	// if the default (http) rulesheet link is posted, make it null
	if($sLinkRulesheet == $sPreLinkRulesheet)
		$sLinkRulesheet = null;
	
	if($sLinkRulesheet != null)
		if(!$oValidator->validHttpURL($sLinkRulesheet))
			$oForm->setCustomError("invalidLink");


	if(!is_numeric($iYear))
		$oForm->setCustomError("invalidYear");
	if(!is_numeric($iIDIPDB) && $iIDIPDB != null)
		$oForm->setCustomError("invalidIPDB");
	if(!$oValidator->validValues($aManufacturerIDs, $iIDManufacturer))
		$oForm->setCustomError("invalidManufacturer");
		
	// we don't want to check this if it's an edit
	if(!$oForm->isEditSubmit())
	{
		if($oGame->gameExists($sGameName))
			$oForm->setCustomError("gameExists");
	}			
}

// *** READY TO POST THE FORM
if($oForm->postData())
{
	$oGame->insertGame($sGameName, $iIDManufacturer, $iIDIPDB, $sLinkRulesheet, $iYear);
}

// *** A POSTED EDIT ***
if($oForm->postDataEdit())
{
	$oGame->updateGame($iIDEdit, $sGameName, $iIDManufacturer, $iIDIPDB, $sLinkRulesheet, $iYear);
}

// *** END THE FORM ***
$oForm->endForm();

$sSort = $oHTTPContext->getString("sSort");

$oTemplate->assign("bIncludedFromAdmin", true);
$oTemplate->assign("aGames", $oGame->getAllGames($sSort));
$oTemplate->assign("sSort", $sSort);
$oTemplate->display("admin/adminGames.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>