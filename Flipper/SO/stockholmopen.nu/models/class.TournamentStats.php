<?php
require_once("class.Model.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.GamesInTournament.php");

class TournamentStats extends Model
{
	public function TournamentStats()
	{
		parent::__construct();
		$this->oEntry = new Entry($this->oDB);
	}
	
	public function getStats()
	{
		$sQuery = sprintf("SELECT * FROM tournament_stats
						WHERE id_tournament_stats = 1
						LIMIT 1");
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0];
	}
	
	public function setStats()
	{
		$iTotalEntries = $this->oEntry->getTotalEntries();		
		$iTotalScore = $this->oEntry->getTotalScoreForAllRounds();
		$iTotalEntryRounds = $this->oEntry->getTotalPlayedRounds();
		$this->insertTotalEntries($iTotalEntries);
		$this->insertTotalScore($iTotalScore);
		$this->insertTotalEntryRounds($iTotalEntryRounds);
	}
	
	private function insertTotalEntries($a_iTotalEntries)
	{
		$sQuery = sprintf("UPDATE tournament_stats
						SET total_no_of_entries = %d 
						WHERE id_tournament_stats = 1",
						$this->oDB->escape($a_iTotalEntries));
						
		$this->oMDB2Wrapper->query("exec", $sQuery);	
	}

	private function insertTotalScore($a_iTotalScore)
	{
		$sQuery = sprintf("UPDATE tournament_stats
						SET total_score = %d 
						WHERE id_tournament_stats = 1",
						$this->oDB->escape($a_iTotalScore));
		
		$this->oMDB2Wrapper->query("exec", $sQuery);	
	}
	
	private function insertTotalEntryRounds($a_iTotalRounds)
	{
		$sQuery = sprintf("UPDATE tournament_stats
						SET total_no_of_entry_rounds = %d 
						WHERE id_tournament_stats = 1",
						$this->oDB->escape($a_iTotalRounds));
		$this->oMDB2Wrapper->query("exec", $sQuery);	
	}
	
	public function getYearlyStats($a_iYear)
	{
		$oDivisionsToYears = new DivisionsToYears();
		$oPlayer = new Player();
		$oEntry = new Entry();
		$oGamesInTournament = new GamesInTournament();
		$aStats = array();
		$aStats['divisions'] = $oDivisionsToYears->getDivisionsFromYear($a_iYear);
		
		$i = 0;
		// get the number of players in the division(s)
		foreach($aStats['divisions'] as $division)
		{
			$iNumberOfPlayers = $oPlayer->getNumberOfPlayersFromYearAndDivision($a_iYear, $division['division_name_short']);
			$aStats['divisions'][$i]['no_of_players'] = $iNumberOfPlayers;
			$aStats['divisions'][$i]['no_of_entries'] = $oEntry->getNumberOfEntriesFromYearAndDivisionID($a_iYear, $division['divisions_id_division']);
			$aStats['divisions'][$i]['no_of_voided_entries'] = $oEntry->getNumberOfVoidedEntriedFromYearAndDivisionID($a_iYear, $division['divisions_id_division']);
			$aStats['divisions'][$i]['no_of_games'] = count($oGamesInTournament->getGamesInTournament($a_iYear, $division['division_name_short']));
			$i++;
		}
		
		$aStats['countries'] = $oPlayer->getNumberOfCountriesRepresentedFromYear($a_iYear);		
		// get the total number of players
		$iTotalPlayers = 0;
		foreach($aStats['countries']['no_of_players'] as $noOfPlayers)
		{
			$iTotalPlayers = $iTotalPlayers + $noOfPlayers;
		}
			
		$aStats['total_no_of_players'] = $iTotalPlayers;
		
		return $aStats;
	}
	
}
?>