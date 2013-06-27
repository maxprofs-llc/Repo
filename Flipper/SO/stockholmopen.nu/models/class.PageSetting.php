<?php
require_once("class.Model.php");

class PageSetting extends Model
{
	// there is a post in the db with id_page_setting = 1, that holds some values
	// that are used on certain places in the site
	
	function getPageSettings()
	{		
		$sQuery = "SELECT * 
					FROM page_settings
					WHERE id_page_setting = 1
					LIMIT 1";
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0];
	}

	function insertFlushTime()
	{
		$sQuery = "UPDATE page_settings
					SET user_activity_last_flush = '" . date("Y-m-d H:i:s") ."'
					WHERE id_page_setting = 1";

		$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);
	}
}
?>