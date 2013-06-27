<?php
require_once("class.Model.php");

class TournamentSetting extends Model
{
	public function getTournamentSettings($a_iYear)
	{
		$sQuery = sprintf("SELECT * FROM tournament_settings
							WHERE ts_year_for_settings = %d
							LIMIT 1",
							$this->oDB->escape($a_iYear));	
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;
	}
	
	/*
	public function getNumberOfRoundsPerEntry($a_iYear)
	{
		$sQuery = sprintf("SELECT ts#remove#_number_of_rounds_per_entry 
							FROM tournament_settings
							WHERE ts_year_for_settings = %d
							LIMIT 1",
							$this->oDB->escape($a_iYear));	

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]["ts_number_of_rounds_per_entry"];	
	}
	*/

}
?>