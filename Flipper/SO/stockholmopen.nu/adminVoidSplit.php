<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Entry.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oUser = new User();
// make sure the user is a scorekeep admin
loginRedirectUserAdmin($oUser, "admin_scorekeep");
$oHTTPContext = new HTTPContext();
$iIDTeam = $oHTTPContext->getInt("iIDTeam");
$bPost = $oHTTPContext->getString("bPost");

$bVoided = false;
if($bPost)
{
	$oPlayer = new Player();

	if(!$oPlayer->teamIsVoided($iIDTeam))
	{
		// only do all this if the team isn't voided already (might get refresh's etc. here)
		
		// you shouldn't get any weird stuff here unless you're playing around with the URLs/inputs so can just exit
		if(!$oPlayer->isSplitTeam($iIDTeam))
		{
			echo "This is not a split-team. Aborting";
			exit;
		}
		else
		{
			$aPlayer = $oPlayer->getPlayer($iIDTeam);
			if(isset($aPlayer['player_year_entered']))
			{
				if($aPlayer['player_year_entered'] != YEAR)
				{
					// we should only be able to void teams for the current year, right?
					echo "The team is not in the tournament this year. Aborting.";
					exit;
				}
			}
			else
			{
				echo "Something's gone very wrong. Aborting.";
				exit;
			}
		}
		
		// let's void the entries
		$oLogFile = new LogFile();
		$oEntry = new Entry();
		$aEntries = $oEntry->getAllEntriesForPlayer($iIDTeam);
		foreach($aEntries as $entry)
		{
			$oEntry->voidEntry($entry['id_entry'], true);
			$oLogFile->writeEntryAction(LOG_FILE_ENTRIES, $oUser->getLoggedInUsername(), $entry['id_entry'], "void");
		}
	
		$oPlayer->voidTeam($iIDTeam);
		$oLogFile->writeTeamAction(LOG_FILE_TEAMS, $oUser->getLoggedInUsername(), $iIDTeam, "void");
		
		// let's calculate the standings
		$bNoConfig = true;
		$bNoOutput = true;
		require_once(STANDINGS_CALCULATIONS_FILE);
	}
	
	$bVoided = true;	
}

$oPlayer = new Player();
$aTeam = $oPlayer->getPlayer($iIDTeam);

$oTemplate->assign("bVoided", $bVoided);
$oTemplate->assign("iIDTeam", $iIDTeam);
$oTemplate->assign("aTeam", $aTeam);
$oTemplate->assign("sAction", $_SERVER['PHP_SELF']);

$oTemplate->display("admin/adminVoidSplit.tpl.php");
require_once(BASE_DIR . "includes/inc.end.php");
?>