<?php
//exit;
require_once("../../config/inc.config.php");
require_once(BASE_DIR . "classes/database/MDB2.php");

$oDB =& MDB2::singleton(unserialize(DSN));
$oDB->setFetchMode(MDB2_FETCHMODE_ASSOC);
$oMDB2Wrapper = new MDB2Wrapper($oDB);

$sQuery = "SELECT entries.*, divisions_to_players.*
			FROM entries
			JOIN players
			ON entries.players_id_player = players.id_player
			JOIN divisions_to_players
			ON players.id_player = divisions_to_players.players_id_player
			ORDER BY entries.id_entry ASC";
			
$aRes = $oMDB2Wrapper->query("queryAll", $sQuery);

foreach($aRes as $entry)
{
	$sQuery = "SELECT COUNT(id_entry) AS count
				FROM entries
				WHERE players_id_player = " . $entry['players_id_player'];
	
	$aRes = $oMDB2Wrapper->query("queryAll", $sQuery);
	
	$iNoOfEntries = $aRes[0]['count'];
	
	if($iNoOfEntries == null)
	{
		$iNoOfEntries = 0;
	}
	
	//echo $entry['players_id_player'] . " " . $iNoOfEntries . "<br />";
	
	$sQuery = "UPDATE divisions_to_players
				SET dtp_no_of_played_entries = " . $iNoOfEntries . "
				WHERE divisions_id_division = " . $entry['divisions_id_division'] . "
				AND players_id_player = " . $entry['players_id_player'];
				
	$oMDB2Wrapper->query("exec", $sQuery);
}
?>