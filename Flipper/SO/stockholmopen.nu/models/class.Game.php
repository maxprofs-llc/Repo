<?php
require_once("class.Model.php");
require_once("class.Entry.php");

class Game extends Model
{
	function insertGame($a_sGameName, $a_iIDManufacturer, $a_iIDIPDB, $a_sLinkRulesheet, $a_iYear)
	{
		$sQuery = sprintf("INSERT INTO games
						(game_manufacturers_id_game_manufacturer, game_name, game_ipdb_id, game_link_rulesheet, game_year_released) 
						VALUES (%d, '%s', %d, '%s', %d)",
						$this->oDB->escape($a_iIDManufacturer),
						$this->oDB->escape($a_sGameName),
						$this->oDB->escape($a_iIDIPDB),
						$this->oDB->escape($a_sLinkRulesheet),
						$this->oDB->escape($a_iYear));
						
		$this->oMDB2Wrapper->query("exec", $sQuery);	
	}
	
	function updateGame($a_IDGame, $a_sGameName, $a_iIDManufacturer, $a_iIDIPDB, $a_sLinkRulesheet, $a_iYear)
	{
		$sQuery = sprintf("UPDATE games
							SET game_manufacturers_id_game_manufacturer = %d,
								game_name = '%s',
								game_ipdb_id = %d,
								game_link_rulesheet = '%s',
								game_year_released = %d
								WHERE id_game = %d",
							$this->oDB->escape($a_iIDManufacturer),
							$this->oDB->escape($a_sGameName),
							$this->oDB->escape($a_iIDIPDB),
							$this->oDB->escape($a_sLinkRulesheet),
							$this->oDB->escape($a_iYear),					
							$this->oDB->escape($a_IDGame));
							
		$this->oMDB2Wrapper->query("exec", $sQuery);
	}

	function gameExists($a_sGameName)
	{
		$sQuery = sprintf("SELECT COUNT(*)
							FROM games
							WHERE game_name = '%s'
							LIMIT 1",
							$this->oDB->escape($a_sGameName));
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($aRes[0]['count(*)'] == 0)
			return false;
		else
			return true;
	}
	
	function getGame($a_iIDGame)
	{
		$sQuery = sprintf("SELECT games.*, game_manufacturers.*
							FROM games
							JOIN game_manufacturers
							ON games.game_manufacturers_id_game_manufacturer = game_manufacturers.id_game_manufacturer
							WHERE games.id_game = %d",
							$this->oDB->escape($a_iIDGame));			
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes;	
	}	

	function getAllGames($a_sSort = null)
	{
		$sOrder = null;
		
		if($a_sSort == "nameAsc" || $a_sSort == null)
			$sOrder = "ORDER BY games.game_name ASC";
		elseif($a_sSort == "yearDesc")
			$sOrder = "ORDER BY games.game_year_released DESC";
		elseif($a_sSort == "manufacturerAsc")
			$sOrder = "ORDER BY game_manufacturers.game_manufacturer_name ASC";	
			
		$sQuery = sprintf("SELECT games.*, game_manufacturers.*
							FROM games
							JOIN game_manufacturers
							ON games.game_manufacturers_id_game_manufacturer = game_manufacturers.id_game_manufacturer
							" . $sOrder . " ");
	
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes;		
	}
	
	function getAllGamesByYearAndDivision($a_iYear, $a_sDivision, $a_iStart = null, $a_iEnd = null)	
	{
		$sLimit = null;
		// i have no idea why I have to put != null AND == 0, at the moment (?!)
		if(($a_iStart != null || $a_iStart == 0) && $a_iEnd != null)
			$sLimit = "LIMIT " . $a_iStart . " , " . $a_iEnd;
		
		$sQuery = sprintf("SELECT games.*, game_manufacturers.*
							FROM games
							JOIN game_manufacturers
							ON games.game_manufacturers_id_game_manufacturer = game_manufacturers.id_game_manufacturer
							JOIN games_in_tournament
							ON games.id_game = games_in_tournament.games_id_game
							JOIN divisions
							ON games_in_tournament.divisions_id_division = divisions.id_division
							WHERE games_in_tournament.git_year_in_tournament = %d 
							AND divisions.division_name_short = '%s'
							ORDER BY games.game_name ASC " . $sLimit . " ",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_sDivision));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;	
	}
	
	public function searchGames($a_sGameName, $a_bOnlyWithEntryRounds = false)
	{
		$sGameName = $this->oDB->escape($a_sGameName);
		$sAndEntryRounds = null;
		if($a_bOnlyWithEntryRounds)
			$sAndEntryRounds = "AND game_has_entry_rounds = 1";
						
		$sQuery = "SELECT *	FROM games WHERE game_name LIKE '%" . $sGameName . "%' " . $sAndEntryRounds . " ORDER BY game_name ASC";
		return $this->oMDB2Wrapper->query("queryAll", $sQuery);
	}
	
	public function getGameIDFromName($a_sGameName)
	{
		$aGame = $this->searchGames($a_sGameName, true);
		if(isset($aGame[0]['id_game']))
			return $aGame[0]['id_game'];
		else
			return null;
	}
	
	public function setHasEntryRounds($a_iIDGame)
	{
		$sQuery = sprintf("UPDATE games
							SET game_has_entry_rounds = 1
							WHERE id_game = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDGame));
		$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);	
	}
}
?>