<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.Game.php");

#$oStandings = new Standings();
#$aStandings = $oStandings->getStandings("2007", "A", null, false, 1, 5);

#printArray($aGames);

$oEntry = new Entry();
$oGame = new Game();
$aGames = $oGame->getAllGamesByYearAndDivision("2008", "A");

printArray($aGames);

#foreach($aGames as $game)
#{
#	$aGame = $oGame->getGame($game['games_id_game']);
#	echo($aGame[0]['game_name'] . "<br />");
#	$aEntry =  $oEntry->getEntryRoundsForGame($game['games_id_game'], "A", "2007", true, true, 5);
	
#	foreach($aEntry as $entry)
#	{
#		echo($entry['player_initials'] . " " . $entry['score_game_output'] . "<br />");
#	}
#	echo("<br />");
#}
?>
