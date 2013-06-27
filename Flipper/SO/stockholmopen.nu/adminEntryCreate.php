<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "classes/class.Validator.php");
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Game.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Division.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
require_once(BASE_DIR . "models/class.DivisionsToPlayers.php");
require_once(BASE_DIR . "models/class.Entry.php");

$oUser = new User();
// make sure the user is a scorekeep admin
loginRedirectUserAdmin($oUser, "admin_scorekeep");
$oTemplate->assign("bIncludedFromAdmin", true);

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

$oGame = new Game();
$oPlayer = new Player();
$oDivision = new Division();
$oHTTPContext = new HTTPContext();
$oArrayHelper = new ArrayHelper();
$oValidator = new Validator();
$oEntry = new Entry();
$oForm = new HTMLFormTemplate($oTemplate, "verify", "post", $_SERVER['PHP_SELF']);

// get the player id (is posted from the previous form, or hidden by this form)
$iIDPlayer = $oHTTPContext->getInt("iIDPlayer");
$iIDDivision = $oHTTPContext->getInt("iIDDivision");
$sDivision = $oDivision->getShortNameFromID($iIDDivision);

// check if the player has paid the entrance fee
$bPaidFee = $oPlayer->hasPaidEntranceFee($iIDPlayer, $sDivision);

// get the players data
$aPlayer = $oPlayer->getPlayer($iIDPlayer);

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the buttons-strings
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sProceed = $oSmartyConfigFile->getStringFromDefinition("PROCEED");
$sSubmit = $oSmartyConfigFile->getStringFromDefinition("SUBMIT");
$sGoBack = $oSmartyConfigFile->getStringFromDefinition("GO_BACK");

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sProceed, $aInputClasses["submit"], "verProceed");
$oForm->createFormSubmit($sSubmit, $aInputClasses["submit"], "verSubmit");
$oForm->createFormSubmit($sGoBack, $aInputClasses["submit"], "verBack");

// *** CREATE INPUTS ***

// the input-names
$sInputIDPlayer = "iIDPlayer";
$sInputPayFee = "sPayFee";

// get the input values
$aGames = $oGame->getAllGamesByYearAndDivision(YEAR, $sDivision);
$aIDsGame = $oArrayHelper->assocToOrderedByKey($aGames, "id_game");
$aGameNames = $oArrayHelper->assocToOrderedByKey($aGames, "game_name");

// create the inputs
$oForm->createTextInput($sInputIDPlayer, true, 5, 5, null, $aInputClasses["req"]);

// ugly, never the less... get "Yes" and "No" from the smarty language file
$oSmartyConfigFile = new SmartyConfigFile(TEMPLATE_LANG_FILE);
$sYes = $oSmartyConfigFile->getStringFromDefinition("YES");
$sNo = $oSmartyConfigFile->getStringFromDefinition("NO");
$aYesNo = array($sYes, $sNo);

// if the player hasn't paid the fee, create an pay-fee input
if(!$bPaidFee)
	$oForm->createCheckBox($sInputPayFee, null, false, null, $aInputClasses["default"], null, null, null, $aYesNo);	

// add hidden inputs to the form end string
$oForm->addHiddenInputToFormEnd($sInputIDPlayer, $iIDPlayer, true);
$oForm->addHiddenInputToFormEnd("iIDDivision", $iIDDivision, true);

// hidden input for the players id
//$oForm->createHiddenInput($sInputIDPlayer, $iIDPlayer, true);

$aInputGames = array();

// get the selected number of entry rounds / entry for this division
$oDivisionsToYears = new DivisionsToYears();
$iNumberOfRounds = $oDivisionsToYears->getNumberOfRoundsPerEntry(YEAR, $sDivision);

// create the "name" array of x number of game-selects, and the selects
for($i = 0; $i < $iNumberOfRounds; $i++)
{
	$sInputName = "iIDGame_" . $i;
	array_push($aInputGames, $sInputName);
	$oForm->createSelectID($sInputName, $aIDsGame, $aGameNames, true, null,$aInputClasses['req']);
}

