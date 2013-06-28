<?php
	require_once('../classes/baseClassList.php');
	function __autoload($class_name) {
		$classesPath='../classes/';
		require_once($classesPath . str_replace('_','/',$class_name) . '.php');
	}
	session_start();

	header('Content-Type: text/html; charset=UTF-8');
	if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
		ob_start("ob_gzhandler"); 
	else 
		ob_start();
 	date_default_timezone_set("Europe/Stockholm");
 	
 	//Get config singleton and read configuration from the .cnf file
	$conf=config_conf::getSingleton();
	$conf->readDefinitions(dirname(__FILE__) . '/config/sportstat.cnf');

	//Check for user preferences
	$sess=new data_session();
	if($sess->getLoggedInUserPrefsPath()) {
		$conf->readDefinitions(dirname(__FILE__) . '/config/'.$sess->getLoggedInUserPrefsPath());
	}	
 
	//Create a new language object with the language stated in the config or in the session cookie
	if(!isset($_SESSION['stats_lang']))
		$lang=lang_lang::getSingleton($conf->get('lang'));
	else
		$lang=lang_lang::getSingleton($_SESSION['stats_lang']);

	data_dataStore::clearStore();
	
	//Create data access objects
	$db = new data_database ('read_only');
	$db->selectDB($conf->get('db_name'));
	$dr=new data_dataReader($db,$lang);
	
	//Get id and name of "my team" from config
	$myTeam=$conf->get('my_team');
	$myTeamName=$conf->get('my_team_name');

	$languageCodes=explode(',',$conf->get('available_langs'));
	$languages=array();
	foreach($languageCodes as $langCode) {
		$languages[$langCode]=$lang->getLanguageIdForCode($langCode);
	}

	//Cache objects with complex relations	
	
	data_relationsManager::resolveRoleRelations();
?>