<?php
require_once("class.Model.php");

class GameManufacturer extends Model
{
	function getAllManufacturerNames()
	{
		$sQuery = sprintf("SELECT game_manufacturer_name FROM game_manufacturers
							ORDER BY game_manufacturer_name ASC");	
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;	
	}
	
	
	function getAllManufacturerIDs()
	{
		$sQuery = sprintf("SELECT id_game_manufacturer FROM game_manufacturers
							ORDER BY game_manufacturer_name ASC");	
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		return $aRes;	
	}
}
?>