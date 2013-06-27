<?php
exit;
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
			ON players.id_player = divisions_to_players.players_id_player";
			
$aRes = $oMDB2Wrapper->query("queryAll", $sQuery);

foreach($aRes as $entry)
{
	$sQuery = "UPDATE entries
				SET divisions_id_division = "  . $entry['divisions_id_division'] . "
				WHERE id_entry = " . $entry['id_entry'];
	echo $sQuery . "<br />";
	$oMDB2Wrapper->query("exec", $sQuery);
}
?>