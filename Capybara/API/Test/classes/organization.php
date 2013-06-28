<?php
	class organization extends locatable_inStreet {
		
		//Pointers
		public $organizationTypeId=NULL;		//Type of Organization: corporation, team, football association etc		
		public $parentOrganizationId=NULL;		//Organization owning this organization: eg AIK AB is parent to AIK Fotboll AB
		public $logoFileId=NULL;				//Id of file record containing image data for the logo of the team. Should not be accessed directly
				
		//Properties
		public $fullName='';					//The full name without abbrevations: eg AllmŠna Idrottsklubben
		public $nativeName='';					//The name in the native tongue and with it's own alphabet
		public $nativeFullName='';				//The full name in the native tongue and with it's own alphabet
		public $nativeNickName='';				//The nickname in the native tongue and with it's own alphabet
		public $nativeShortName='';				//The short name in the native tongue and with it's own alphabet
		public $nativeSortName='';				//The sort name in the native tongue and with it's own alphabet
		public $name='';						//Popular name used in daily speach: eg AIK
		public $nickName='';					//Nicknames for an organization: eg Gnaget for AIK
		public $shortName='';					//Short name for places with limited text space: eg AIK, IFKG for IFK Gšteborg
		public $sortName='';					//Name to sort after: eg AC Milan should be sorted by Milan
		public $foundingDate='';				//The date the organization was founded
		public $cessationDate='';				//The date the organization ceased to exist
		public $url='';							//Internet URL for organization, eg: http://www.aik.se/
		
		//Unknown
		private static $unknown;
		protected $isUnknown=false;

		//None
		private static $none;
		protected $isNone=false;
		
		function __construct($unknown=false,$none=false) {
			parent::__construct();
			$this->isUnknown=$unknown;
			$this->isNone=$none;
			$organizationType=organizationType::getUnknown();
			if($none)
				$this->id=0;
		}
		
		function getParentOrganization() {
			if(is_null($this->id))
				return NULL;
			return data_dataStore::getProperty('dataReader')->getOrganizationById($this->parentOrganizationId);
		}

		function getOrganizationType() {
			if(is_null($this->id))
				return NULL;
			return data_dataStore::getProperty('dataReader')->getOrganizationTypeById($this->organizationTypeId);
		}		
		
		function getName() {
			if($this->isUnknown || is_null($this->id))
				return lang_lang::getSingleton()->get('Unknown_organization');
			if($this->isNone || $this->id==0)
				return lang_lang::getSingleton()->get('None');
			return $this->name;
		}

		function getLogoImageId() {
			if(is_null($this->logoFileId) && !is_null($this->getParentOrganization()))
				return $this->getParentOrganization()->getLogoImageId();
			return $this->logoFileId;
		}		
		
		static function getUnknown() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$unknown = new $c(true);
			}
			return self::$unknown;
		}	

		static function getNone() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$none = new $c(false,true);
			}
			return self::$none;
		}			
	}
?>