<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "models/class.User.php");
$oUser = new User();
// make sure the user is an uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

echo "<h3>Reading the \"" . LANGUAGE . "\" textfile</h3>";

//$sSearch = "/^" . $a_sDefinition . "/";
// read the textfile
$aLines = file(BASE_DIR . "views/configs/lang/" . LANGUAGE . "/config." . LANGUAGE . ".lang.php");
$aStored = array();
$i = 0;
foreach($aLines as $val)
{
	if($val != null && strlen($val) > 1)
	{
		if($i == 0)
			array_push($aStored, $val);
		else
		{
			if(!in_array($val, $aStored))
				array_push($aStored, $val);
			else
				echo "$val is in the array (= duplicate)<br />";
		}
	}		
	$i++;
}

require_once(BASE_DIR . "includes/inc.end.php");
?>