<?php
	class data_relationsManager {
		
		static function resolveRoleRelations(data_dataReader $dr=NULL) {				
			if(self::checkRelationsResolved('person_role'))
				return false;
			if(is_null($dr))
				$dr=data_dataStore::getProperty('dataReader');
			$list=$dr->getGenericList('role','ro','person_role',true,true);
			foreach($list as $r) {
				$role=$dr->getRoleById($r->id);
				if($role->parentRoleId!=0 && !is_null($role->parentRoleId))
				{
					$parent=$dr->getRoleById($role->parentRoleId);
					$role->setParent($parent);
					data_dataStore::setObject('person_role',$role);
				}
			}
			self::setRelationsResolved('person_role');
			return true;
		}
		
		protected static function checkRelationsResolved($class) {
			$resolvedRelations=data_dataStore::getProperty('resolvedRelations');
			if(is_null($resolvedRelations))
				return false;
			return $resolvedRelations[$class];
		}
		
		protected static function setRelationsResolved($class) {
			$resolvedRelations=data_dataStore::getProperty('resolvedRelations');
			if(is_null($resolvedRelations))
				$resolvedRelations=array();
			$resolvedRelations[$class]=true;
			data_dataStore::setProperty('resolvedRelations',$resolvedRelations);
		}
		
		
/*		static function resolveGeographicRelations(data_dataReader $dr=NULL) {
			if(self::checkRelationsResolved('geo'))
				return false;
			if(is_null($dr))
				$dr=data_dataStore::getProperty('dataReader');
			$continents=$dr->getGenericList('continent','cn','location_continent',true,true);
			$countries=$dr->getGenericList('country','co','location_country',true,true);
			$states=$dr->getGenericList('state','st','location_state',true,true);
			$cities=$dr->getGenericList('city','ci','location_city',true,true);
			foreach($cities as $city) {
				if(!is_null($city)) {
					$city->getContinent()->addCity($city);
					$city->getState()->addCity($city);
					$city->getCountry()->addCity($city);
				}
			}
			foreach($states as $state) {
				if(!is_null($state)) {
					$state->getContinent()->addState($state);
					$state->getCountry()->addState($state);
				}
			}
			foreach($countries as $country) {
				if(!is_null($country)) {
					$country->getContinent()->addCountry($country);
				}
			}
			self::setRelationsResolved('geo');
			return true;
		}*/
	}
?>