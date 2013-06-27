<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.String.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.DivisionsToPlayers.php");
require_once(BASE_DIR . "models/class.Entry.php");

$sTimeStart = microtime(true);

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oPlayer = new Player();
$oString = new String();

$sPlayerSearch = $oHTTPContext->getString("sPlayerSearch");
// strip initials from the search-string
$sReg = "#\(+([A-Z]+)\)#";
$sPlayerSearch = trim(preg_replace($sReg, "", $sPlayerSearch));

if($sPlayerSearch == null)
{
	$oTemplate->assign("bEmptyString", true);
	$oTemplate->assign("sPlayerSearch", $sPlayerSearch);
	$oTemplate->display("errorPages/errorPlayerSearch.tpl.php");
	exit;
}

$bInitials = false;
if(strlen($sPlayerSearch) == 3)
{
	// we're most likely looking for the player's initials
	$bInitials = true;
}

$aPlayers = $oPlayer->searchPlayersWithEntries($sPlayerSearch, true, $bInitials);
$oTemplate->assign("sPlayerSearch", $sPlayerSearch);
$oTemplate->assign("bIncludeFromLoop", true);
$oTemplate->assign("bNoEntryRoundSorting", true);

if($aPlayers == null)
{ 
	$oTemplate->display("errorPages/errorPlayerSearch.tpl.php");
}
else
{
	$iTotal = count($aPlayers);
	$i = 0;
	$oEntry = new Entry();
	$oDivisionsToPlayers = new DivisionsToPlayers();

	// KLUDGE: this is a bit too hacky-ish, i should redo this workaround to loop through the players
	foreach($aPlayers as $player)
	{
		$bPlayerHasPlayedEntries = true;
		if($i == 0)
		{
			$oTemplate->assign("bIncludeHeader", true);
		}
		else
		{
			$oTemplate->assign("bIncludeHeader", false);
		}

		if($i == ($iTotal-1))
			$oTemplate->assign("bIncludeFooter", true);
		else
			$oTemplate->assign("bIncludeFooter", false);

		// get the players' divisions
		$aDivisions = $oDivisionsToPlayers->getPlayersDivisions($player[0]['id_player']);
		// add some stats to the divisions
		$j = 0;
		foreach($aDivisions as $division)
		{
			$aDivisions[$j]['best_entry_position'] = $oEntry->getPlayersQualPosition($player[0]['id_player'], $division['division_name_short']);
			$aDivisions[$j]['no_of_played_entries'] = $oEntry->getNumberOfEntriesForPlayer($player[0]['id_player'], $division['division_name_short']);
			$aDivisions[$j]['avg_score'] = $oEntry->getAverageEntryScoreForPlayer($player[0]['id_player'], $division['division_name_short']);
			$j++;
		}

		$oTemplate->assign("aDivisions", $aDivisions);
		$oTemplate->assign("bPlayerHasPlayedEntries", $bPlayerHasPlayedEntries);
		$oTemplate->assign("aPlayers", $player);
	 	$oTemplate->assign("iIDPlayer", $player[0]['id_player']);
		$oTemplate->display("player.tpl.php");
		
		$i++;
	}
}

$sTimeEnd = microtime(true);
$oLogFile->writeSearch(LOG_FILE_SEARCH, ($sTimeEnd - $sTimeStart), "playerSearch", $sPlayerSearch);

require_once(BASE_DIR . "includes/inc.end.php");
?>