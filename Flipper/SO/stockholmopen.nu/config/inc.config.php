<?php
header('Content-Type: text/html;charset=ISO-8859-1');

// include the parameters that are likely to change from server to server
require_once("inc.config.basic.php");

// mdb needs an array
$aDsn['username'] = DB_USER;
$aDsn['password'] = DB_PASSWORD;
$aDsn['hostspec'] = DB_SERVER;
$aDsn['phptype'] = DB_PLATFORM;
$aDsn['database'] = DB_DATABASE;
define("DSN", serialize($aDsn));

define("DB_DATABASE2", "so_old");
$aDsn['database'] = DB_DATABASE2;
define("DSN2", serialize($aDsn));

// set the start time of the execution (we'll lose a few microseconds down here, never the less)
define("PAGE_LOAD_START", $sTimeStart = microtime(true));

// the smarty-config object is needed further down
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
// include some php.ini-ish settings
require_once("inc.config.phpSettings.php");

define("YEAR", Date("Y"));
//define("YEAR", "2007");
define("STANDINGS_CALCULATIONS_FILE", BASE_DIR . "cron/calculateStandings.php");
// debug 
define("DEBUG", false);

// email
define("EMAIL_SUPPORT", "the@pal.pp.se");
define("EMAIL_ADMIN", "webmaster@stockholmopen.nu");
$aNotifications[0] = "notifications@stockholmopen.nu";
define("EMAIL_NOTIFICATIONS", serialize($aNotifications));
define("EMAIL_NO_REPLY", "noreply@stockholmopen.nu");
define("EMAIL_MAIN", "info@stockholmopen.nu");

// some db-debugging-ish vars
define("DISPLAY_QUERY_ERRORS", false);
define("LOG_QUERY_DEBUG", true);
define("LOG_QUERY_ERRORS", true);
define("SLOW_QUERY_TIME", 0.5);
// this log will become pretty huge
define("LOG_QUERY", false);
// this will (temporary) log queries for every loaded page, just used for debugging purposes
// since it will be be overwritten every time someone loads a page
define("LOG_PAGE_QUERY", false);
// this is used to flush/clean out the page-query log every time a page is loaded
// if it's set to false it will work just as a normal log
define("FLUSH_QUERY_LOG", true);
// ... if we should log the active-users
define("LOG_ACTIVE_USERS", true);

// log-files
define("LOG_FILE_SLOW_QUERY", LOG_FOLDER . "query_slow.log");
define("LOG_FILE_SQL_ERROR", LOG_FOLDER . "sql_error.log");
define("LOG_FILE_CALC_STANDINGS", LOG_FOLDER . "time_calc_standings.log");
define("LOG_FILE_DETAILED_ENTRY_CALC", LOG_FOLDER . "time_calc_standings_detailed.log");
define("LOG_FILE_GET_STANDINGS", LOG_FOLDER . "time_get_standings.log");
define("LOG_FILE_GET_GAME", LOG_FOLDER . "time_get_game.log");
define("LOG_FILE_ERROR_LOG", LOG_FOLDER . "error.log");
define("LOG_FILE_PAGE_LOAD", LOG_FOLDER . "page_load.log");
define("LOG_FILE_PAGE_DATA", LOG_FOLDER . "page_data.log");
define("LOG_FILE_ENTRIES", LOG_FOLDER . "entries.log");
define("LOG_FILE_QUERY", LOG_FOLDER . "query.log");
define("LOG_FILE_QUERY_ERRORS", LOG_FOLDER . "query_error.log");
define("LOG_FILE_PAGE_QUERY", LOG_FOLDER . "query_page.log");
define("LOG_FILE_SEARCH", LOG_FOLDER . "searches.log");
define("LOG_FILE_LOGIN", LOG_FOLDER . "login.log");
define("LOG_FILE_LOGIN_FAILED", LOG_FOLDER . "login_failed.log");
define("LOG_FILE_ACTIVE_USERS", LOG_FOLDER . "active_users.log");
define("LOG_FILE_TEAMS", LOG_FOLDER . "team.log");
define("LOG_FILE_FORMS_FAILED", LOG_FOLDER . "forms_failed.log");

// not used, changed to a single entry-log-file
//define("LOG_FILE_ENTRY_CREATED", LOG_FOLDER . "entry_created.log");
//define("LOG_FILE_ENTRY_UPDATED", LOG_FOLDER . "entry_updated.log");
//define("LOG_FILE_ENTRY_DELETED", LOG_FOLDER . "entry_deleted.log");

