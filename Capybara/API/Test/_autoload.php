<?php
	define('ROOT', dirname(__FILE__));
	require_once('/usr/local/www/rodentia.se/beta/classes/baseClassList.php');
	function __autoload($class_name) {
		$classesPath='/usr/local/www/rodentia.se/stats/api/classes/';
		if(file_exists($classesPath . str_replace('_','/',$class_name) . '.php'))
			require_once($classesPath . str_replace('_','/',$class_name) . '.php');
		else {
			echo "Class not found: $class_name<br>";
			$traces = debug_backtrace();
	        foreach($traces as $trace) {
	            $stack.=$trace['file'] .
	            ' on line ' . $trace['line']."<br>";
	        }
	        echo $stack;
		}
	}
	config_conf::getSingleton()->add('classesPath',$classesPath);
	config_conf::getSingleton()->add('publicClassesPath',"/beta/classes/");
	
?>