<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.User.php");

$oUser = new User();
$oHTTPContext = new HTTPContext();

if(USE_HTTPS)
	$sRedirect = ereg_replace("//","/",ereg_replace("^https","http",BASE_URL . $oHTTPContext->getString("sRedirect")));
else
	$sRedirect = $oHTTPContext->getString("sRedirect");
	
$oUser->logOut();

//if($sRedirect != null)
	//header("Location: " . $sRedirect);
//else
header("Location: " . BASE_URL . "logout.php");
?>