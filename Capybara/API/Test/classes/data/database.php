<?php
	abstract class data_database {
	
		public $databaseName;
		public $lastResult;
		
		protected $conf;
		
		protected function init() {
			helper::debugPrint('Create database object','database');
			
			$this->conf=config_conf::getSingleton();
			$this->connect();

			helper::debugPrint('Link: ' . $this->getLink(),'database');
			if (!$this->getLink())  {
				helper::debugPrint('Error: Cannot connect the database engine','errors');
				trigger_error('Cannot connect the database engine',E_USER_ERROR);
			}
			
			mysql_set_charset('utf8');
		}
		
		abstract function connect();
		
		abstract function getLink();
			
		function selectDB($database) {
			helper::debugPrint('Select DB: '.$database,'database');
			helper::debugPrint('Link: '.$this->getLink(),'database');
			if ($this->databaseName!="" && !(is_resource($this->getLink()) && stristr(get_resource_type($this->getLink()), "mysql")))
				$this->connect(true);
			if(!mysql_select_db($database,$this->getLink()))
			{
				trigger_error('Cannot use ' . $database . ' as database',E_USER_ERROR);
			}
			$this->databaseName = $database;
		}
		
		function query($query,$noError=false,$throwException=false)
		{
			$this->selectDb($this->databaseName);
			## SECURITY
			//$query = $this->stripText($query);
			##
			
			helper::debugPrint($query.'('.$this->databaseName.')','queries');
			$this->lastResult = mysql_query($query, $this->getLink());
			helper::printTimeStamp('*After query*');
			
			helper::debugPrint("Returned ". mysql_affected_rows()." rows",'queries');
			
			if(!$this->lastResult && !$noError)
      		{
				trigger_error('<p class="errorHeadline">Invalid query to the database / no results found</p>
				   			   <p class="errorMessage">' . $query . '</p>',E_USER_WARNING);
				helper::debugPrint("<p>Query:<br>$query","errors");
				helper::debugPrint("<p>Database: ".$this->databaseName,"errors");
      		}
			if(!$this->lastResult && $throwException)
      		{
				throw new Exception('<p class="errorHeadline">Invalid query to the database / no results found</p>
				   			   <p class="errorMessage">' . $query . '</p>');
      		}      		
      		return mysql_insert_id($this->getLink());
		}
	
		protected function stripText($string)
		{
			$string=str_replace("\n"," ",$string);
			if (!is_numeric($string))
		  	{
				helper::debugPrint("String: " . $string,'database');
				helper::debugPrint("Link: " . $this->getLink(),'database');
				$string = mysql_real_escape_string($string, $this->getLink());
				helper::debugPrint("Escaped string: " . $string,'database');
		  	}
			if (get_magic_quotes_gpc())
			{
				//$string = stripslashes($string);
			}
			return $string;
		}
		
		function getAffectedRows() {
			return mysql_affected_rows($this->getLink());
		}

		function getRow()
		{
			helper::debugPrint('Get row in '.$this->databaseName,'getRow');
			if($this->lastResult) {
				helper::debugPrint('Return row','getRow');
				return mysql_fetch_object($this->lastResult);
			}
			else {
				helper::debugPrint('No lastResult','getRow');
				return false;
			}
		}
		
		function getRowAssoc()
		{
			return mysql_fetch_assoc($this->lastResult);
		}
		
		function getRowAsArray()
		{
			return mysql_fetch_row($this->lastResult);
		}
		
		function close()
		{
			mysql_close($this->getLink());
		}
		
		function pointer($position)
		{
			mysql_data_seek($this->lastResult, $position);
		}
		
		function numRows()
		{
			return mysql_num_rows($this->lastResult);
		}
		
		public function performInsert($table,$data,$logIt=true) {
			$this->selectDb($this->databaseName);
			## SECURITY
			$table= $this->stripText($table);
			##
			$cols=array();
			$vals=array();
			foreach($data as $col => $val) {
				$cols[]="`" . $col . "`";
				if(is_array($val))
					die("$col is an array on table $table");
				if(is_null($val) || $val=='') {
					$vals[] = 'NULL';
				} else if (strtolower($val) == 'true') {
					$vals[] = 'TRUE';
				} else if (strtolower($val) == 'false') {
					$vals[] = 'FALSE';
				} else {
					$vals[] ='"' . $this->stripText($val) . '"';
				}
			}
			$columns=implode(',',$cols);
			$values=implode(',',$vals);
			$query="INSERT INTO `$table` ($columns) VALUES ($values)";
			//print $query. '<br>';
			$this->query($query);
			$insertId=mysql_insert_id($this->getLink());
			if($logIt)
				$this->updateLog($table,$insertId,'INSERT');
			return $insertId;
		}

		function performUpdate($table,$data,$id,$logIt=true) {
			$this->selectDb($this->databaseName);
			## SECURITY
			helper::debugPrint("Update table: $table","update");
			$table=$this->stripText($table);
			helper::debugPrint("After strip: $table","update");
			$id=$this->stripText($id);
			##
			$vals='';
			foreach($data as $col => $val) {
				if($val=='' || is_null($val)) {
					$vals .= '`' . $col . '`=NULL,';
				} else if (strtolower($val) == 'true') {
					$vals .= '`' . $col . '`=TRUE,';
				} else if (strtolower($val) == 'false') {
					$vals .= '`' . $col . '`=FALSE,';
				} else {
					$vals .= '`' . $col . '`="' . $this->stripText($val) . '",';
				}
			}
			$vals=substr($vals,0,strlen($vals)-1);
			$query="UPDATE `$table` SET $vals WHERE id=$id";
			//print $query. '<br>';
			$this->query($query);
			$insertId=mysql_insert_id($this->getLink());
			if($logIt)
				$this->updateLog($table,$insertId,'INSERT');
			return $insertId;
		}
		
		function performUpdateOrInsert($table,$data,$where,$logit=true) {
			$this->selectDb($this->databaseName);
			## SECURITY
			$table= $this->stripText($table);
			$id=$this->stripText($id);
			##
			$query="SELECT id FROM `$table` WHERE $where";
			$this->query($query,true);
			if($this->lastResult && $row=$this->getRow())
				return $this->performUpdate($table,$data,$row->id);
			else
				return $this->performInsert($table,$data,true);
		}
		
		function performInsertOnDuplicateKeyUpdate($table,$data,$logit=true) {
			$this->selectDb($this->databaseName);
			## SECURITY
			$table= $this->stripText($table);
			$id=$this->stripText($id);
			##
			$cols=array();
			$vals=array();
			$update=array();
			foreach($data as $col => $val) {
				$cols[]="`" . $col . "`";
				if(is_null($val) || $val=='') {
					$vals[]='NULL';
				} else if (strtolower($val) == 'true') {
					$vals[]='TRUE';
				} else if (strtolower($val) == 'false') {
					$vals[]='FALSE';
				} else {
					$vals[]='"' . $this->stripText($val) . '"';
				}
				$update[] = $cols[count($cols)-1] . "=" . $vals[count($vals)-1];
			}
			$columns=implode(',',$cols);
			$values=implode(',',$vals);
			$updates=implode(',',$update);
			$query="INSERT INTO `$table` ($columns) VALUES ($values) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id), $updates";
			print $query. '<br>';
			$this->query($query);
			$insertId=mysql_insert_id($this->getLink());
			if($logIt)
				$this->updateLog($table,$insertId,'INSERT');
			return $insertId;
		}
		
		function performDelete($table,$id=false,$where=false) {
			$this->selectDb($this->databaseName);
			$table = $this->stripText($table);
			$id = $this->stripText($id);
			if(((isset($id) && $id != '' && is_numeric($id)) || (!$id && $where)) && ($table != 'updateLog' && $table != ''))
			{
				if(!$where)
					$where=array();
				if($id)
					$where[]="id=$id";
				$whereStr=implode(' AND ',$where);
				$query="DELETE FROM $table WHERE $whereStr";
				$this->query($query);
				$this->updateLog($table,$id,'DELETE');
				return true;
			} else {
				trigger_error('Could not delete. Missing valid parameters.',E_USER_WARNING);
				return false;
			}
		}

		function updateLog($table, $id, $operation)
		{
			$query = 'INSERT INTO updateLog (timestamp,changedTable,changedId,operation,ip,userId) VALUES (now(), "' . $this->stripText($table) . '",' . $this->stripText($id) . ', "' . $this->stripText($operation) . '", "' . $this->stripText($_SERVER['REMOTE_ADDR']) . '", "' . $this->stripText($_SESSION['userid']) . '")';
			//$this->query($query);
		}
	}
?>