<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "classes/class.Validator.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Division.php");
require_once(BASE_DIR . "models/class.DivisionsToPlayers.php");

$oUser = new User();
// make sure the user is a scorekeep admin
loginRedirectUserAdmin($oUser, "admin_scorekeep");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oSmartyConfigFile = new SmartyConfigFile(MENU_CONFIG_FILE);
$bDisplayRegister = $oSmartyConfigFile->getStringFromDefinition("MENU_DISPLAY_ENTRY_REG");
// if this is true, we've chosen to disable the registration (in the menu)
// and it makes no sense to be able to use this file then
if($bDisplayRegister == "false")
{
	$oTemplate->display("errorPages/errorEntryRegDisabled.tpl.php");
	exit;
}

$oPlayer = new Player();
$oDivisionsToYears = new DivisionsToYears();
$oHTTPContext = new HTTPContext();
$oArrayHelper = new ArrayHelper();
$oValidator = new Validator();
$oForm = new HTMLFormTemplate($oTemplate, "default", "post", $_SERVER['PHP_SELF'], "form");

$iIDPlayer = $oHTTPContext->getInt("iIDPlayer");

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the proceed-string
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sSubmit = $oSmartyConfigFile->getStringFromDefinition("PROCEED");

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sSubmit, $aInputClasses["submit"]);

// the input-names
//$sInputIDDivision = "iIDDivision";
$sInputDivision = "sDivision";

$oDivisionsToPlayers = new DivisionsToPlayers();
$aDivisions = $oDivisionsToPlayers->getPlayersDivisions($iIDPlayer);

if(count($aDivisions) > 1)
{
	// store the division ids and names
	$aDivisionIDs = array();
	$aDivisionNames = array();
	
	foreach($aDivisions as $division)
	{
		array_push($aDivisionIDs, $division['id_division']);
		array_push($aDivisionNames, $division['division_name_short']);
	}
	
	/// *** CREATE ALL INPUTS ***
	//$oForm->createSelectID($sInputIDDivision, $aDivisionIDs, $aDivisionNames, true, $aInputClasses["req"]);
	$oForm->createTextInput($sInputDivision, true, 1, 1);
	$oForm->createHiddenInput("iIDPlayer", $iIDPlayer, true);
	
	// *** INIT THE FORM ***
	$oForm->initForm();
	
	// *** THE FORM IS POSTED ***
	if($oForm->isSubmit())
	{
		//$iIDDivision = $oHTTPContext->getInt("iIDDivision");
		$oDivision = new Division();
		$sDivision = $oHTTPContext->getString($sInputDivision);
		$iIDDivision = $oDivision->getDivisionIDFromShortName($sDivision);
		
		if(!$oValidator->validValues($aDivisionIDs, $iIDDivision))
			$oForm->setCustomError("invalidDivisionID");
	}
	
	// *** READY TO POST THE FORM
	if($oForm->postData())
	{
		// redirect to the division-selection
		header("Location: " . BASE_URL . "adminEntryCreate.php?iIDPlayer=" . $iIDPlayer . "&iIDDivision=" . $iIDDivision);
	}
	
	// *** END THE FORM ***
	$oForm->endForm();
}
else
{
	// only one division for this player
	// redirect to the division-selection
	header("Location: " . BASE_URL . "adminEntryCreate.php?iIDPlayer=" . $iIDPlayer . "&iIDDivision=" . $aDivisions[0]['id_division']);
}

$aPlayer = $oPlayer->getPlayer($iIDPlayer);
$aDivisionsOutput = array();
$i = 0;
foreach($aDivisions as $division)
{
	// [KLUDGE]: should not be formatted here
	$aDivisionsOutput[$i]['division'] = $division['division_name_short'] . "/" . strtolower($division['division_name_short']) . " ";
	$i++;
}

$oTemplate->assign("aDivisionsOutput", $aDivisionsOutput);
$oTemplate->assign("aPlayer", $aPlayer);

if($aDivisions == null)
	$oTemplate->assign("bDivisionError", true);
else
	$oTemplate->assign("bDivisionError", false);
	
$oTemplate->display("admin/adminEntryCreateDivision.tpl.php");
require_once(BASE_DIR . "includes/inc.end.php");
?>