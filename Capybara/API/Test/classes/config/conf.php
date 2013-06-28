<?php
	class config_conf {

	    private static $instance;	//Holds instance for Singleton class
		protected $configs;			//Array of config values
		protected $haveRead;			//List of files that has been read
		public $standardDirectory='';
		
		protected function __construct($standardDirectory='') {
			$this->standardDirectory=$standardDirectory;
			if(file_exists('default.cnf'))
			{
				$this->readDefinitions('default.cnf');	
			}
		}
		
		function __invoke($string) {	//From PHP 5.3.0 this gives the opportunity to call as conf('name') instead of conf->get('name')
			return $this->get($string);
		}
		
		function resetDefinitions() {	//Clear all config values
			$this->configs=array();
			$this->haveRead=array();
		}
		
		function availableFiles() {
			$files=array();
			foreach (scandir($this->standardDirectory) as $file) {
				if(preg_match('^.+\.((cnf))$^',$file))
					$files[$file]=$file;
			}
			return $files;
		}
		
		function readDefinitions($filename,$throwError=true)	//Read config values from a file
		{
			helper::debugPrint('Attempt to read from '.$filename,'conf');
			if(!file_exists($filename))
			{
				helper::debugPrint('Attempt failed.','conf');
				$filename = $this->standardDirectory . $filename; 
				helper::debugPrint('Attempt to read from '.$filename,'conf');
			}
			if(!isset($this->haveRead[$filename])) {
				if(!file_exists($filename))
				{
					if($throwError)
						trigger_error('Failed to load config file ' . $filename . '. File not found.',E_USER_ERROR);
					else
						return;
				}
				$lines = file($filename);
				foreach($lines as $line)
				{
					if(preg_match('/[a-zA-Z0-9]/',$line[0]))
					{ 
						list($name, $value) = explode('=',$line);
						$this->add($name,$value);
					}
				}
				$this->haveRead[$filename]=true;
			}	
		}
		
		function add($name,$value) {
			//Normalize name
			$name = trim($name);
			$name = preg_replace('/[^a-zA-Z0-9]/','',$name);
			$name = preg_replace('/[\s]/','',$name);
			$name = str_replace('_','',$name);
			$name = strtoupper($name);	
	
			if(!is_array($value))
				$value = trim($value);
			$this->configs[$name]=$value;					

		} 

		function get($name,$default='') {		//Retrieve config value
			helper::debugPrint("Config get: $name","conf");
			//Normalize name
			$name = preg_replace('/[^a-zA-Z0-9]/','',$name);
			$name = preg_replace('/[\s]/','',$name);
			$name = str_replace('_','',$name);
			$name = strtoupper($name);			
			if(isset($this->configs[$name]))
				$return=$this->configs[$name];
			else
				$return=$default;
			helper::debugPrint("Return: $return","conf");
			return $return;
		}
		
		function set($name,$value) {
			self::$instance->configs[$name]=$value;
		}
	
		public static function getSingleton() 	//Get singleton instance of class
		{
			if (!isset(self::$instance)) {
				$c = __CLASS__;
				self::$instance = new $c;
			}
	
			return self::$instance;
		}			
	}
?>