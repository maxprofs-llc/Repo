<?php
// does this code suck or what? i will just use it for some primitive benchmarking while developing though
// ugly hack to not flush the query-log, and the writing of queries
define("OVERRIDE_QUERY_FLUSH", true);
define("OVERRIDE_QUERY_WRITE", true);

require_once("../config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "models/class.User.php");
$oUser = new User();
// make sure the user is an uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

require_once("toolsMenu.php");

$aLines = @file(LOG_FILE_PAGE_QUERY);
$dTotalTime = 0;
$iQueries = 0;
$sPage = $aLines[0];
foreach($aLines as $line)
{
	if(preg_match("/Time/", $line))
	{
		$iStrLen = strlen($line);
		$dTime = substr($line,6,$iStrLen);
		$dTotalTime = $dTotalTime + $dTime;
		$iQueries++;
	}
}

echo "$sPage<br />";
echo "Total query time: " . round($dTotalTime,2) . "s<br />";
echo "Number of queries: " . $iQueries . "<br />";
echo "<h3>Queries:</h3>";

foreach($aLines as $line)
{
	echo $line . "<br />";
}

require_once(BASE_DIR . "includes/inc.end.php");
?>