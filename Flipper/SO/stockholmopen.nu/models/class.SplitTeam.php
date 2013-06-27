<?php
require_once("class.Model.php");
require_once("class.Player.php");
require_once("class.Division.php");
require_once("class.DivisionsToPlayers.php");

class SplitTeam extends Model
{
	
	public function insertTeam($a_sInitials, $a_sTeamName, $a_iIDPlayer1, $a_iIDPlayer2, $a_iYear)
	{
		$oPlayer = new Player();
		
		$oDivision = new Division();
		$oDivisionsToPlayers = new DivisionsToPlayers();
		$iIDDivision = $oDivision->getDivisionIDFromShortName("S");

		// insert the "player" first, "2" is "male" (we can use whatever here),  "243" is the "unknown" country
		$iIDPlayer = $oPlayer->insertPlayer(2, 243, $a_sTeamName, null, null, null, null, null, null, null, null, $a_sInitials, $a_iYear, null, true);
		// insert into the divisions-to-players table
		$oDivisionsToPlayers->insertDivision($iIDDivision, $iIDPlayer);
		
		$sQuery = sprintf("INSERT INTO team_split
							(players_id_player, team_split_id_player_1, team_split_id_player_2) 
							VALUES (%d, %d, %d)",
							$this->oDB->escape($iIDPlayer),
							$this->oDB->escape($a_iIDPlayer1),
							$this->oDB->escape($a_iIDPlayer2));
							
		$this->oMDB2Wrapper->query("exec", $sQuery);
	}
	
	public function updateTeam($a_iIDTeam, $a_iIDPlayer, $a_sInitials, $a_sTeamName, $a_iIDPlayer1, $a_iIDPlayer2)
	{
		$oPlayer = new Player();
		$oPlayer->updatePlayer($a_iIDPlayer, null, null, $a_sTeamName, null, null, null, null, null, null, null, null, $a_sInitials, null);

		$sQuery = sprintf("UPDATE team_split
							SET team_split_id_player_1 = %d, team_split_id_player_2 = %d
							WHERE id_team_split = %d",
							$this->oDB->escape($a_iIDPlayer1),
							$this->oDB->escape($a_iIDPlayer2),
							$this->oDB->escape($a_iIDTeam));
							
		$this->oMDB2Wrapper->query("exec", $sQuery);		
	}
	
	public function getTeams($a_iYear = null)
	{
		$sWhere = null;
		if($a_iYear != null)
		{
			$sWhere = sprintf(" WHERE players.player_year_entered = %d",
								$this->oDB->escape($a_iYear));
		}
					
		$sQuery = "SELECT players.*, team_split .*
					FROM players
					JOIN team_split 
					ON players.id_player = team_split.players_id_player" . $sWhere;

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;
	}
	
	public function getPlayersIDsFromTeam($a_iIDTeam)
	{
		$sQuery = "SELECT *
					FROM team_split
					WHERE players_id_player
					LIMIT 1";

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0];		
	}
	
	public function getTeamIDFromPlayerID($a_iIDPlayer)
	{
		$sQuery = sprintf("SELECT id_team_split
							FROM team_split
							WHERE players_id_player = %d",
							$this->oDB->escape($a_iIDPlayer));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]['id_team_split'];							
	}
}

?>