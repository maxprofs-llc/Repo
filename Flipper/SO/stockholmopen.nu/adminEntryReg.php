<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "classes/class.Validator.php");
require_once(BASE_DIR . "classes/class.String.php");
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Game.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Division.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
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

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oGame = new Game();
$oPlayer = new Player();
$oDivision = new Division();
$oHTTPContext = new HTTPContext();
$oArrayHelper = new ArrayHelper();
$oValidator = new Validator();
$oEntry = new Entry();
$oString = new String();
$oForm = new HTMLFormTemplate($oTemplate, "verify", "post", $_SERVER['PHP_SELF']);

$bEdit = $oHTTPContext->getString("bEdit");

// get the player id (is posted from the previous form, or hidden by this form)
$iIDPlayer = $oHTTPContext->getInt("iIDPlayer");
$iIDEntry = $oHTTPContext->getInt("iIDEntry");

// if we've disabled entry-registration for other years than the current
if(DISABLE_ENTRY_REG_FOR_OTHER_YEARS)
{
	$aEntry = $oEntry->getEntryData($iIDEntry);
	if($aEntry[0]['player_year_entered'] != YEAR)
	{
		// it's another year, lets display the error page
		$oTemplate->assign("iYear", YEAR);
		$oTemplate->display("errorPages/errorEntryRegDisabledForOtherYears.tpl.php");
		exit;	
	}
}

// get the players data
$aPlayer = $oPlayer->getPlayer($iIDPlayer);
// get the year from the player's data
$iYear = $aPlayer['player_year_entered'];

// get the divisions short name
$aEntry = $oEntry->getEntryData($iIDEntry);
$iIDDivision = $aEntry[0]['divisions_id_division'];
$aDivision = $oDivision->getDivision($aEntry[0]['divisions_id_division']);
$sDivision = $aDivision['division_name_short'];

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
// add hidden inputs to the form end string
$oForm->addHiddenInputToFormEnd("iIDPlayer", $iIDPlayer, true);
$oForm->addHiddenInputToFormEnd("iIDEntry", $iIDEntry, true);
$oForm->addHiddenInputToFormEnd("iYear", $iYear, false);
$oForm->addHiddenInputToFormEnd("bEdit", $bEdit, false);

// the input-names
$sInputIDPlayer = "iIDPlayer";
$sInputIDEntry = "iIDEntry";
$sInputVoid = "bVoid";

// get the input values
$aGames = $oGame->getAllGamesByYearAndDivision($iYear, $sDivision);
$aIDsGame = $oArrayHelper->assocToOrderedByKey($aGames, "id_game");
$aGameNames = $oArrayHelper->assocToOrderedByKey($aGames, "game_name");

// create the inputs
$oForm->createTextInput($sInputIDPlayer, true, 5, 5, null, $aInputClasses["req"]);
// hidden input for the players id
$oForm->createHiddenInput($sInputIDPlayer, $iIDPlayer, true);
// hidden input for the entrys id
$oForm->createHiddenInput($sInputIDEntry, $iIDEntry, true);
$aInputGames = array();
$aInputGamesTemplate = array();
$aRoundsInEntry = $oEntry->getRoundsInEntry($iIDEntry);

// get the selected number of entry rounds / entry for this division
$oDivisionsToYears = new DivisionsToYears();
$iNumberOfRounds = $oDivisionsToYears->getNumberOfRoundsPerEntry($iYear, $sDivision);

