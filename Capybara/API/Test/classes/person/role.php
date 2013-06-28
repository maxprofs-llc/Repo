<?php
	class person_role extends baseClass implements data_IDoNotSerialize {

		public static $doNotSerialize=true;
		
		//Pointers
		
		public $parentRoleId;
		public $childRoles;
		
		//Properties
		
		public $fullName;
		public $shortName;
		
		protected $allChildren;
		
		//Unknown
		private static $unknown;
		protected $isUnknown=false;

		//None
		private static $none;
		protected $isNone=false;
		
		public static function serializeThis() {
			return self::$doNotSerialize;
		}	
			
		function __construct($unknown=false,$none=false) {
			parent::__construct();
			$this->isUnknown=$unknown;
			$this->isNone=$none;
			if($none)
				$this->id=0;
			$this->childRoles=new baseClassList();
		}
			
		function getName() {
			if($this->isUnknown || is_null($this->id))
				return lang_lang::getSingleton()->get('Unknown role');
			if($this->isNone || $this->id==0)
				return lang_lang::getSingleton()->get('None');
			return $this->name;
		}
		
		function setParent($parentRole) {
			$this->parentRoleId=$parentRole->id;
			if(!is_null($parentRole)) {
				$this->getParentRole()->addChild($this);
			}
		}
		
		function getParentRole() {
			if(is_null($this->id))
				return NULL;
			return data_dataStore::getProperty('dataReader')->getRoleById($this->parentRoleId);
		}

		function addChild($childRole) {
			helper::debugPrint("$childRole->name added as child to $this->name","relations");
			if($childRole->parentRoleId!=$this->id)
				$childRole->parentRoleId=$this->id;
			$this->childRoles['id'.$childRole->id]=$childRole;
		}
		
		function isChildOf($role) {
			helper::debugPrint("Parent role: ".$this->parentRoleId,"roles");
			if(is_null($this->id))
				return false;
			if($this->parentRoleId==$role->id)	
				return true;
			if($this->getParentRole()->isChildOf($role))
				return true;
			return false;
		}

		function isChildOfId($id) {
			if(is_null($this->id))
				return false;
			if($this->parentRoleId==$id)	
				return true;
			if($this->getParentRole()->isChildOf($id))
				return true;
			return false;
		}		
		function getAllChildren() {
			if(is_null($this->childRoles))
				$this->childRoles=new baseClassList();
			if($this->allChildren==NULL) {
				$this->allChildren=array();
				foreach($this->childRoles as $role) {
					$this->allChildren[$role->id]=$role;
					$this->allChildren=array_merge($this->allChildren,$role->getAllChildren());
				}
			}
			return $this->allChildren;
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
		
		function getLongString() {
			$string="";
			$nextParent=$this->getParentRole();
			if(!is_null($nextParent)) {
				$parent=array();
				while(!is_null($nextParent->id)) {
					$parent[]=$nextParent->getName();
					$nextParent=$nextParent->getParentRole();
				}
				$parent=array_reverse($parent);
				$string=join("/",$parent)."/";
			}
			return $this->getName() .($string!="" ? " (". $string.$this->getName() .")" : "");
		}
	}
	
?>