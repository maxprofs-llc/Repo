<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.User.php");

 	$sUsername = $oHTTPContext->getString("user");
 	$sPassword = $oHTTPContext->getString("password");

 	echo "user: " . $sUsername;
 	echo ", pw: " . $sPassword;
	
require_once(BASE_DIR . "includes/inc.end.php");
?>

