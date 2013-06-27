<?php
require_once(BASE_DIR . "models/class.TournamentSetting.php");
// reads the tournament settings and set constants for all variables
$oTournamentSetting = new TournamentSetting();
$aTournamentSettings = $oTournamentSetting->getTournamentSettings(YEAR);

//define("TS_DIVISIONS_ACTIVE", 1);
// these are not used anymore... 
//define("TS_#remove#NO_OF_ROUNDS_PER_ENTRY", $aTournamentSettings[0]['ts_#remove#number_of_rounds_per_entry']);
//define("TS_#remove#MAX_ENTRIES", $aTournamentSettings[0]['ts_#remove#max_no_of_entries']);
//define("TS_#remove#NO_OF_FREE_ENTRIES", $aTournamentSettings[0]['ts_#remove#no_of_free_entries']);
//define("TS_#remove#NO_OF_PLAYERS_IN_FINAL", $aTournamentSettings[0]['ts_#remove#no_of_players_in_finals']);
//define("TS_#remove#NO_OF_TEAMS_IN_FINAL", $aTournamentSettings[0]['ts_#remove#no_of_teams_in_final']);
//define("TS_#remove#SWE_INC_FREE_ENTRIES", $aTournamentSettings[0]['ts_#remove#swe_inc_no_of_free_entries']);
//define("TS_#remove#FOREIGN_INC_FREE_ENTRIES", $aTournamentSettings[0]['ts_#remove#foreign_inc_no_of_free_entries']);

define("TS_NORMAL_DIVISIONS_ACTIVE", $aTournamentSettings[0]['ts_normal_divisions_active']);
define("TS_SPLIT_ACTIVE", $aTournamentSettings[0]['ts_split_active']);
define("TS_CLASSICS_ACTIVE", $aTournamentSettings[0]['ts_classics_active']);
define("TS_JUNIORS_ACTIVE", $aTournamentSettings[0]['ts_juniors_active']);
define("TS_JUNIORS_MAX_AGE", $aTournamentSettings[0]['ts_juniors_max_age']);
?>
