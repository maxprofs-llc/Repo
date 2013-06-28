<?php
	class lang_lang {
	
	    private static $instance;	//Holds instance for Singleton class
		protected $languageCode='en';	//Abbrevation of currently loaded language. Defauls to en (English)
		protected $language=0;		//Id of currently loaded language
		public $db;					//Database to look for language strings
		protected $strings;			//Translated strings fetched from language file
		
		protected function __construct($language='en',$db=NULL) {
			if(!is_null($db)) {
				$this->db=$db;
			}
			$this->setLanguage($language);
		}
		
		protected function setLanguage($lang) {
			if(is_numeric($lang))
				throw new Exception('Language code must be a string.');
			helper::debugPrint("Set lang: $lang","language");
			$this->languageCode=$lang;
			if(!is_null($this->db))
				$this->buildLanguageArray();
			return $this->language;		
		}
		
		function __invoke($string) {		//From PHP 5.3.0 this gives the opportunity to call as lang('String') instead of lang->get('String')
			return self::$instance->get($string);
		}
		
		protected function buildLanguageArray() {		//Creates the dictionary
			helper::debugPrint('Create dictionary in '.$this->languageCode,'language');			
			$this->strings=array();
			
			$db=clone $this->db;
			$db->query("SELECT * FROM language WHERE code='$this->languageCode'");
			if($row = $db->getRow())
			{
				helper::debugPrint($this->languageCode." has id ".$row->id,'language');
				$this->language=$row->id;
			} else {
				$this->language=0;
				$this->languageCode='en';
			}
							
			$db=clone $this->db;
			$db->query("SELECT translation.* FROM translation,language WHERE translation.languageId=language.id and language.code='$this->languageCode'");
			while($row = $db->getRow())
			{
				$this->strings[$row->string]=$row->translation;
			}
			/*
			if(count($this->strings)==0) {
				$this->language=0;
				$this->languageCode='en';
			}
			*/
		}
		
		function getLanguage() {		//Get id of the currently loaded language
			return self::$instance->language;
		}
		
		function getLanguageCode() {		//Get the currently loaded language
			return self::$instance->languageCode;
		}
		
		function get($string) {			//Get translation of String. If String is not just a single word, a word by word translation is attempted
			helper::debugPrint("Get: $string in ".self::$instance->getLanguageCode(),"language");
			if(is_null($string))
				return NULL;
			if($string=="")
				return "";
			if($string=='&nbsp;' || self::$instance->getLanguageCode()=='en') {
				helper::debugPrint('Empty or english',"language");
				return str_replace('_',' ',$string);
			}
			if(isset(self::$instance->strings[$string])) {
				helper::debugPrint('Found',"language");
				return str_replace('_',' ',self::$instance->strings[$string]);
			}
			elseif(isset(self::$instance->strings[str_replace(' ','_',$string)])) {
				helper::debugPrint('Found with _',"language");
				return str_replace('_',' ',self::$instance->strings[str_replace(' ','_',$string)]);	
			}			
			else {
				helper::debugPrint('Word for word',"language");
				$words=explode(' ',$string);
				$trans=array();
				$allwords=true;
				foreach($words as $word) {
					if(isset(self::$instance->strings[$word])) {
						$trans[]=self::$instance->strings[$word];
					} elseif(isset(self::$instance->strings[ucfirst($word)])) {				//Look for word with uppercased first letter
						$trans[]=strtolower(self::$instance->strings[ucfirst($word)]);	
					} elseif(substr($word,strlen($word)-1,1)==',') {				//Attempt to strip commas in the end of the word and translate it
						$trans[]=self::$instance->get(substr($word,0,strlen($word)-1)) . ',';
					} else {
						$allwords=false;
						break;
					}
				}
				if($allwords) {
					return implode(' ',$trans);
				}
				else
					return self::$instance->googleTranslate(str_replace('_',' ',$string));
			}
		}
		
		public function saveToDb($string,$translation,$comment='',$language=NULL) {
			if(!is_null($this->db)) {
				if(is_null($language))
					$language=$this->language;
				$this->db->performUpdateOrInsert('translation',array('languageId'=>$language,'string'=>$string,'translation'=>$translation,'privateComment'=>$comment),"languageId='$language' AND string='$string'");
				return 'OK';
			} else {
				return 'No db';
			}
		}
		
		public function getPhraseList($languageId=NULL) {
			$query='SELECT * FROM translation WHERE languageId='.$languageId.' ORDER BY string';
			$db=clone $this->db;
			$db->query($query);
			$phrases=new baseClassList();
			while($row=$db->getRow())
			{
				$phrase=array('string'=>$row->string,'translation'=>$row->translation,'comment'=>$row->privateComment);
				$phrases->Append($phrase);
			}
			return $phrases;
		}
		
		public function getLanguageIdForCode($languageCode) {
			$query="SELECT id FROM language WHERE code='$languageCode'";
			$this->db->query($query);
			if($row=$this->db->getRow()) {
				return $row->id;
			}
		}
		
		public static function googleTranslate($string) {
			helper::debugPrint("googleTranslate($string)",'language');
			$trans=lang_bing::translate($string,'en',self::$instance->getLanguageCode());
			self::$instance->saveToDb(str_replace(' ','_',$string),$trans,'Bing Translated');
			return $trans;
		}

		public static function getSingleton($language=NULL,$db=NULL) 	//Get singleton instance of class
		{
			if(is_numeric($language))
				throw new Exception('Language code must be a string.');
			helper::debugPrint("Get singleton",'language');
			helper::debugPrint("Language: ".(is_null($language)?'NULL':$language),'language');
			helper::debugPrint("DB: ".(is_null($language)?'NULL':'Set'),'language');
			if (!isset(self::$instance) || !is_null($language) || !is_null($db)) {
				$c = __CLASS__;
				if(is_null($language) && isset(self::$instance))
					$language=self::$instance->getLanguageCode();
				if(is_null($db) && isset(self::$instance))
					$db=self::$instance->db;
				self::$instance = new $c($language,$db);
			}
	
			return self::$instance;
		}			

	}
?>