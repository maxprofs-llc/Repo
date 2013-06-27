<?php
require_once("class.Model.php");
require_once("class.Entry.php");
require_once("class.Player.php");
require_once("class.Division.php");

class Standings extends Model
{
	function getStandings($a_iYear, $a_sDivision, $a_sSort = null, $a_bEntryRounds = true, $a_iStart = null, $a_iStop = null)
	{
		$oEntry = new Entry();
		$oPlayer = new Player();
		$oDivision = new Division();
		$iIDDivision = $oDivision->getDivisionIDFromShortName($a_sDivision);
		
		$sOrder = "ORDER BY entries.entry_score DESC";
		
		if($a_sSort == null || $a_sSort == "scoreDesc")
		{
			$sOrder = "ORDER BY entries.entry_score DESC, divisions_to_players.dtp_average_entry_score DESC, divisions_to_players.dtp_no_of_played_entries ASC";	
		}
		else if ($a_sSort == "nameAsc")
		{ 
			$sOrder = "ORDER BY players.player_firstname ASC, entries.entry_score DESC";
		}	
		else if ($a_sSort == "initialsAsc")
		{ 
			$sOrder = "ORDER BY players.player_initials ASC, entries.entry_score DESC";
		}	
		else if ($a_sSort == "cityAsc")
		{ 
			$sOrder = "ORDER BY players.player_address_city ASC, entries.entry_score DESC";
		}	
		else if ($a_sSort == "countryAsc")
		{ 
			$sOrder = "ORDER BY countries.country_name ASC, entries.entry_score DESC";
		}	
		else if ($a_sSort == "entriesDesc")
		{ 
			$sOrder = "ORDER BY divisions_to_players.dtp_no_of_played_entries DESC";
		}	
		else if ($a_sSort == "entriesAsc")
		{ 
			$sOrder = "ORDER BY divisions_to_players.dtp_no_of_played_entries ASC, entries.entry_score DESC";
		}	

		$sLimit = null;
		if($a_iStart != null && $a_iStop != null)
		{
			$a_iStart = $a_iStart - 1;			
			$sLimit = "LIMIT " . $a_iStart . "," . $a_iStop;
		}
		
		$sQuery = sprintf("SELECT players.*, entries.*, divisions.division_name_short, countries.*, divisions_to_players.*
							FROM
							(
							SELECT players.id_player, MAX(entries.entry_score)AS max_value
							FROM players
							JOIN entries
							ON players.id_player = entries.players_id_player
							JOIN entry_rounds
							ON entries.id_entry = entry_rounds.entries_id_entry
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division
							WHERE players.player_year_entered = %d
							AND divisions.id_division = %d
							GROUP BY players.id_player
							ORDER BY max_value DESC
							)
							AS q1
							JOIN entries
							ON q1.max_value = entries.entry_score AND q1.id_player = entries.players_id_player
							JOIN players
							ON q1.id_player = players.id_player
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division
							JOIN countries
							ON players.countries_id_country = countries.id_country
							JOIN divisions_to_players
							ON players.id_player = divisions_to_players.players_id_player
							WHERE divisions.id_division = %d
							AND divisions_to_players.divisions_id_division = %d 
							GROUP BY q1.id_player
							%s %s;",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($iIDDivision),
							$this->oDB->escape($iIDDivision),
							$this->oDB->escape($iIDDivision),
							$this->oDB->escape($sOrder),
							$this->oDB->escape($sLimit));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$aRes = $oPlayer->addSplitTeamVariables($aRes);
		$oEntry = new Entry();
		$aRes = $oEntry->addEntryRoundScoresToStandings($aRes);
		//echo $sQuery;
		if($a_bEntryRounds)
		{
			// add the entry rounds to the standings
			//$aRes = $oEntry->addEntryRoundsToEntries($a_iYear, $aRet);
			$aRes = $oEntry->addEntryRoundsToEntries($a_iYear, $a_sDivision, $aRes);
		}
		
		return $aRes;
	
	}
	
	function getAllTimeTopEntries($a_iLimit = null)
	{
		$oPlayer = new Player();
		$sLimit = " LIMIT 30";
		if($a_iLimit != null)
			$sLimit = " LIMIT " . $a_iLimit;

		$sQuery = "SELECT players.*, entries.*, divisions.division_name_short, countries.*
					FROM players
					JOIN entries
					ON players.id_player = entries.players_id_player
					JOIN divisions
					ON entries.divisions_id_division = divisions.id_division
					JOIN countries
					ON players.countries_id_country = countries.id_country
					ORDER BY entries.entry_score DESC" . $sLimit;
				
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$aRes = $oPlayer->addSplitTeamVariables($aRes);			
		$oEntry = new Entry();
		$aRes = $oEntry->addEntryRoundScoresToStandings($aRes);
		
		return $aRes;	
	}
	
	public function correctPositions($a_iYear, $a_sDivision)
	{
		$aStandings = $this->getStandings($a_iYear, $a_sDivision);
		$oEntry = new Entry();
		$i = 1;
		foreach($aStandings as $standing)
		{
			$oEntry->setEntryPosition($standing['entry_position'], $i);
			$i++;
		}
	}
}
?>
