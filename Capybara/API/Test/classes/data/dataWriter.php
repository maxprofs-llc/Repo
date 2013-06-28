<?php
	class data_dataWriter {
	
		protected $db;
		
		function __construct() {
			$this->db=new data_editDatabase();
		}

		function writeGeneric($object,$table,$doNotSave=false) {
			helper::debugPrint("writeGeneric to $table","database");
			$sess=new data_session();
			if(!$sess->checkLogin())
				return -1;
				
			// Clear the data store and make sure dataReader object is added again
			$dr=data_dataStore::getProperty('dataReader');
			data_dataStore::clearStore();
			data_dataStore::setProperty('dataReader',$dr);
			
			$db=clone $this->db;
			$arrayCols=array();
			if($object['id']>0) {
				//Update
				$cols=array();
				foreach($object as $column => $value) {
					if($column!='id' && $column!='location' && !is_array($value)) {
						$cols[$column]=$value;
					} elseif (is_array($value) && $column!='strings') {
						if(!$doNotSave || !in_array($column,$doNotSave)) {
							$arrayCols[]=$column;
						}
					}
				}
				$db->performUpdate($table,$cols,$object['id']);
				if(isset($object['strings']))
				{
					foreach($object['strings'] as $string) {
						//- Does not currently work
						//$db->performInsertOnDuplicateKeyUpdate($table.'Strings',$string);
						$db->performUpdateOrInsert($table.'Strings',$string,'languageId="'.$string['languageId'].'" and '.$table.'Id='.$object['id']);
					}
				}
				foreach($arrayCols as $column) {
					foreach($object[$column] as $value) {
						$value[$table.'Id']=$object['id'];
						$db->performUpdateOrInsert($table.ucfirst($column),$value,'id='.$value['id']);
					}
				}
				/*
				if(isset($object['location']))
				{
					$cols=array();
					foreach($object['location'] as $column => $value) {
						if($column!='id') {
							$cols[$column]=$value;
						}
					}
					if($object['location']['id']!='')
						$db->performUpdateOrInsert('location',$cols,'id='.$object['location']['id']);
					else 
						$object['location']['id']=$db->performInsert('location',$cols);
					$db->performUpdate($table,array('locationId'=>$object['location']['id']),$object['id']);
				}
				*/
				return $object['id'];
			} else {
				//Insert
				$cols=array();
				foreach($object as $column => $value) {
					if($column!='id' && $column!='location' && !is_array($value)) {
						$cols[$column]=$value;
					} elseif (is_array($value) && $column!='strings') {
						if(!$doNotSave || !in_array($column,$doNotSave)) {
							$arrayCols[]=$column;
						}
					}
				}
				$id=$db->performInsert($table,$cols);
				if(isset($object['strings']))
				{
					foreach($object['strings'] as $string) {
						$string[$table.'Id']=$id;
						$db->performInsert($table.'Strings',$string);
					}
				}
				foreach($arrayCols as $column) {
					foreach($object[$column] as $value) {
						$value[$table.'Id']=$id;
						$db->performInsert($table.ucfirst($column),$value);
					}
				}
				/*
				if(isset($object['location']))
				{
					$cols=array();
					foreach($object['location'] as $column => $value) {
						if($column!='id') {
							$cols[$column]=$value;
						}
					}
					$object['location']['id']=$db->performInsert('location',$cols);
					$db->performUpdate($table,array('locationId'=>$object['location']['id']),$id);
				}
				*/
				return $id;
			}			
		}

		function deleteGenericNotInList($idList,$table,$where=false) {
			$db=clone $this->db;
			if($where)
				$where=" AND ".join(" AND ",$where);
			else
				$where="";
			$query="DELETE FROM $table WHERE id NOT IN (".join(',',$idList).") $where";
			$db->query($query);
		}
	}
?>