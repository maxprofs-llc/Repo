<?php
// this page is used for both player listings and entry listings
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.DivisionsToPlayers.php");

$sTimeStart = microtime(true);

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oEntry = new Entry();
$oPlayer = new Player();

$iIDPlayerSearch = $oHTTPContext->getInt("iIDPlayerSearch");
if($iIDPlayerSearch != null)
	$iIDPlayer = $iIDPlayerSearch;
else
	$iIDPlayer = $oHTTPContext->getInt("iIDPlayer");

$iIDEntrySearch = $oHTTPContext->getInt("iIDEntrySearch");
if($iIDEntrySearch != null)
	$iIDEntry = $iIDEntrySearch;
else
	$iIDEntry = $oHTTPContext->getInt("iIDEntry");

$sSort = $oHTTPContext->getString("sSort");

$bValidEntryID = true;
$bValidPlayerID = true;

if($iIDEntry != null)
{
	// make sure it's a valid entry id
	$bValidEntryID = $oEntry->isValidEntryID($iIDEntry);
	if($bValidEntryID)
	{
		// get the selected entry
		$aEntry = $oEntry->getEntryData($iIDEntry);
	}
	else
	{
		$aEntry = null;
	}
}

$bPlayerHasPlayedEntries = true;
$aDivisions = null;

// KLUDGE: make this default to the player-id 1
if($iIDPlayer == null && $iIDEntry == null)
	$iIDPlayer = 1;
	
if($iIDPlayer != null)
{
	// make sure it's a valid player id
	$bValidPlayerID = $oPlayer->isValidPlayerID($iIDPlayer);
	if($bValidPlayerID)
	{
		$bPlayerHasPlayedEntries = $oEntry->playerHasPlayedEntries($iIDPlayer);
	
		if($bPlayerHasPlayedEntries)
		{
			// get the players' divisions
			$oDivisionsToPlayers = new DivisionsToPlayers();
			$aDivisions = $oDivisionsToPlayers->getPlayersDivisions($iIDPlayer);
			// add some stats to the divisions
			$i = 0;
			foreach($aDivisions as $division)
			{
				$aDivisions[$i]['best_entry_position'] = $oEntry->getPlayersQualPosition($iIDPlayer, $division['division_name_short']);
				$aDivisions[$i]['no_of_played_entries'] = $oEntry->getNumberOfEntriesForPlayer($iIDPlayer, $division['division_name_short']);
				$aDivisions[$i]['avg_score'] = $oEntry->getAverageEntryScoreForPlayer($iIDPlayer, $division['division_name_short']);
				$i++;
			}
			
			if($sSort == null)
			{
				$aEntry = $oEntry->getAllEntriesForPlayer($iIDPlayer);
			}
			else
			{
				$aEntry = $oEntry->getAllEntriesSortedForPlayer($iIDPlayer, $sSort);
			}
		}
		else
		{
			// the player hasn't played any entries
			$aPlayer = $oPlayer->getPlayer($iIDPlayer);
			// ugly way to do this, nevertheless.. we have to add it to position 0 in the array
			$aEntry[0] = $aPlayer;
		}
	}
	else
	{
		$aEntry = null;
	}

}

// let's see if we've got an image for this player
$bImageExists = false;
$sFileName = BASE_DIR . "images/players/" . $iIDPlayer . ".jpg";
if(file_exists($sFileName))
{
	$bImageExists = true;
}
else
{
	$sFileName = BASE_DIR . "images/players/" . $iIDPlayer . ".JPG";
	if(file_exists($sFileName))
	{
		$bImageExists = true;
	}
}

$iWidth = 0;
$iHeight = 0;

if($bImageExists)
{
	$aSize = getimagesize($sFileName);
	$iWidth = $aSize[0];
	$iHeight = $aSize[1];
	if($iWidth > 200)
	{
		$iWidth = 200;
	}
}

$oTemplate->assign("bFileExists", $bImageExists);
$oTemplate->assign("iWidth", $iWidth);
$oTemplate->assign("iHeight", $iHeight);
$oTemplate->assign("bPlayerHasPlayedEntries", $bPlayerHasPlayedEntries);
$oTemplate->assign("bValidPlayerID", $bValidPlayerID);
$oTemplate->assign("bValidEntryID", $bValidEntryID);
$oTemplate->assign("iYear", $aEntry[0]["player_year_entered"]);
$oTemplate->assign("iIDPlayer", $iIDPlayer);
$oTemplate->assign("iIDEntry", $iIDEntry);
$oTemplate->assign("iIDEntrySearch", $iIDEntrySearch);
$oTemplate->assign("iIDPlayerSearch", $iIDPlayerSearch);
$oTemplate->assign("sSort", $sSort);
$oTemplate->assign("aEntry", $aEntry);
$oTemplate->assign("aPlayers", $aEntry);
$oTemplate->assign("aDivisions", $aDivisions);
$oTemplate->assign("bPlayerHasPlayedEntries", $bPlayerHasPlayedEntries);
$oTemplate->assign("sLinkMain", $_SERVER['PHP_SELF'] . "?iIDPlayer=" . $iIDPlayer);
$oTemplate->assign("bNoEntryRoundSorting", true);

// if it's not a valid entry id, or player id
if(!$bValidEntryID)
	$oTemplate->display("errorPages/errorEntry.tpl.php"); // display the error page
elseif(!$bValidPlayerID)
	$oTemplate->display("errorPages/errorPlayer.tpl.php"); // display the error page
else
{
	// a little workaround for the player search since i want to loop the player.tpl.php file
	// KLUDGE: this is a bit too hacky-ish, i should redo this workaround to loop through the players
	$oTemplate->display("player.tpl.php");
}

$sTimeEnd = microtime(true);

if($iIDPlayerSearch != null)
	$oLogFile->writeSearch(LOG_FILE_SEARCH, ($sTimeEnd - $sTimeStart), "playerIDSearch", $iIDPlayerSearch);
		
if($iIDEntrySearch != null)
	$oLogFile->writeSearch(LOG_FILE_SEARCH, ($sTimeEnd - $sTimeStart), "entryIDSearch", $iIDEntrySearch);
	
require_once(BASE_DIR . "includes/inc.end.php");
?>
