<?php
require_once("class.Model.php");

class Division extends Model
{
	public function getDivision($a_iIDDivision)
	{
		$sQuery = sprintf("SELECT *
							FROM divisions
							WHERE id_division= %d
							LIMIT 1",
							$this->oDB->escape($a_iIDDivision));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
					
		return $aRes[0];		
	}

	public function getDivisionFromID($a_iIDDivision)
	{
		$sQuery = sprintf("SELECT * FROM divisions
							WHERE id_division = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDDivision));	
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes[0];			
	}	

	public function getDivisionIDFromShortName($a_sDiv)
	{
		$sQuery = sprintf("SELECT id_division FROM divisions
							WHERE division_name_short = '%s'
							LIMIT 1",
							$this->oDB->escape($a_sDiv));	
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes[0]['id_division'];			
	}

	public function getShortNameFromID($a_iDiv)
	{
		$sQuery = sprintf("SELECT division_name_short FROM divisions
							WHERE id_division = %d
							LIMIT 1",
							$this->oDB->escape($a_iDiv));	
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes[0]['division_name_short'];			
	}	
	
	public function getDivisionLongNameFromShortName($a_sDiv)
	{
		$iIDDivision = $this->getDivisionIDFromShortName($a_sDiv);
		$aDivision = $this->getDivisionFromID($iIDDivision);
		return $aDivision['division_name'];
	}
	
	public function getAllDivisions()
	{
		$sQuery = sprintf("SELECT * FROM divisions
							ORDER BY division_name ASC");	
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;	
	}	
	
	public function getAllDivisionShortNames($a_sYear = null, $bGetSplit = true)
	{
		$sWhere = null;
		if($bGetSplit == false)
			$sWhere = "WHERE division_name_short != 'S'";
			
		if($a_sYear == null)
		{
			$sQuery = sprintf("SELECT division_name_short FROM divisions
								" . $sWhere . "
								ORDER BY division_name_short ASC");	
		}
		else
		{
			$sAnd = null;
			if($bGetSplit == false)
				$sAnd = "AND division_name_short != 'S'";

			$sQuery = sprintf("SELECT divisions.division_name_short
							FROM divisions
							JOIN divisions_to_years
							ON divisions.id_division = divisions_to_years.divisions_id_division
							WHERE divisions_to_years.dty_year_for_division = '%s'"
							. $sAnd . " ",	
							$this->oDB->escape($a_sYear));		
		}
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;			
	}
	
	public function getAllDivisionShortNamesPlainArray($a_sYear = null, $bGetSplit = true)
	{
		$aArr = $this->getAllDivisionShortNames($a_sYear, $bGetSplit);
		$aRet = array();
		
		foreach($aArr as $value)
		{
			array_push($aRet, $value["division_name_short"]);
		}
		
		return $aRet;
	}
	
	public function getAllDivisionNames($a_sYear = null, $bGetSplit = true)
	{
		$sWhere = null;
		if($bGetSplit == false)
			$sWhere = "WHERE division_name_short != 'S'";
			
		if($a_sYear == null)
		{
			$sQuery = sprintf("SELECT division_name FROM divisions
								" . $sWhere . "
								ORDER BY division_name ASC");	
		}
		else
		{
			$sAnd = null;
			if($bGetSplit == false)
				$sAnd = "AND division_name_short != 'S'";
				
			$sQuery = sprintf("SELECT divisions.division_name
								FROM divisions
								JOIN divisions_to_years
								ON divisions.id_division = divisions_to_years.divisions_id_division
								WHERE divisions_to_years.dty_year_for_division = '%s'"
								. $sAnd . " ",	
								$this->oDB->escape($a_sYear));		
		}
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;	
	}
	
	public function getAllDivisionNamesByYear($a_sYear, $bGetSplit = true, $a_bDontGetSpecialDivisions = false)
	{
		return $this->getAllDivisionNames($a_sYear, $bGetSplit);	
	}
	
	
	public function getAllDivisionIDs($a_sYear = null, $bGetSplit = true, $a_bDontGetSpecialDivisions = false)
	{
		$sWhere = null;
		if($bGetSplit == false)
			$sWhere = "WHERE division_name_short != 'S'";
			
		if($a_sYear == null)
		{
			$sQuery = sprintf("SELECT id_division FROM divisions
								" . $sWhere . "
								ORDER BY division_name ASC");	
		}
		else
		{
			$sAnd = null;
			if($bGetSplit == false)
				$sAnd = " AND division_name_short != 'S'";
			
			$aAndSpecial = null;
			if($a_bDontGetSpecialDivisions != false)
			{
				$aAndSpecial = " AND division_name_short != 'J' AND division_name_short != 'C'";
			}
			
			$sQuery = sprintf("SELECT divisions.id_division
								FROM divisions
								JOIN divisions_to_years
								ON divisions.id_division = divisions_to_years.divisions_id_division
								WHERE divisions_to_years.dty_year_for_division = '%s'"
								. $sAnd . $aAndSpecial . " ",	
								$this->oDB->escape($a_sYear));
		}
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		return $aRes;	
	}
	
	public function getAllDivisionIDsByYear($a_sYear, $bGetSplit = true, $a_bDontGetSpecialDivisions = false)
	{
		return $this->getAllDivisionIDs($a_sYear, $bGetSplit, $a_bDontGetSpecialDivisions);
	}
}
?>