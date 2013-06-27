<?php

class URL
{
	public function getCurrentRelativeURL($a_bEscape = true)
	{
		if($a_bEscape)
			$sUrl = str_replace("&", "&amp;", $_SERVER['REQUEST_URI']);
		else
			$sUrl = $_SERVER['REQUEST_URI'];
					
		return $sUrl;
	}
	
	public function getPrefixToUseForVar($a_sURL = null)
	{
		if($a_sURL)
			$sURL = $a_sURL;
		else
			$sURL = $_SERVER['REQUEST_URI'];
			
		$cPrefix = "&amp;";
		if(substr($sURL,(strlen($sURL)-4),4) == ".php")
			$cPrefix = "?";
			
		return $cPrefix;
	}
}

?>