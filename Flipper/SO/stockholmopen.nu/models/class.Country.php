<?php
require_once("class.Model.php");

class Country extends Model
{
	public function getAllCountries()
	{
		$sQuery = sprintf("SELECT * FROM countries
							ORDER BY country_name ASC");			

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes;	
	}	
	
	public function getAllCountryNames()
	{
		$sQuery = sprintf("SELECT country_name FROM countries
							ORDER BY country_name ASC");			

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes;	
	}
	
	
	public function getAllCountriesIDs()
	{
		$sQuery = sprintf("SELECT id_country FROM countries
							ORDER BY country_name ASC");	
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes;	
	}
	
	public function getCountryFromID($a_iIDCountry)
	{
		$sQuery = sprintf("SELECT * FROM countries
							WHERE id_country = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDCountry));	
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes[0];			
	}
}
?>