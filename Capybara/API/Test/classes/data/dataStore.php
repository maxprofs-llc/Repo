<?php
	class data_dataStore {
		
		protected static $memcached;
		
		protected static $staticStore=NULL;
		
		static function getObjectWithId($class,$id) {
			helper::debugPrint("Try to get datastore object $class:$id ",'datastore');
			if(!config_conf::getSingleton()->get('useDataStore',true)) {
				helper::debugPrint('useDataStore is false');
				return self::getStaticStore($class,$id);
			}
			helper::debugPrint('Use data store','datastore');
			self::createStore();
			$ds=self::$memcached;
			if($ds->get($class."_".$id)) {
				helper::debugPrint("Found $class with id $id",'cache');
				$ref = new ReflectionClass($class);
				if($ref->implementsInterface('data_IDoNotSerialize')) {
					helper::debugPrint("Do not serialize $class",'cache');
					return $ds->get($class."_".$id);
				} else {
					helper::debugPrint("Serialize $class",'cache');
					return unserialize($ds->get($class."_".$id));
				}
			} else {
				helper::debugPrint("Did not find $class with id $id",'cache');
				return NULL;
			}
		}

		static function getStaticStore($class,$id) {
			if(is_null(self::$staticStore))		
				self::$staticStore=array();

			$ds=self::$staticStore;
			if(!is_null($ds[$class."_".$id])) {
				helper::debugPrint("Found $class with id $id in staticStore",'cache');
				//For some reason the ids of the static store becomes zero sometimes
				//if(self::$staticStore[$class."_".$id]->id!=$id)
				//	self::$staticStore[$class."_".$id]->id=$id;
				return $ds[$class."_".$id];
			} else {
				helper::debugPrint("Did not find $class with id $id in staticStore",'cache');
				return NULL;
			}
		}	
		
		static function setObject($class,$object) {
			if(!config_conf::getSingleton()->get('useDataStore',true))
				return self::setStaticObject($class,$object);;
			helper::debugPrint("Set $class with id $object->id",'setObject');
			$ref = new ReflectionClass($class);
			self::createStore();
			$ds=self::$memcached;
			if($ref->implementsInterface('data_IDoNotSerialize')) 
				$ds->set($class."_".$object->id,$object);
			else
				$ds->set($class."_".$object->id,serialize($object));
			return;
		}
		
		static function setStaticObject($class,$object) {
			if(is_null(self::$staticStore))		
				self::$staticStore=array();

			helper::debugPrint("Set $class with id $object->id in staticStore",'setObject');
			self::$staticStore[$class."_".$object->id]=$object;
			if(self::$staticStore[$class."_".$object->id]->id!=$object->id)
				die("Static store inconsistency at SET: ID should be $object->id, is ".self::$staticStore[$class."_".$id]->id);
			return;
		}
/*		static function getObjectList($class) {
			$ds=self::getStore();
			if(!array_key_exists($class,$ds)) {
				return NULL;
			}
			$list=unserialize($ds[$class]);
			return $list;			
		}
	
		static function setObjectList($class,$list) {
			if(!isset($_SESSION['dataStore']))
				$_SESSION['dataStore']=array();
			$_SESSION['dataStore'][$class]=serialize($list);
		}

		static function getObjectListIsComplete($class) {
			$ds=self::getStore();
			if(!array_key_exists('complete_lists',$ds))
				return false;
			return array_key_exists($class,$ds['complete_lists']);
		}

		static function setObjectListIsComplete($class) {
			$_SESSION['dataStore']['complete_lists'][$class]=true;
		}	
*/
		static function setProperty($propertyName,$propertyValue) {
			helper::debugPrint('Set datastore property: '.$propertyName,'datastore');
			if(is_null(self::$staticStore))		
				self::$staticStore=array();
			if(!array_key_exists('_props',self::$staticStore))
				self::$staticStore['_props']=array();
			helper::debugPrint('Set property '.$propertyName,'cache');
			self::$staticStore['_props'][$propertyName]=$propertyValue;
		}
		
		static function getProperty($propertyName) {
			helper::debugPrint('Get datastore property: '.$propertyName,'datastore');
			if(is_null(self::$staticStore))		
				self::$staticStore=array();
			$ds=self::$staticStore;
			if(!array_key_exists('_props',$ds)) {
				return NULL;
			}
			helper::debugPrint('Fetch property '.$propertyName,'cache');
			return $ds['_props'][$propertyName];
		}
		
		static function clearStore() {
			if(config_conf::getSingleton()->get('useDataStore',true)) {
				helper::debugPrint('Clear memcached dataStore','cache');
				self::createStore();
				self::$memcached->delete('dataStore');
			}
			helper::debugPrint('Clear session dataStore','cache');
			unset($_SESSION['dataStore']);
		}
		
		/* SESSION store
		static private function getStore() {
			if(!isset($_SESSION['dataStore'])) {
				helper::debugPrint('Init dataStore','cache');
				$_SESSION['dataStore']=array();
			}
			helper::debugPrint('Fetch dataStore','cache');
			return $_SESSION['dataStore'];
		}
		*/
		
		//Memcached store
		static private function createStore() {
			helper::debugPrint('Create data store','cache');
			if(!config_conf::getSingleton()->get('useDataStore',true)) {
				helper::debugPrint('Config: Do not use data store','cache');
				return NULL;
			}
			if(is_null(self::$memcached)) {
				helper::debugPrint('Config: Create MemCache data store','cache');
				self::$memcached=new Memcached();
				self::$memcached->addServer('localhost',11211);
			}
		}
		
		static private function getSessionStore() {
			if(!isset($_SESSION['dataStore'])) {
				helper::debugPrint('Init session dataStore','cache');
				$_SESSION['dataStore']=array();
			}
			helper::debugPrint('Fetch session dataStore','cache');
			return $_SESSION['dataStore'];
		}
	}