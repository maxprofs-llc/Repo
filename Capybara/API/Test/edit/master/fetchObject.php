<?php
	include "../_define.php";
	
	$hasCopied=array();
	
	if(!$sess->checkLogin(false,true))
		die(json_encode(array("status"=>"Error","ErrorMsg"=>"Not logged in")));
			
	$id=$_GET['id'];
	$table=$_GET['table'];
	
	$mdb=new data_masterDatabase();
	
	unset($_SESSION['copied']);
	$newid=recursivelyCopy($table,$id,$mdb,$db);
	//recursivelyCopyChildren($table,$id,$newid,$mdb,$db);
	
	print json_encode(array("status"=>"OK","id"=>$newid));

	function recursivelyCopy($table,$id,$mdb,$db) {
		global $hasCopied;
		helper::debugPrint('recursivelyCopy','queries');
		if(isset($_SESSION['copied'][$table][$id]))
			return $_SESSION['copied'][$table][$id];
		$mdb=clone $mdb;
		$db=clone $db;
		$qb=new data_queryBuilder($mdb);
		$db->query("SELECT id FROM $table WHERE masterId=$id",true);
		if(!$row=$db->getRow()) {
			$mdb->query("SELECT * FROM $table WHERE `id`=$id",true);
			while($row=$mdb->getRow()) {
				$cols=$qb->getColumns($table);
				foreach($cols as $col) {
					$mdb->query("SELECT foreignTable,foreignColumn FROM foreignKeys WHERE `table`='$table' and `column`='$col' and doReverseLookup=0",true);
					$value=$row->$col;
					while($fkRow=$mdb->getRow()) {
						$fkcol=$fkRow->foreignColumn;
						helper::debugPrint('Table: '.$table,'queries');
						helper::debugPrint('Id: '.$id,'queries');
						helper::debugPrint('Column: '.$col,'queries');
						helper::debugPrint('Foreign key column: '.$fkcol,'queries');
						if($fkRow->foreignTable!='file' && !is_null($row->$col)) {
							$newid=recursivelyCopy($fkRow->foreignTable,$value,$mdb,$db);
							$_SESSION['copied'][$table][$id]=$newid;
							$row->$col=$newid;
						} else {
							$row->$col=NULL;
						}
					}
				}
				$row->masterId=$id;
				$row->id=NULL;
				unset($row->migratedId);
				unset($row->migratedTable);
				if(!$newid=hasBeenAdded($db,$table,$id)) {
					$newid=$db->performInsert($table,$row);
					$cols=$qb->getColumns($table."Strings");
					if(count($cols)>0) {
						$mdb->query("SELECT * FROM ".$table."Strings WHERE ".$table."Id=$id");
						while($strRow=$mdb->getRow()) {
							$col=$table."Id";
							$strRow->$col=$newid;
							$strRow->id=NULL;
							$db->performInsert($table."Strings",$strRow);
						}
					}
				}
				reverseCopy($table,$id,$newid,$mdb,$db);
				return $newid;
			} 
		} else {
			reverseCopy($table,$id,$row->id,$mdb,$db);
			return $row->id;
		}
	}
	
	function hasBeenAdded($db,$table,$id) {
		$db=clone $db;
		$db->query("SELECT id FROM `$table` WHERE masterId=$id");
		if($row=$db->getRow())
			return $row->id;
		else
			return false;
	}
	
	function reverseCopy($table,$id,$newid,$mdb,$db) {
		helper::debugPrint('reverseCopy','queries');
		$mdb=clone $mdb;
		$db=clone $db;
		$mdb->query("SELECT `table`,`column` FROM foreignKeys WHERE doReverseLookup=1 AND foreignTable='$table'");
		while($revRow=$mdb->getRow()) {
			$column=$revRow->column;
			$query="SELECT * FROM `$revRow->table` WHERE `$column`='$id'";
			$mdb2=clone $mdb;
			$mdb2->query($query);
			while($row=$mdb2->getRow()) {
				$nid=recursivelyCopy($revRow->table,$row->id,$mdb,$db);
				$db->performUpdate($revRow->table,array($column=>$newid),$nid);
			}
		}
	}
	
	function recursivelyCopyChildren($table,$masterId,$newId,$mdb,$db,$foreignColumn='id') { 
		helper::debugPrint('recursivelyCopyChildren','queries');
		if(isset($_SESSION['copied'][$table][$newId]))
			return $_SESSION['copied'][$table][$newId];
		$mdb=clone $mdb;
		$db=clone $db;
		$qb=new data_queryBuilder($mdb);
		$mdb->query("SELECT * FROM $table WHERE id=$masterId",true);
		if($row=$mdb->getRow()) {
			$cols=$qb->getColumns($table);
			foreach($cols as $col) {
				$mdb->query("SELECT `table`,`column` FROM foreignKeys WHERE `foreignTable`='$table' and `foreignColumn`='$col'",true);
				$value=$row->$col;
				while($fkRow=$mdb->getRow()) {
					$fkcol=$fkRow->column;
					$fktable=$fkRow->table;
					helper::debugPrint('Table: '.$table,'queries');
					helper::debugPrint('Foreign table: '.$fktable,'queries');
					helper::debugPrint('Id: '.$id,'queries');
					helper::debugPrint('Column: '.$col,'queries');
					helper::debugPrint('Foreign key column: '.$fkcol,'queries');
					recursivelyCopyChildren($fktable,$masterId,$newId,$mdb,$db,$fkcol);
				}
			}	
		}
	}
	
	function getColumns($table,$mdb) {
		$mdb=clone $mdb;
		$cols=array();
		$query="SELECT `column` FROM foreignKeys WHERE `table`='$table'";
		$mdb->query($query);
		while($row=$mdb->getRow()) {
			$cols[]=$row->column;
		}
		return $cols;
	}
?>