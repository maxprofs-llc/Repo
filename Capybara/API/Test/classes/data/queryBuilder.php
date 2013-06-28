<?php
	class data_queryBuilder {
	
		protected $db;
		protected $columns;
		protected $calculatedColumns;
		protected $excludeColumns;
		protected $table;
		protected $prefix;
		protected $abbrevation;
		protected $where;

		protected $joins;
		protected $innerJoins;
		
		protected $cacheColumns;
		
		public $order='';
		
		public $limit='';
		
		function __construct($db) {
			$this->joins=array();
			$this->innerJoins=array();
			$this->calculatedColumns=array();
			$this->db=$db;
			$this->cacheColumns=array();
		}
		
		function addSelect($table,$abbrevation='',$prefix='',$includeColumns=false,$excludeColumns=false,$where=false) {
			if($abbrevation=='')
				$abbrevation=$table;

			if(!$includeColumns)
				$this->columns[$abbrevation]=$this->getColumns($table);
			else
				$this->columns[$abbrevation]=$includeColumns;		
			if(!$excludeColumns)
				$excludeColumns=array();
			if(!$where)
				$where=array();
				
			$this->excludeColumns[$abbrevation]=$excludeColumns;	
			$this->table[$abbrevation]=$table;
			$this->prefix[$abbrevation]=$prefix;
			$this->where[$abbrevation]=$where;
			$this->abbrevation=$abbrevation;		
		}
		
		function addCalculatedColumn($column) {
			$this->calculatedColumns[]=$column;
		}
		
		function addWhereClause($abbrevation,$clause) {
			$this->where[$abbrevation]=array_merge($this->where[$abbrevation],(array) $clause);
		}
		
		function addJoin($table,$abbrevation='',$prefix='',$includeColumns=false,$excludeColumns=false,$on=false) {
			if($abbrevation=='')
				$abbrevation=$table;

			if(!$includeColumns)
				$this->columns[$abbrevation]=$this->getColumns($table);
			else
				$this->columns[$abbrevation]=$includeColumns;		
			if(!$excludeColumns)
				$excludeColumns=array();
				
			$this->excludeColumns[$abbrevation]=$excludeColumns;	
			$this->table[$abbrevation]=$table;
			$this->prefix[$abbrevation]=$prefix;
			$this->where[$abbrevation]=$on;
			$this->joins[]=$abbrevation;
			$this->abbrevation=$abbrevation;		
		}				
		
		function reverseJoinList() {
			helper::debugPrint("Reverse joins","querybuilder");
			helper::debugPrint("Was:".json_encode($this->joins),"querybuilder");
			$this->joins=array_reverse($this->joins);
			$this->columns=array_reverse($this->columns);
			helper::debugPrint("Is:".json_encode($this->joins),"querybuilder");
		}

		function addInnerJoin($table,$abbrevation='',$prefix='',$includeColumns=false,$excludeColumns=false,$on=false) {
			if($abbrevation=='')
				$abbrevation=$table;

			if(!$includeColumns)
				$this->columns[$abbrevation]=$this->getColumns($table);
			else
				$this->columns[$abbrevation]=$includeColumns;		
			if(!$excludeColumns)
				$excludeColumns=array();
				
			$this->excludeColumns[$abbrevation]=$excludeColumns;	
			$this->table[$abbrevation]=$table;
			$this->prefix[$abbrevation]=$prefix;
			$this->where[$abbrevation]=$on;
			$this->innerJoins[]=$abbrevation;
			$this->abbrevation=$abbrevation;		
		}			
		
		function getQuery() {
			$select='SELECT ';
			$from=' FROM ';
			$join='';
			$where='';
			foreach($this->columns as $abb => $cols)
			{
				foreach($cols as $col) {
					if(!in_array($col,$this->excludeColumns[$abb]) && in_array($col,$this->getColumns($this->table[$abb]))) 
						$select .= "`$abb`" . '.`' . $col . '` as ' . $this->prefix[$abb] . $col . ',';
				}
				if(!in_array($abb,$this->joins) && !in_array($abb,$this->innerJoins)) {
					$from .= "`".$this->table[$abb] . '` as `' . $abb . "`,";
					foreach($this->where[$abb] as $cond) {
						$where .= $cond . " AND ";
					}
				} elseif(in_array($abb,$this->joins)) {
					$join .= ' LEFT JOIN `' . $this->table[$abb] . '` as `' . $abb . '` ON ';
					foreach($this->where[$abb] as $cond) {
						$join .= "$cond AND ";
					}
					$join=substr($join,0,strlen($join)-5);
				} elseif(in_array($abb,$this->innerJoins)) {
					$join .= ' INNER JOIN `' . $this->table[$abb] . '` as `' . $abb . '` ON ';
					foreach($this->where[$abb] as $cond) {
						$join .= "$cond AND ";
					}
					$join=substr($join,0,strlen($join)-5);
				} 
			}
			foreach($this->calculatedColumns as $col) {
				$select.=$col.",";
			}
			$select=substr($select,0,strlen($select)-1);
			$from=substr($from,0,strlen($from)-1);
			if($where!='')
				$where=" WHERE " . substr($where,0,strlen($where)-5);
			helper::debugPrint($select . $from . $join . $where . ($this->order!='' ? ' ORDER BY ' . $this->order:''),"querybuilder");
			return $select . $from . $join . $where . ($this->order!='' ? ' ORDER BY ' . $this->order: '') . ($this->limit!='' ? " LIMIT $this->limit" : '');
		}
		
		public function getColumns($table) {	
			if(!isset($this->cacheColumns[$table])) {	
				$query="SHOW COLUMNS FROM `$table`";
				$db=clone $this->db;
				$db->query($query,true);
				$cols=array();
				while($row = $db->getRow())
				{
					$cols[]=$row->Field;
				}
				$this->cacheColumns[$table]=$cols;
			} else {
				$cols=$this->cacheColumns[$table];
			}
			return $cols;
		}
		
		public function hasTable($table) {
			if(is_null($this->table))
				return false;
			helper::debugPrint(json_encode(array_values($this->table)),'api');
			if(is_null(array_values($this->table)))
				return false;
			return in_array($table,array_values($this->table));			
		}
	}
?>