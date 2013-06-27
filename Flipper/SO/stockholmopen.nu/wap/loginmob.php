
<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.User.php");

	$sUsername = $oHTTPContext->getString("user");
	$sPassword = $oHTTPContext->getString("password");

	if($sUsername != null && $sPassword != null)
	{
		$oUser = new User();
		if(!$oUser->logIn($sUsername, $sPassword)){
			echo "statusCode=1";
		} else {
			echo "statusCode=0";
		}
	} else {
		echo "statusCode=1";
	}

?>

