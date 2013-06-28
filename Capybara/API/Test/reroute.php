<?php
	require_once("_define.php");

	helper::debugPrint("Reroute began","reroute");
	helper::debugPrint("Server variables: ".json_encode($_SERVER),"reroute");
	$requestURI=str_replace("?".$_SERVER['QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
	$requestURI = explode('/', $requestURI);
	helper::debugPrint("Created parameter array","reroute");
	if(!$api=array_search("api",$requestURI))
		$api=array_search("api.rodentia.se",$requestURI);
	helper::debugPrint("Searched for api","reroute");
	if($api) {
		header("Access-Control-Allow-Origin: *");
		helper::debugPrint("API","api");
		$args=array_slice($requestURI,$api+1,count($requestURI));
		if(count($args)==0 || $args[0]=='') {
			//Reroute to api controller. Send [1] as argument to render index instead of list. Send the url of the request as model.
			$ctrl=new controllers_apiController(null,array(1));
			die();
		}
		if(!$sess->checkLogin(false,false))
			dieWithError($sess->error);
		helper::debugPrint("Args: ".json_encode($args),"api");
		api_api::serialize($args,$_GET['format']);
		die();
	}
	helper::debugPrint("No api found, look for ViewController","reroute");
	$api=new api_apidata(explode("/",str_replace("beta","",str_replace("?".$_SERVER['QUERY_STRING'],"",$_SERVER['REQUEST_URI']))));
	if($api->getClass()->controller!='') {
		helper::debugPrint("View Controller found: ".$api->getClass()->controller,"reroute");
		$model=$api->getList();
		$route=$api->getClass()->remainingArgs;
		$class="controllers_".$api->getClass()->controller."Controller";
		if(class_exists($class)) {
			helper::debugPrint("Instantiate $class","reroute");
			$ctrl=new $class($model,$route);
		}
	}
	/*
	$class=findController($requestURI);
	if($class) {
		$ctrl=new $class($requestURI);
	}
	
	function findController($array) {
		if(class_exists("controllers_".$array[count($array)-1]))
			return "controllers_".$array[count($array)-1];
		if(count($array)==1)
			return false;
		$array=array_slice($array,0,count($array)-1,true);
		return findController($array);
	}
	*/
	
	function dieWithError($err) {
		die(json_encode(array('error'=>$err)));
	}
?>