// create the "name" array of x number of game-selects, and the selects, and the score inputs
for($i = 0; $i < $iNumberOfRounds; $i++)
{
	$sInputNameScore = "iScore_" . $i;
	$sInputNameGame = "iIDGame_" . $i;


	if($oUser->isUberAdmin() == false)
	{
    if($oUser->isScorekeepAdmin() == true) {
      $palGameName = $aRoundsInEntry[$i]['game_name'].' <a href="wap/gamePrinter.php?gameId='.$aRoundsInEntry[$i]['id_game'].'&autoPrint=true" target="_new"><img src="images/icons/qr.png" class="iconLink" alt="{#ADMIN_ENTRY_PRINT#}" title="{#ADMIN_ENTRY_PRINT#}" valign="top"/></a>';
    } else {
      $palGameName = $aRoundsInEntry[$i]['game_name'];
    }
	  $oForm->createOutput($sInputNameGame, $palGameName);
		$oForm->addHiddenInputToInput($sInputNameGame, $aRoundsInEntry[$i]['id_game'], true);
	}
	else
		$oForm->createSelectID($sInputNameGame, $aIDsGame, $aGameNames, true, $aRoundsInEntry[$i]['id_game'], $aInputClasses['req']);
	
	$sPinScore = $oString->punctuation($aRoundsInEntry[$i]['entry_round_score_game']);

	if($sPinScore == "0")
		$sPinScore = null;
		
	$bCreateInput = false;
	// check if we have a score for the game, if we do, we don't want to create the select(s)
	if($aRoundsInEntry[$i]['entry_round_score_game'] == null)
		$bCreateInput = true;
	
	if($aRoundsInEntry[$i]['entry_round_score_game'] == 0)
		$bCreateInput = true;
	
	// or if it's an admin we want to create the selects every time
	if($oUser->isUberAdmin() == true)
		$bCreateInput = true;
	
	if($bCreateInput == true)
		$oForm->createTextInput($sInputNameScore, false, 20, 20, $sPinScore, $aInputClasses['req'], false);
	else
	{
		$oForm->createOutput($sInputNameScore, $sPinScore);
		$oForm->addHiddenInputToInput($sInputNameScore, $sPinScore, false);
	}
	array_push($aInputGames, $sInputNameGame);	
	array_push($aInputGames, $sInputNameScore);			
}

// ugly, never the less... get "Yes" and "No" from the smarty language file
$oSmartyConfigFile = new SmartyConfigFile(TEMPLATE_LANG_FILE);
$sYes = $oSmartyConfigFile->getStringFromDefinition("YES");
$sNo = $oSmartyConfigFile->getStringFromDefinition("NO");
$aYesNo = array($sYes, $sNo);

// create the void checkbox, and find out if the entry is voided already
$bIsVoided = $oEntry->isVoided($iIDEntry);
$oForm->createCheckBox($sInputVoid, null, false, $bIsVoided, $aInputClasses["default"], null, null, null, $aYesNo);

// *** GET THE POSTED VALUES (IF ANY)
$iIDPlayer = $oHTTPContext->getString($sInputIDPlayer);
$iIDEntry = $oHTTPContext->getString($sInputIDEntry);
$bVoid = $oHTTPContext->getString($sInputVoid);

$aIDsGamesPosted = array();
$aScoresPosted = array();

foreach($aInputGames as $input)
{
	// we only want to store the posted games and NOT the scores here
	if (preg_match("/Game/i", $input)) 
		array_push($aIDsGamesPosted, $oHTTPContext->getInt($input));
	else // store the scores
		array_push($aScoresPosted, $oHTTPContext->getString($input));
}

// *** INIT THE FORM ***
$oForm->initForm();	

$aWarningScores = array();

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
	$aIDPlayers = $oArrayHelper->assocToOrderedByKey($oPlayer->getPlayers($iYear), "id_player");
	if(!$oValidator->validValues($aIDPlayers, $iIDPlayer))
		$oForm->setCustomError("invalidPlayer");

	// make sure it's a valid entry id
	if(!$oEntry->isValidEntryID($iIDEntry))
		$oForm->setCustomError("invalidEntryID");

	// make sure the player id is right for the entry
	if($oEntry->getPlayerIDForEntry($iIDEntry) != $iIDPlayer)
		$oForm->setCustomError("invalidPlayerID");

	foreach($aScoresPosted as $score)
	{
		// null scores are ok...
		if($score != null)
		{
			$score = $oString->stripNonNumericChars($score);
			if(!$oValidator->positiveInt($score))
			{
				#echo $score . "<br />";
				$oForm->setCustomError("invalidScore");
			}
		}
	}		
		
	// *** (RE)FORMAT THE VERIFICATION ***
	// make sure that all scores just include numbers (strip all other chars)
	$aScores = array();

	foreach($aScoresPosted as $score)
	{
		$iScore = $oString->stripNonNumericChars($score);
		array_push($aScores, $iScore);
	}

	// replace the posted scores with the new, formatted, score in the verification output
	// and replace any game-ids (that are submitted with hidden fields) with game names
	$i = 0;
	$iGames = 0;
	foreach($aInputGames as $input)
	{
		// we only want to replace the scores...
		if (preg_match("/Score/i", $input)) 
		{
			// just do a null-thingy if the form has errors
			if($oForm->hasErrors())
				$oForm->replaceVerificationValue($input, null);
			else			
			$oForm->replaceVerificationValue($input, $oString->punctuation($aScores[$i]));
			$i++;
		}
		else
		{
			$aGame = $oGame->getGame($aIDsGamesPosted[$iGames++]);
			$sGameName = $aGame[0]['game_name'];
			$oForm->replaceVerificationValue($input, $sGameName);
		}
	}
	
	// *** CREATE WARNINGS FOR THE FORM ***
	// loop through all formatted scores and make sure they end with "0"
	// ... only set the warnings if there are no errors
	if(!$oForm->hasErrors())
	{
		$i = 0;
		foreach($aScores as $score)
		{
			if(!$oString->endingWithZero($score))
			{
				$oForm->setWarning("scoreNotEndingWithZero", "iScore_" . $i);
				array_push($aWarningScores, $score);	
			}
			$i++;
		}
	}
		
	// if the entry is about to be voided
	if($bVoid == "on")
		$oForm->setWarning("entryWillBeVoided");
}

