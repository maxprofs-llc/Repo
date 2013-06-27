<?php
require_once("class.Model.php");
require_once("class.Entry.php");

class GamesInTournament extends Model
{
	function insertGameInTournament($a_iIDGame, $a_iIDDivision, $a_iYear)
	{
		$sQuery = sprintf("INSERT INTO games_in_tournament
						(divisions_id_division, games_id_game, git_year_in_tournament) 
						VALUES (%d, %d, %d)",
						$this->oDB->escape($a_iIDDivision),
						$this->oDB->escape($a_iIDGame),
						$this->oDB->escape($a_iYear));

		$this->oMDB2Wrapper->query("exec", $sQuery);	
	}

	function deleteGameInTournament($a_iIDGame, $a_iIDDivision, $a_iYear)
	{
		$sQuery = sprintf("DELETE FROM games_in_tournament
							WHERE games_id_game = %d
							AND divisions_id_division = %d
							AND git_year_in_tournament = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDGame),
							$this->oDB->escape($a_iIDDivision),	
							$this->oDB->escape($a_iYear));
		$this->oMDB2Wrapper->query("exec", $sQuery);	
	}	
	
	function insertGamesInTournamentForYear($a_aGames, $a_iYear)
	{
		// delete all games for this year
		if($a_iYear != null)
		{
			$this->deleteGamesInTournamentForYear($a_iYear);
		}
		
		// loop through, and insert, the games & division array
		foreach($a_aGames as $game)
		{
			$this->insertGameInTournament($game['iIDGame'], $game['iIDDivision'], $a_iYear);
		}
	}
	
	function deleteGamesInTournamentForYear($a_iYear)
	{
		$sQuery = sprintf("DELETE FROM games_in_tournament
							WHERE git_year_in_tournament = %d",
							$this->oDB->escape($a_iYear));

		$this->oMDB2Wrapper->query("exec", $sQuery);		
	}
	
	function getGamesInTournament($a_iYear, $a_sDivision)
	{
		$sQuery = sprintf("SELECT games_in_tournament.*
							FROM games_in_tournament
							JOIN divisions
							ON games_in_tournament.divisions_id_division = divisions.id_division
							WHERE games_in_tournament.git_year_in_tournament = %d
							AND divisions.division_name_short = '%s'",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_sDivision));	

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;
	}
	
	//function getGamesFromYearAndDivision($a_iYear, $a_sDivision)
	//{
		// ... tbd?
	//}
	
	function getGamesForYear($a_iYear, $a_sSort = null)
	{
		$sOrder = null;
		
		if($a_sSort == "nameAsc" || $a_sSort == null)
			$sOrder = "ORDER BY games.game_name ASC";
		elseif($a_sSort == "yearDesc")
			$sOrder = "ORDER BY games.game_year_released DESC, games.game_name DESC";
		elseif($a_sSort == "manufacturerAsc")
			$sOrder = "ORDER BY game_manufacturers.game_manufacturer_name ASC, games.game_name ASC";	
			
		$sQuery = sprintf("SELECT games_in_tournament.*, games.*, game_manufacturers.*, divisions.*
							FROM games_in_tournament
							JOIN divisions
							ON games_in_tournament.divisions_id_division = divisions.id_division
							JOIN games
							ON games.id_game = games_in_tournament.games_id_game
							JOIN game_manufacturers
							ON game_manufacturers.id_game_manufacturer = games.game_manufacturers_id_game_manufacturer 
							WHERE games_in_tournament.git_year_in_tournament =%d
							" . $sOrder . " ",
							$this->oDB->escape($a_iYear));	

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;		
	}
	
	public function getNumberOfGamesFromYear($a_iYear)
	{
 		$sQuery = sprintf("SELECT COUNT(games.id_game) AS count
							FROM games
							JOIN games_in_tournament ON games.id_game = games_in_tournament.games_id_game
							WHERE games_in_tournament.git_year_in_tournament = %d",
 							$this->oDB->escape($a_iYear)); 		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]['count'];		
	}
	
	function getGameYearAndDivisions($a_iIDGame, $a_iYear = null, $a_bExcludeCurrentDivisionOnly = false, $a_sDivision = null, $a_bOnlyWithEntries = true)
	{
		if($a_iYear != null)
			$sAndYear =	$this->oDB->escape("AND git_year_in_tournament != " . $a_iYear);
		else	
			$sAndYear = null;
		
		$sAndDivisionAndYear = null;
		// if we've selected to just exclude the current division	
		if($a_bExcludeCurrentDivisionOnly == true)
		{
			$sAndYear = null;
			
			if($a_sDivision != null)
			{
				// this shouldn't be "OR" ??! should be "AND" but this seems to work
				$sAndDivisionAndYear = sprintf("AND (divisions.division_name_short !='%s' OR git_year_in_tournament != %d) ",
							$this->oDB->escape($a_sDivision),
							$this->oDB->escape($a_iYear));
			}
		}
		$sQuery = sprintf("SELECT games_in_tournament.*, divisions.division_name_short, games.*, game_manufacturers.*
							FROM games_in_tournament
							JOIN divisions
							ON games_in_tournament.divisions_id_division = divisions.id_division
							JOIN games
							ON games_in_tournament.games_id_game = games.id_game
							JOIN game_manufacturers
							ON games.game_manufacturers_id_game_manufacturer = game_manufacturers.id_game_manufacturer
							WHERE games_in_tournament.games_id_game =%d
							" . $sAndYear . " " . $sAndDivisionAndYear . " 
							ORDER BY games_in_tournament.git_year_in_tournament DESC, divisions.division_name_short ASC",
							$this->oDB->escape($a_iIDGame));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$aRet = array();
		
		$oEntry = new Entry();
		
		if($a_bOnlyWithEntries == true)
		{
			foreach($aRes as $game)
			{
				if($oEntry->entryRoundsExistsForGame($game['games_id_game'], $game['git_year_in_tournament']))
					array_push($aRet, $game);
			}
		}
		else
			return $aRes;
		
		return $aRet;
	}
	
	function getAllGamesEverUsed($a_bOnlyWithRounds = false, $a_bGetCount = false, $a_iStart = null, $a_iEnd = null)
	{
		$sLimit = null;
		// i have no idea why I have to put != null AND == 0, at the moment (?!)
		if(($a_iStart != null || $a_iStart == 0) && $a_iEnd != null)
			$sLimit = "LIMIT " . $a_iStart . " , " . $a_iEnd;		

		$sWhereRounds = null;
		if($a_bOnlyWithRounds == true)
			$sWhereRounds = " AND games.game_has_entry_rounds = 1 ";
				
		$sQuery = "SELECT DISTINCT games_id_game
					FROM games_in_tournament
					JOIN games
					ON games_in_tournament.games_id_game = games.id_game
					" . $sWhereRounds . " 
					ORDER BY games.game_name ASC " . $sLimit;
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		/*
		$aTemp = $aRes;
		
		if($a_bOnlyWithRounds)
		{
			$aRes = null;
			$aRes = array();
			$oEntry = new Entry();			
			// if we only want the games with scores we have to filter them out here
			foreach($aTemp as $game)
			{
				$iIDGame = $game['games_id_game'];
				if($oEntry->entryRoundsExistsForGame($iIDGame))
				{
					array_push($aRes, $game);
				}
			}
		}
		*/
		
		$aRet = array();
		$i = 0;
		foreach ($aRes as $game)
		{
			$sQuery = sprintf("SELECT games_in_tournament.*, divisions.division_name_short, games.*, game_manufacturers.*
								FROM games_in_tournament
								JOIN divisions
								ON games_in_tournament.divisions_id_division = divisions.id_division
								JOIN games
								ON games_in_tournament.games_id_game = games.id_game
								JOIN game_manufacturers
								ON games.game_manufacturers_id_game_manufacturer = game_manufacturers.id_game_manufacturer
								WHERE games_in_tournament.games_id_game = %d",
								$this->oDB->escape($game['games_id_game']));
			$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
			$aRet[$i] = $aRes[0];
			
			if($a_bGetCount)
			{
				// add the number of played rounds for each game
				$sQuery = "SELECT COUNT(*) FROM entry_rounds
							WHERE games_id_game = " . $game['games_id_game'] ." AND entry_round_is_counted = 1";
				$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
				$aRet[$i]['number_of_played_rounds'] = $aRes[0]['count(*)'];
			}
			$i++;
		}
		
		//printArray($aRet);
		return $aRet;
	}
}
?>