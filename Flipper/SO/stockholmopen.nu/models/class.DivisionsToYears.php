<?php
require_once("class.Model.php");
require_once("class.Division.php");
require_once("class.Entry.php");

class DivisionsToYears extends Model
{
	function insertDivision($a_iIDDivision, $a_iYear)
	{
		$sQuery = sprintf("INSERT INTO divisions_to_years
							(divisions_id_division, dty_year_for_division) 
							VALUES (%d, %d)",
							$this->oDB->escape($a_iIDDivision),
							$this->oDB->escape($a_iYear));

		$this->oMDB2Wrapper->query("exec", $sQuery);
	}

	function getAllTournamentYears($a_sSort = "ASC", $a_bOnlyWithEntries = false)
	{
		if($a_sSort != "ASC" && $a_sSort != "DESC")
			$a_sSort = "ASC";
			
		$sQuery = sprintf("SELECT DISTINCT dty_year_for_division
							FROM divisions_to_years 
							ORDER BY dty_year_for_division %s",
							$this->oDB->escape($a_sSort));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($a_bOnlyWithEntries == true)
		{
			$aRet = array();
			$oEntry = new Entry();
			foreach($aRes as $year)
			{
				if($oEntry->yearHasEntries($year['dty_year_for_division']))
					array_push($aRet, $year);
			}
			
			return $aRet;			
		}
		else	
			return $aRes;	
	}
	
	function getDivisionsFromYear($a_iYear)
	{
		$sQuery = sprintf("SELECT divisions_to_years.*, divisions.*
							FROM divisions_to_years
							JOIN divisions
							ON divisions_to_years.divisions_id_division = divisions.id_division
							WHERE divisions_to_years.dty_year_for_division = %d",
							$this->oDB->escape($a_iYear));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;		
	}
	
	public function getDivisionsAndYears()
	{
		$aYears = $this->getAllTournamentYears("DESC");
		$i = 0;
		foreach($aYears as $year)
		{
			$aDivisions = $this->getDivisionsFromYear($year['dty_year_for_division']);
			$aYears[$i]['divisions'] = $aDivisions;
			$i++;
		}
		return $aYears;
	}
	
	function updateDivisionsForYear($a_aDivisions, $a_iYear)
	{
		// loop through the array of divisions
		foreach ($a_aDivisions as $iIDDivision)
		{
			// check if the division is posted
			if(!$this->gotDivisionForYear($iIDDivision, $a_iYear))
			{
				$this->insertDivision($iIDDivision, $a_iYear);
			}
		}
	}
	
	function gotDivisionForYear($a_iIDDivision, $a_iYear)
	{		
		$sQuery = sprintf("SELECT COUNT(*)
							FROM divisions_to_years
							WHERE dty_year_for_division = %d
							AND divisions_id_division = %d", 
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_iIDDivision));
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($aRes[0]['count(*)'] == 0)
			return false;
		else
			return true;
	}
	
	public function getNumberOfRoundsPerEntry($a_iYear, $a_sDivision)
	{
		// get the division id
		$oDivision = new Division();
		$iIDDivision = $oDivision->getDivisionIDFromShortName($a_sDivision);
		
		$sQuery = sprintf("SELECT dty_no_of_rounds_per_entry 
							FROM divisions_to_years
							WHERE dty_year_for_division = %d
							AND divisions_id_division = %d
							LIMIT 1",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($iIDDivision));	
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]["dty_no_of_rounds_per_entry"];	
	}

	public function getNumberOfMaxEntries($a_iYear, $a_sDivision)
	{
		// get the division id
		$oDivision = new Division();
		$iIDDivision = $oDivision->getDivisionIDFromShortName($a_sDivision);
		
		$sQuery = sprintf("SELECT dty_max_no_of_entries 
							FROM divisions_to_years
							WHERE dty_year_for_division = %d
							AND divisions_id_division = %d
							LIMIT 1",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($iIDDivision));	
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]["dty_max_no_of_entries"];	
	}
	
	public function getNumberOfFreeEntries($a_iYear, $a_sDivision)
	{
		// get the division id
		$oDivision = new Division();
		$iIDDivision = $oDivision->getDivisionIDFromShortName($a_sDivision);
		
		$sQuery = sprintf("SELECT dty_no_of_free_entries 
							FROM divisions_to_years
							WHERE dty_year_for_division = %d
							AND divisions_id_division = %d
							LIMIT 1",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($iIDDivision));	
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]["dty_no_of_free_entries"];	
	}	

	public function getNumberOfPlayersInFinals($a_iYear, $a_sDivision)
	{
		// get the division id
		$oDivision = new Division();
		$iIDDivision = $oDivision->getDivisionIDFromShortName($a_sDivision);
		
		$sQuery = sprintf("SELECT dty_no_of_players_in_finals 
							FROM divisions_to_years
							WHERE dty_year_for_division = %d
							AND divisions_id_division = %d
							LIMIT 1",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($iIDDivision));	
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]["dty_no_of_players_in_finals"];	
	}

	public function divisionIsFree($a_sDivision, $a_iYear)
	{
		$sQuery = sprintf("SELECT divisions_to_years.dty_is_free
							FROM divisions_to_years
							JOIN divisions
							ON divisions_to_years.divisions_id_division = divisions.id_division
							WHERE divisions.division_name_short = '%s'
							AND divisions_to_years.dty_year_for_division = %d",
							$this->oDB->escape($a_sDivision),
							$this->oDB->escape($a_iYear));	

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		if($aRes == null)
			return false;

		if($aRes[0]['dty_is_free'] == 1)
			return true;
		else
			return false;
	}
}
?>