// for debugging...
//$oForm->forcePost();

// *** READY TO POST THE FORM
if($oForm->postData())
{
	// write to the entry-update-log-file
	$oLogFile = new LogFile();
	$oLogFile->writeEntryAction(LOG_FILE_ENTRIES, $oUser->getLoggedInUsername(), $iIDEntry, "update");

	$bCalcStandings = false;
	if($bVoid == "on")
	{
		$oLogFile->writeEntryAction(LOG_FILE_ENTRIES, $oUser->getLoggedInUsername(), $iIDEntry, "void");
		$bCalcStandings = true;
	}
	
	// if the entry WAS voided and is now un-voided, we want to put in an "unvoided" entry, in the ..entry.. log
	if($oEntry->isVoided($iIDEntry) && $bVoid == null)
	{
		$oLogFile->writeEntryAction(LOG_FILE_ENTRIES, $oUser->getLoggedInUsername(), $iIDEntry, "unvoided");
		$bCalcStandings = true;
	}
		
	// just exit if we haven't got an entry id for some reason
	if($iIDEntry == null || $iIDEntry == 0)
	{
			exit("Entry ID is missing. Aborting.");
	}
	else
	{
		// TODO: it's be possible to change the scores here for a non-admin, the code below wasn't working... no time to fix that now though
		/*
		
		if(!$oUser->isUberAdmin())
		{
			// make sure no previously stored scores are changed, unless the user is an uber-admin
			// if so: just exit, this can only happen if the user is playing around with the URLs
			
			/*
			$aEntry = $oEntry->getEntryData($iIDEntry);
			$i = 0;
			foreach($aEntry[0]['entry_rounds'] as $entryround)
			{
				if($entryround['entry_round_score_game'] != 0)
				{
					if($aScores[$i] != $entryround['entry_round_score_game'])
					{
						// something's wrong here...
						echo "Something's wrong with the scores. Aborting.";
						exit;
					}
				}
				$i++;
			}
		}
		*/

		$oEntry->updateEntry($iIDEntry, $aIDsGamesPosted, $aScores, $bVoid);

		// let's calculate the standings
		if($bCalcStandings)
		{
			$bNoConfig = true;
			$bNoOutput = true;
			require_once(STANDINGS_CALCULATIONS_FILE);
		}
	}
	
	// if we're editing an entry we want to calculate the standings
	if($bEdit)
	{
		$bNoConfig = true;
		$bNoOutput = true;
		require_once(STANDINGS_CALCULATIONS_FILE);
	}
}

// *** END THE FORM ***
$oForm->endForm();

// assign the game-output names array
$oTemplate->assign("aInputGames", $aInputGames);
$iNoOfEntries = $oEntry->getNumberOfEntriesForPlayer($iIDPlayer, $sDivision);

// assign the players data
$oTemplate->assign("aPlayer", $aPlayer);
$oTemplate->assign("bEdit", $bEdit);
$oTemplate->assign("iNoOfEntries", $iNoOfEntries);
// assign scores that has gotten warnings
$oTemplate->assign("aWarningScores", $aWarningScores);

// *** SET THE AUTO-FOCUS ***
$sFocus = null;
if($oUser->isUberAdmin() == false)
{
	$aInputs = $oForm->getInputs();

	foreach($aInputs as $input)
	{
		$cFirstChar = substr($input['input'], 0, 1);
		// if the first char in the input isn't a number, go ahead and focus
		if(!is_numeric($cFirstChar)) 
		{
			if (preg_match("/Score/i", $input['inputName'])) 
			{
				// and if the input-name contains "Score"
				$sFocus	= $input['inputName'];
				$oTemplate->assign("sFocus", $sFocus);
				break;
			}
		}
	}
}

$oTemplate->assign("iIDEntry", $iIDEntry);
$oTemplate->display("admin/adminEntryReg.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>
