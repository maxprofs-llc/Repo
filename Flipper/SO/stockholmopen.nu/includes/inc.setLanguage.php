<?php
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.Validator.php");

if(MULTIPLE_LANGUAGES == "true")
{
	$oValidator = new Validator();
	$aValidLanguages = array("en", "sv");
	
	$oHTTPContext = new HTTPContext();
	$sLang = $oHTTPContext->getString("sLang");
	
	// make sure it's a valid language, if it's posted
	if(!$oValidator->validValues($aValidLanguages, $sLang) && $sLang != null)
		$sLang = DEFAULT_LANGUAGE; // if it's not, set it to default language
		
	if($sLang != null)
	{	
		// a language change is selected, set language in a cookie
		setcookie("sLang", $sLang, strtotime('+1 year'), "/");
	}
	else
	{
		// check if we've got a cookie value
		$sLang = $oHTTPContext->getCookieString("sLang");
		if($sLang == null)
		{
			// if we haven't got a cookie, set the default language
			setcookie("sLang", DEFAULT_LANGUAGE, strtotime('+1 year'), "/");
			$sLang = DEFAULT_LANGUAGE;
		}
	}
}
else
{
	// if the multiple languages is set to "off" in the config, always use english
	$sLang = DEFAULT_LANGUAGE;
}

define("LANGUAGE", $sLang);
$aSmartyConfig = unserialize(TEMPLATE_CONFIG);
define("LANG_CONFIG_FILE", $aSmartyConfig['smartyConfigDir'] . "lang/" . $sLang ."/config." . $sLang . ".lang.php");
define("LANG_COUNTRY_FILE", $aSmartyConfig['smartyConfigDir'] . "lang/" . $sLang ."/config." . $sLang . ".countries.php");
?>