<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");

$oUser = new User();
// make sure the user is a scorekeep admin
loginRedirectUserAdmin($oUser, "admin_scorekeep");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oForm = new HTMLFormTemplate($oTemplate, "default", "post", $_SERVER['PHP_SELF']);

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the buttons-strings
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sSubmit = $oSmartyConfigFile->getStringFromDefinition("SUBMIT");

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sSubmit, $aInputClasses["submit"]);

$oDivisionsToYears = new DivisionsToYears();
// get all divisions
$aDivisions = $oDivisionsToYears->getDivisionsFromYear(YEAR);

// create the check-box array values
$aPlayersAndDivisions = array();
$aCheckBoxNames = array();
$aCheckBoxOutput = array();
$aCheckBoxPreSelect = array();
	
// *** LOOP THROUGH THE DIVISIONS AND BUILD INPUT VALUES ***
foreach($aDivisions as $division)
{
	// get all players
	$oPlayer = new Player();
	$aPlayers = $oPlayer->getPlayers(YEAR, $division['division_name_short'], "nameAsc");
	
	foreach ($aPlayers as $player)
	{
		$sCheckBoxName = $player['id_player'] . $division['division_name_short'];
		array_push($aCheckBoxNames, $sCheckBoxName);
		$aTemp['division_name_short'] = $division['division_name_short'];
		$aTemp['id_player'] = $player['id_player'];
		array_push($aPlayersAndDivisions, $aTemp);
		$sCheckBoxOutput = $player['player_firstname'] . " " . $player['player_lastname'];
		array_push($aCheckBoxOutput, $sCheckBoxOutput);
		
		// find out if the player has paid the fee for this division, if so pre-check
		if($oPlayer->hasPaidEntranceFee($player['id_player'], $division['division_name_short']))
			array_push($aCheckBoxPreSelect, $sCheckBoxName);
	}
}

// *** CREATE INPUTS ***
// input names
$sInputPlayers = "sPlayers";
// create inputs
$oForm->createCheckBoxes($sInputPlayers, $aCheckBoxNames, $aCheckBoxOutput, false, $aCheckBoxPreSelect, $aInputClasses["default"], " onclick=updateFee()", null, null, true);

// *** INIT THE FORM ***
$oForm->initForm();	

// *** FORCE A POST SINCE WE ALWAYS WANT THIS TO BE POSTED ***
//$oForm->forcePost();

// *** END THE FORM ***
$oForm->endForm();

$oTemplate->assign("aPlayersAndDivisions",$aPlayersAndDivisions);
$oTemplate->assign("aCheckBoxNames",$aCheckBoxNames);
$oTemplate->display("admin/adminEntranceFee.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>