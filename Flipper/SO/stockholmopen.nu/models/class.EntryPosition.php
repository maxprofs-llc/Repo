<?php
// 071208: removing everything that has to do with entry-positions
// the amount of data this would generate is just too-much-to-be-worth-the-huge-performance-loss
// and, besides... it will won't reflect the "real-time" standings
/*
require_once("class.Model.php");

class EntryPosition extends Model
{
	function insertEntryPosition($a_iIDEntry, $a_iPosition)
	{
		$sDate = Date("Y-m-d H:i:s");		
		$sQuery = sprintf("INSERT INTO entry_positions
							(entries_id_entry, entry_position_position, entry_position_date)
							VALUES (%d, %d, '%s')",
							$this->oDB->escape($a_iIDEntry),
							$this->oDB->escape($a_iPosition),
							$this->oDB->escape($sDate));
		$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);
	}
}
*/
?>