// *** GET THE POSTED VALUES (IF ANY)
$iIDPlayer = $oHTTPContext->getString($sInputIDPlayer);
$aIDsGamesPosted = array();
foreach($aInputGames as $game)
	array_push($aIDsGamesPosted, $oHTTPContext->getInt($game));

// *** INIT THE FORM ***
$oForm->initForm();	

// *** THE FORM IS POSTED ***
if($oForm->isSubmit())
{	
	// *** SET CUSTOM ERRORS ***
	// make sure no game is selected several times
	if(!$oValidator->uniqueValuesInArray($aIDsGamesPosted))
		$oForm->setCustomError("multipleGame");
	// make sure the games are valid
	if(!$oValidator->validValuesInArray($aIDsGame, $aIDsGamesPosted))
		$oForm->setCustomError("invalidGame");
	// get all player id-s for this year
	$aIDPlayers = $oArrayHelper->assocToOrderedByKey($oPlayer->getPlayers(YEAR), "id_player");
	if(!$oValidator->validValues($aIDPlayers, $iIDPlayer))
			$oForm->setCustomError("invalidPlayer");
	
	// verify the division
	$oDivisionsToPlayers = new DivisionsToPlayers();
	$aIDDivisions = $oArrayHelper->assocToOrderedByKey($oDivisionsToPlayers->getPlayersDivisions($iIDPlayer), "id_division");
	if(!$oValidator->validValues($aIDDivisions, $iIDDivision))
		$oForm->setCustomError("invalidDivision");

	// NOTE: it IS possible here to create entries with games from other divisions, but you would have
	// to make an effort to do it though. Not such a big deal though, we will notice if someone does
	
	// *** CREATE WARNINGS FOR THE FORM ***
	$oEntry = new Entry();
	$iNoOfEntries = $oEntry->getNumberOfEntriesForPlayer($iIDPlayer, $sDivision);
	
	$oDivisionsToYears = new DivisionsToYears();
	$iFreeEntries = $oDivisionsToYears->getNumberOfFreeEntries(YEAR, $sDivision);
	
	if($iNoOfEntries == $iFreeEntries)
	{
		$oForm->setWarning("noOfEntriesAboveFree");
	}
	else
	{
		if($iNoOfEntries > $iFreeEntries)
			$oForm->setWarning("shouldPay");
	}
	
	if($iNoOfEntries >= $oDivisionsToYears->getNumberOfMaxEntries(YEAR, $sDivision))
		$oForm->setWarning("noOfEntriesAboveMax");
	
}

// *** READY TO POST THE FORM
if($oForm->postData())
{
	// used to avoid multiple entry-posting while using the browser's back-button
	if($_SESSION['bDoCreateEntry'] == true)
	{
		$iIDEntry = $oEntry->insertEntry($iIDPlayer, $iIDDivision, $aIDsGamesPosted);
		// if the set-entry-fee-thingy was selected
		if($oHTTPContext->getString($sInputPayFee) == "on")
		{
			// set the entrance-fee to paid for this player
			$oPlayer->setEntrancFeePaid($iIDPlayer, $sDivision);
		}
		
		$_SESSION['iIDEntry'] = $iIDEntry;
		// write to the entry-create-log-file
		$oLogFile = new LogFile();
		$oLogFile->writeEntryAction(LOG_FILE_ENTRIES, $oUser->getLoggedInUsername(), $iIDEntry, "creation");
		$_SESSION['bDoCreateEntry'] = false;
	}	
}

// *** END THE FORM ***
$oForm->endForm();

// assign the game-select names array
$oTemplate->assign("aInputGames", $aInputGames);
$oTemplate->assign("sDivision", $sDivision);

// assign the players data
$oTemplate->assign("aPlayer", $aPlayer);
$oTemplate->assign("bPaidFee", $bPaidFee);

$iNoOfEntries = $oEntry->getNumberOfEntriesForPlayer($iIDPlayer, $sDivision);
$oTemplate->assign("iNoOfEntries", $iNoOfEntries);
// assign the (posted) entry-data to the template
if(isset($_SESSION['iIDEntry']))
	$oTemplate->assign("aEntry", $oEntry->getEntryData($_SESSION['iIDEntry']));

$oTemplate->display("admin/adminEntryCreate.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>