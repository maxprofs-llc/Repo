<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
require_once(BASE_DIR . "models/class.Game.php");
require_once(BASE_DIR . "models/class.GamesInTournament.php");

$oUser = new User();
// make sure the user is an uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oDivisionsToYears = new DivisionsToYears();
$oGame = new Game();
$oGamesInTournament = new GamesInTournament();
$oArrayHelper = new ArrayHelper();
$oForm = new HTMLFormTemplate($oTemplate, "default", "post", $_SERVER['PHP_SELF']);

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the buttons-strings
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sSubmit = $oSmartyConfigFile->getStringFromDefinition("SUBMIT");

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sSubmit, $aInputClasses["submit"]);

// *** BUILD INPUT VALUES ***
// get the divisions for the current year
$aDivisions = $oDivisionsToYears->getDivisionsFromYear(YEAR);
$iNumberOfDivisions = count($aDivisions);

// get all games
$aGames = $oGame->getAllGames();
// create the check-box array values
$aCheckBoxNames = array();
$aCheckBoxOutput = array();
foreach ($aGames as $game)
{
	// create check-boxes for all divisions
	$i = 0;
	foreach($aDivisions as $division)
	{
		$sCheckBoxName = $game['id_game'] . "," . $division['id_division'];
		array_push($aCheckBoxNames, $sCheckBoxName);
		if($i == 0)
			$sCheckBoxOutput = $game['game_name'] . " - (" . $division['division_name_short'] . ")";
		else
			$sCheckBoxOutput = "(" . $division['division_name_short'] . ")";
			
		array_push($aCheckBoxOutput, $sCheckBoxOutput);	
		$i++;
	}	
}

// get all games for this year, to preselect the boxes
$aGamesInTournament = $oGamesInTournament->getGamesForYear(YEAR);

// loop through the array and build the pre-select array
$aCheckBoxPreSelect = array();
foreach($aGamesInTournament as $game)
{
	$sCheckBoxName = $game['games_id_game'] . "," . $game['divisions_id_division'];
	array_push($aCheckBoxPreSelect, $sCheckBoxName);
}

// *** CREATE INPUTS ***
// input names
$sInputGames = "sGames";
// create inputs
$oForm->createCheckBoxes($sInputGames, $aCheckBoxNames, $aCheckBoxOutput, false, $aCheckBoxPreSelect, $aInputClasses["default"], " onclick=updateTournamentGame()", null, null, true);

// *** INIT THE FORM ***
$oForm->initForm();	

/* these part don't work and don't have to work since I'm using some ajax-thingies instead

// *** GET THE POSTED VALUES (IF ANY)
// loop through all checkboxes
$aGames = array();
$i = 0;
foreach($aCheckBoxNames as $checkbox)
{
	$sPost = $oHTTPContext->getString($checkbox);
	if($sPost == 'on')
	{
		// split the checkbox in value and division
		$aSplit = preg_split("/,/", $checkbox);
		$aGames[$i]['iIDGame'] = $aSplit[0];
		$aGames[$i]['iIDDivision'] = $aSplit[1];
		$i++;
	}
}

// *** FORCE A POST SINCE WE ALWAYS WANT THIS TO BE POSTED ***
$oForm->forcePost();

// *** READY TO POST THE FORM
//if($oForm->postData())
//{
	//$oGamesInTournament->insertGamesInTournamentForYear($aGames, YEAR);
	//$oForm->hideForm();
	//$oForm->setDisplayForm(false);
//}
*/

// *** END THE FORM ***
$oForm->endForm();

$oTemplate->assign("aCheckBoxNames",$aCheckBoxNames);
$oTemplate->assign("aDivisions",$aDivisions);
$oTemplate->assign("iNumberOfDivisions",$iNumberOfDivisions);
$oTemplate->display("admin/adminGamesTournament.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>