// text-files
define("TXT_FILE_SCORE_RANGE_FOLDER", BASE_DIR . "scoreRangeFiles/");

// count ..eh.. stuff
define("COUNT_CALC_STANDINGS_TIME", true);
define("COUNT_GET_STANDINGS_TIME", true);
define("COUNT_GET_GAME_TIME", true);

// smarty / template
$aTemplateConfig['smartyDir'] = BASE_DIR . "classes/smarty/libs/";
$aTemplateConfig['smartyTemplateDir'] = BASE_DIR . "views/templates/";
$aTemplateConfig['smartyComplieDir'] = BASE_DIR . "views/templates_c/";
$aTemplateConfig['smartyCacheDir'] = BASE_DIR . "views/cache/";
$aTemplateConfig['smartyConfigDir'] = BASE_DIR . "views/configs/";

define("SMARTY_DIR", $aTemplateConfig['smartyDir']);
define("TEMPLATE_DIR", $aTemplateConfig['smartyTemplateDir']);
define("TEMPLATE_CONFIG", serialize($aTemplateConfig));
define("INPUTS_CONFIG_FILE", $aTemplateConfig['smartyConfigDir'] . "config.inputs.php");
define("MENU_CONFIG_FILE", $aTemplateConfig['smartyConfigDir'] . "config.menu.php");
define("MAIN_CONFIG_FILE", $aTemplateConfig['smartyConfigDir'] . "config.main.php");
define("TITLE_CONFIG_FILE", $aTemplateConfig['smartyConfigDir'] . "config.titles.php");
// well, do we want to use caching or not... A few (db-intense) pages are using the cache
// however, caching is a bad idea for this site since it could lead to a lot of confusion
// when it comes to the links throughout the pages: an entry could be updated on total standings
// whereas it's not displayed in the game standings etc.
define("TEMPLATE_CACHING", false);
// cache-time for the standings (in seconds)
define("TEMPLATE_CACHE_TIME_STANDINGS", 10);
define("TEMPLATE_CACHE_TIME_GAME_STANDINGS", 10);

// multiple languages...
define("MULTIPLE_LANGUAGES", false);
define("DEFAULT_LANGUAGE", "en");

// set the language
require_once(BASE_DIR . "includes/inc.setLanguage.php");

// disabling functions
define("DISABLE_ENTRY_REG_FOR_OTHER_YEARS", true);
define("DISABLE_STANDINGS_CALC", false);

$aLanguages[0]['lang'] = "en";
$aLanguages[0]['img'] = "images/icons/flags/gb.gif";
$aLanguages[1]['lang'] = "sv";
$aLanguages[1]['img'] = "images/icons/flags/se.gif";
define("A_LANGUAGES", serialize($aLanguages));
define("TEMPLATE_LANG_FILE", $aTemplateConfig['smartyConfigDir'] . "lang/" . LANGUAGE . "/config." . LANGUAGE . ".lang.php");

// misc-ish stuff
define("GALLERY_DIR", "images/gallery/");
define("CUSTOM_SLIDE_DIR", TEMPLATE_DIR . "customSlide/");

// read the number-of-slide-posts from the smarty config-file
$oSmartyConfigFile = new SmartyConfigFile($aTemplateConfig['smartyConfigDir'] . "config.main.php");
$iNumberOfPosts = $oSmartyConfigFile->getStringFromDefinition("SLIDE_POSTS_PER_PAGE");
if($iNumberOfPosts == null)
	$iNumberOfPosts = 15;
	
define("SLIDE_POSTS_PER_PAGE", $iNumberOfPosts);
define("SLIDE_POSTS_PER_PAGE_GAMES", 6);

// currencies that are used to pay with
$aCurrencies = array("SEK", "EUR", "USD", "GBP");
define("A_CURRENCIES", serialize($aCurrencies));

// T-shirt sizes
$aTShirtSizes = array("S", "M", "L", "XL", "XXL");
define("A_TSHIRT_SIZES", serialize($aTShirtSizes));

// T-shirt colors
$aTShirtColors = array("Blue", "Black");
define("A_TSHIRT_COLORS", serialize($aTShirtColors));

// TODO: remove this printArray function when it's not needed
require_once(BASE_DIR . "functions/func.printArray.php");

// include the init-script from here since this always will be included
// ... unless ... ehm ...
if(!isset($bExcludeInit))
	require_once(BASE_DIR . "init/inc.init.php");
?>
