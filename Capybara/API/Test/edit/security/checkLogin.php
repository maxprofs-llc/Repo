<?php
	$_GET['debug']="";
	require_once('../../_autoload.php');
	date_default_timezone_set("Europe/Stockholm");

	//Get config singleton and read configuration from the .cnf file
	$conf=config_conf::getSingleton();
	$conf->standardDirectory=dirname(__FILE__) . '/../config/';
	$conf->readDefinitions('sportstat.cnf');
		
	$sess=new data_session();	
	
	$return=new stdClass();
	
	if(!$sess->checkLogin(false,false)) {
		$return->status=$sess->error;
		if(is_null($sess->error))
			$return->status=$sess->secondError;
	} else {
		$return->status='ok';
		$return->timeLeftUntilLogout=$sess->timeLeftUntilLogout;
	}
	print json_encode($return);
?>