<?php

	class api_classApi {
		
		public $error;
		public $list;
		
		function __construct($args,$parameters=false) {		
			if(!$parameters)
				$this->parameters=$_GET;
			else
				$this->parameters=$parameters;
			
			$obj=new Api();
			while(count($args>0) && $args[0]!="") {
				$arg=array_shift($args);
				helper::debugPrint("Arg: $arg","api");
				$var=false;
				if(count($args)>0 && is_numeric($args[0])) {
					$var=array_shift($args);
				}
				if(!$obj instanceof Traversable) {	
					$func=$obj->getFunction($arg);
					if(method_exists($obj,$func)) {
						$obj=$obj->$func($var);
					} else {
						$this->error="Invalid argument $arg";
						return;
					}
				} else {
					$this->error="Subqueries on arrays are not yet supported.";
					return;
				}
			}
			$this->list=$obj;
		}
		
		function printJSON() {
			if(!$this->error) {
				$time=microtime(true);
				$json=$this->list->getJSON(true);
				$time=microtime(true)-$time;
				print '[{"status":"success"},{"data":'.$json.'},{"paging":{"next":"'.$next.'","prev":"'.$prev.'"}},{"time":"'.$this->time.'","serialization":"'.$time.'"}]';
			} else {
				print '[{"status":"error"},{"message":"Invalid query: '.$this->error.'"}]';
			}
		}
		
	}
	
	class Api extends BaseClass {
		
		function getCountries($id=false) {
			if($id)
				return data_dataStore::getProperty('dataReader')->getCountryById($id);
			else
				return data_dataStore::getProperty('dataReader')->getCountryList();
		}
		
		function getName() {
			return;
		}
		
		function getTeams($id=false) {
			if($id)
				return data_dataStore::getProperty('dataReader')->getTeamById($id);
			else
				return data_dataStore::getProperty('dataReader')->getTeamList();			
		}
		
		function getMe() {
			return $this->getTeams(config_conf::getSingleton()->get('my_team'));
		}
	}

?>