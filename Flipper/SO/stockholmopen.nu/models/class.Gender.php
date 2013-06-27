<?php
require_once("class.Model.php");

class Gender extends Model
{
	function getAllGenders()
	{
		$sQuery = sprintf("SELECT * FROM genders
							ORDER BY gender_name ASC");	
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;	
	}	
	
	function getAllGenderNames()
	{
		$sQuery = sprintf("SELECT gender_name FROM genders
							ORDER BY gender_name ASC");	
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;	
	}
	
	
	function getAllGenderIDs()
	{
		$sQuery = sprintf("SELECT id_gender FROM genders
							ORDER BY gender_name ASC");	
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		return $aRes;	
	}
}
?>