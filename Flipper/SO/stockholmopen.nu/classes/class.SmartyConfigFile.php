<?php
class SmartyConfigFile
{
	private $sFileName;
	// todo: add support for multiple languages
	public function __construct($a_sFileName)
	{
		$this->sFileName = $a_sFileName;			
	}
	
	public function getStringFromDefinition($a_sDefinition)
	{
 		
		$sSearch = "/^" . $a_sDefinition . "=/";
		// read the textfile
		$aLines = @file($this->sFileName);
		if(is_array($aLines))
		{
			foreach($aLines as $val)
			{
				if(preg_match($sSearch, $val))
				{
					$aSplit =  preg_split('/=/', $val, -1);
					return trim($aSplit[1]);
				}
			}
		}
		
		return null;
	}
	
	public function getInputClasses()
	{
		$aInput["default"] = $this->getStringFromDefinition("INPUT_DEFAULT_CLASS");
		$aInput["req"] = $this->getStringFromDefinition("INPUT_REQUIRED_CLASS");
		$aInput["submit"] = $this->getStringFromDefinition("INPUT_SUBMIT_DEFAULT");
		
		return $aInput;
	}
}
?>