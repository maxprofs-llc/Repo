<?php
	require_once('/usr/local/www/rodentia.se/beta/classes/baseClassList.php');
	function __autoload($class_name) {
		if(file_exists(__DIR__."/classes/". str_replace('_','/',$class_name) . '.php'))
			require_once(__DIR__."/classes/" . str_replace('_','/',$class_name) . '.php');
		else {
			$classesPath='/usr/local/www/rodentia.se/beta/classes/';
			require_once($classesPath . str_replace('_','/',$class_name) . '.php');
		}
	}
	config_conf::getSingleton()->add('classesPath',$classesPath);
	config_conf::getSingleton()->add('publicClassesPath',"/beta/classes/");
	
?>