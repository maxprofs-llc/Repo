<?php	
	$lastTimeStamp=microtime(true);
	include_once('../_define.php');
	session_cache_limiter('public');
	
	helper::$lastTimeStamp=$lastTimeStamp;
	helper::printTimeStamp("*** Time to read definitions ***");
	
	if(isset($_GET['countryid']))
		$cid=$_GET['countryid'];
	else
		$cid=false;
			
	if(isset($_GET['stateid']))
		$sid=$_GET['stateid'];
	else
		$sid=false;
		
	helper::printTimeStamp("*Create list*");
	if(isset($_GET['id']))
		$cities=$dr->getGenericById($_GET['id'],'city','ci','location_city');
	else
		$cities=$dr->getCityList(true,$cid,$sid);
	helper::printTimeStamp("*List created, create JSON*");
	print $cities->getJSON(false);
	helper::printTimeStamp("*JSON created*");
?>