<?php
if(!defined('SID'))
	session_start();
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "classes/class.URL.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
require_once(BASE_DIR . "models/class.TournamentStats.php");
require_once(BASE_DIR . "models/class.UserActivity.php");

$oLogFile = new LogFile();
// check if we should flush/delete the query-log-file on every page,
if(FLUSH_QUERY_LOG)
{
	if(!defined('OVERRIDE_QUERY_FLUSH'))
	{
		// unless we wan't to override the flush, on certain info-pages
		$oLogFile->deleteFile(LOG_FILE_PAGE_QUERY);
	}
}

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);

$oUser = new User();
$oHTTPContext = new HTTPContext();
$oUserActivity = new UserActivity();

// assign some (global-ish) variables to the template
$oTemplate->assign("g_sPage", str_replace("&", "&amp;",$_SERVER['REQUEST_URI']));
$oTemplate->assign("g_sPage", $_SERVER['SCRIPT_NAME']);
$oTemplate->assign("g_bMultLang", MULTIPLE_LANGUAGES);
$oTemplate->assign("g_aLanguages", unserialize(A_LANGUAGES));
$oTemplate->assign("g_sSupportEmail", unserialize(A_LANGUAGES));
//$oTemplate->assign("g_bLoginFailed", $oHTTPContext->getString("bLoginFailed"));
$oTemplate->assign("g_aActiveUsers", $oUserActivity->getActiveUsers());
$oTemplate->assign("g_aActiveGuests", $oUserActivity->getActiveGuests());
$oTemplate->assign("g_sEmailAdmin", EMAIL_ADMIN);

// ugly hack for the language-change-url's:
$oURL = new URL();
$sURL = $oURL->getCurrentRelativeURL();
$cPrefix = $oURL->getPrefixToUseForVar();
// if the request_uri is less than 5 chars, we're (probably, well...) at the start page
if(strlen($sURL) < 5)
{
	$sURL = "index.php";
}
	
$oTemplate->assign("g_sPageLangChange", $sURL . $cPrefix);
$oTemplate->assign("g_iYear", YEAR);

// assign the logged in user, if any, to smarty
if($oUser->isLoggedIn())
{
	if(USE_HTTPS)
	{
		if(!isset($_SERVER['HTTPS']) || strtolower($_SERVER['HTTPS']) != 'on' )
		{
			header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			exit;
		}
	}
	
	$oTemplate->assign("g_aUser", $oUser->getLoggedInUsername());
	$oTemplate->assign("g_bIsLoggedIn", "true");
	// get the user's admin rights
	$oTemplate->assign("g_aUserAdminTasks", $oUser->getAllAdminTasksForLoggedInUser());
}
else
{
	$oTemplate->assign("g_bIsLoggedIn", "false");
}
// set the tournament settings
require_once(BASE_DIR . "config/inc.config.tournamentSettings.php");
$oTemplate->assign("g_bSplitActive", TS_SPLIT_ACTIVE);

// build, and assign the years with results
require_once(BASE_DIR . "functions/func.getYearsWithResults.php");
$aYearsWithResults = getYearsWithResults(TEMPLATE_DIR, "results", ".tpl.php");
rsort($aYearsWithResults);
$oTemplate->assign("g_aYearsWithResults", $aYearsWithResults);
// build, and assign the years and divisions with final-results
require_once(BASE_DIR . "functions/func.getYearsAndDivisionsWithFinals.php");
$aYearsWithFinals = getYearsAndDivisionsWithFinals(TEMPLATE_DIR . "finals/");
$oTemplate->assign("g_aYearsWithFinals", $aYearsWithFinals);

// include the title config-file
require_once(TITLE_CONFIG_FILE);
$sScriptName = substr($_SERVER['SCRIPT_NAME'], 1, strlen($_SERVER['SCRIPT_NAME']));
// set the title, if there are any in the $aTitles array from the config-file
if(isset($aTitles[$sScriptName]))
	$sTitle = $aTitles[$sScriptName];
else
	$sTitle = null;
	
// assign the title to the template
$oTemplate->assign("g_sTitle", $sTitle);
	
$oDivisionsToYears = new DivisionsToYears();
// get and assign the current year's divisions
$oTemplate->assign("g_aCurrentYearsDivisions", $oDivisionsToYears->getDivisionsFromYear(YEAR));

// build and assign the years and divisions for the standings links
$oTemplate->assign("g_aYearsAndDivisions", $oDivisionsToYears->getDivisionsAndYears());

// build and assign the years for the gallery-links, we can start with 2004
require_once(BASE_DIR . "functions/func.getYearsWithGallery.php");
$aYearsWithGallery = getYearsWithGallery(BASE_DIR . GALLERY_DIR);
// reverse this for the menu
rsort($aYearsWithGallery);
$oTemplate->assign("g_aYearsWithGallery", $aYearsWithGallery);

// write the loaded page to the logfile
$oLogFile->writePageLoad(LOG_FILE_PAGE_LOAD);

// some stuff to check if javascript is enabled
require_once(BASE_DIR . "includes/inc.checkJavascript.php");
// used to check Old IE versions
require_once(BASE_DIR . "includes/inc.checkOldIE.php");

// only display the debug-stuff to a logged-in uber-admin
if(DEBUG && $oUser->isAdminDynamic("admin_uber"))
{
	require_once(BASE_DIR . "includes/debug.php");
}

?>