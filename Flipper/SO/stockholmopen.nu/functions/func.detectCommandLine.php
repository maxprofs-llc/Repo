<?php
function detectCommandLine()
{

	$sSapiType = php_sapi_name();
	if(substr($sSapiType, 0, 3) == 'cli') 
	{
		return true;
	} 
	else 
	{
		return false;
	}
}
?>