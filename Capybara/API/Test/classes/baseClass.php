<?php

abstract class baseClass {

	public static $doNotSerialize=false;

	public $id;					//Id in database
	public $name;				//Name, if provided
	public $privateComment;		//Comment for internal use
	public $publicComment;		//Comment for external use
	public $strings;			//Language strings
	public $noJSON;				//Array of properties to not include in JSON-object
	public $status;
	public $statusMsg;
	public $cached=false;
	public $verboseSerialization=false;

	public $_name;				//This should never be used from PHP, use getName(). $_name is only included for JSON to be output correctly.
	public $_string;
	public $_longString;

	public abstract function getName();

	public $jsonCached=false;
	protected $json=NULL;

	public $xmlCached=false;
	protected $xml=NULL;

	public $htmlCached=false;
	protected $html=NULL;

	public function __construct() {
		$this->strings=array();
		$this->noJSON=array('noJSON');
	}

	public function prepareForSerialization() {
		helper::debugPrint("Prepare for serialization: ".get_class($this),"serialization");
		$this->minimumPrepareForSerialization();
	}

	public function minimumPrepareForSerialization() {
		helper::debugPrint("Minimum prepare for serialization: ".get_class($this),"serialization");
		$this->_name=$this->getName();
		$this->_string=$this->getLongString();
		$this->_longString=$this->getLongString();
	}

	public function getLongString() {
		return $this->__toString();
	}

	public function getJSON($forceRebuild=false) {
		$this->minimumPrepareForSerialization();
		if(!$this->jsonCached && $this->cached)
			$forceRebuild=true;
		//if(is_null($this->json) || $forceRebuild) {
			$this->json=Encoding_JSON::encode($this);
			$this->jsonCached=$this->cached;
		//}
		return $this->json;
	}

	public function getXML($forceRebuild=true) {
		$this->minimumPrepareForSerialization();
		if(!$this->xmlCached && $this->cached)
			$forceRebuild=true;
		//if(is_null($this->json) || $forceRebuild) {
			$this->xml=Encoding_XML::encode($this);
			$this->xmlCached=$this->cached;
		//}
		return $this->xml;
	}

	public function getHTML($forceRebuild=true, $type = 'div') {
		// $type can (so far) be "div", "table", "list" and "select"
		$this->minimumPrepareForSerialization();
		if(!$this->htmlCached && $this->cached)
			$forceRebuild=true;
		//if(is_null($this->json) || $forceRebuild) {
			$this->html=Encoding_HTML::encode($this, false, NULL, $type);
			$this->htmlCached=$this->cached;
		//}
		return $this->html;
	}

	function __sleep() {
		$this->minimumPrepareForSerialization();
		if($_GET['verbose']==1 || $this->verboseSerialization)
			$this->prepareForSerialization();
		$props=get_object_vars($this);
		$list=array();
		foreach($props as $prop=>$value) {
			if(is_null($this->noJSON) || !in_array($prop,$this->noJSON))
				$list[]=$prop;
		}
		return $list;
	}

	public function __get($name) {
		$traces = debug_backtrace();
        foreach($traces as $trace) {
            $stack.=$trace['file'] .
            ' on line ' . $trace['line']."<br>";
        }
        trigger_error(
            'Undefined property via __get(): ' . $name .'<br>'.
            'Stacktrace: <br>'.$stack,
            E_USER_NOTICE);
        return null;
	}

	public function __set($name,$value) {
		$trace = debug_backtrace();
        trigger_error(
            'Undefined property via __set(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
	}

	public function __toString() {
		return $this->getName();
	}


	/*
	public function getData($row,$prefix='') {
		helper::safeSetProperty($this,'id',$row,$prefix . 'id');
		helper::safeSetProperty($this,'name',$row,$prefix . 'name');
		helper::safeSetProperty($this,'internalComment',$row,$prefix . 'internalComment');
		helper::safeSetProperty($this,'externalComment',$row,$prefix . 'externalComment');
	}
	*/

	public function getData($row,$prefix='') {
		$props=get_object_vars($this);
		foreach($props as $prop => $value) {
			helper::safeSetProperty($this,$prop,$row,$prefix . $prop);
		}
		$this->getNecessaryData();
	}

	public function getNecessaryData() {
	}
	
	public function getFunction($arg) {
		$arg=strtolower($arg);
		if($arg=="name") {
			return null;
		}
		return "get".ucfirst($arg);
	}
}
?>