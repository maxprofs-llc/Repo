<?php
// hard-coded stuff, for just two lang files (en & sv)
require_once("../config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "models/class.User.php");
$oUser = new User();
// make sure the user is an uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

require_once("toolsMenu.php");

function readLangFileToArray($a_sFilename)
{
	$aLines = file($a_sFilename);
	$aFile = array();
	$i = 0;
	foreach($aLines as $val)
	{
		if(strlen($val) > 1)
		{
			$aSplit =  preg_split('/=/', $val, -1);
			array_push($aFile, $aSplit[0]);
		}
	}
	
	return $aFile;
}

$sFilename = BASE_DIR . "views/configs/lang/en/config.en.lang.php";
$aFile1 = readLangFileToArray($sFilename);

$sFilename = BASE_DIR . "views/configs/lang/sv/config.sv.lang.php";
$aFile2 = readLangFileToArray($sFilename);

$bError = false;
// file1 (the english) is the "original"
foreach($aFile1 as $val)
{
	if(!in_array($val, $aFile2))
	{
		echo $val . " - is missing in the 2nd file<br />";	
		$bError = true;
	}
}

if(!$bError)
{
	echo "Everything seems to be in order.";
}

require_once(BASE_DIR . "includes/inc.end.php");
?>