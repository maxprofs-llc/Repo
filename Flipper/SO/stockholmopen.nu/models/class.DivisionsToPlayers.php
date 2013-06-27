<?php
require_once("class.Model.php");

class DivisionsToPlayers extends Model
{
	function insertDivision($a_iIDDivision, $a_iIDPlayer)
	{
		$sQuery = sprintf("INSERT INTO divisions_to_players
							(divisions_id_division, players_id_player) 
							VALUES (%d, %d)",
							$this->oDB->escape($a_iIDDivision),
							$this->oDB->escape($a_iIDPlayer));
		$this->oMDB2Wrapper->query("exec", $sQuery);
	}
	
	function deleteDivisions($a_iIDPlayer)
	{
		$sQuery = sprintf("DELETE FROM divisions_to_players
							WHERE players_id_player = %d",
							$this->oDB->escape($a_iIDPlayer));
		$this->oMDB2Wrapper->query("exec", $sQuery);
	}
	
	function deleteForPlayer($a_iIDPlayer)
	{
		if($a_iIDPlayer != null)
		{
			$sQuery = sprintf("DELETE FROM divisions_to_players
								WHERE players_id_player = %d",
								$this->oDB->escape($a_iIDPlayer));

			$this->oMDB2Wrapper->query("exec", $sQuery);
		}					
	}
	
	public function getPlayersDivisions($a_iIDPlayer)
	{
		$sQuery = sprintf("SELECT divisions_to_players.*, players.*, divisions.*
							FROM divisions_to_players
							JOIN players
							ON divisions_to_players.players_id_player = players.id_player
							JOIN divisions
							ON divisions_to_players.divisions_id_division = divisions.id_division
							WHERE divisions_to_players.players_id_player = %d
							ORDER BY divisions.division_name_short",
							$this->oDB->escape($a_iIDPlayer));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($aRes != null)
		{
			return $aRes;
		}
		else
			return null;
	}
	
	public function playerIsInDivision($a_sDivision, $a_iIDPlayer)
	{
		$sQuery = sprintf("SELECT COUNT(divisions_to_players.id_divisions_to_players) as count
							FROM divisions_to_players
							JOIN players
							ON divisions_to_players.players_id_player = players.id_player
							JOIN divisions
							ON divisions_to_players.divisions_id_division = divisions.id_division
							WHERE divisions_to_players.players_id_player = %d
							AND divisions.division_name_short = '%s'",
							$this->oDB->escape($a_iIDPlayer),								
							$this->oDB->escape($a_sDivision));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($aRes != null)
		{
			if($aRes[0]['count'] > 0)
			{
				return true;
			}
			else
				return false;
		}
		else
			return false;
	}
}
?>