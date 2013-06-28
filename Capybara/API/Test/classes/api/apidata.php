<?php
	class api_apidata {

		private $db;
		private $qb;
		private $list;

		private $where=false;
		private $table=false;
		private $abbr=false;
		private $keycolumn=false;
		private $reverseColumns=false;
		private $replaceColumns=array();
		private $search=false;
		private $parameters=array();
		
		private $args=array();
		
		private $c;
		private $error=false;

		private $defaultMax=100;
		
		public $time;

		function __construct($arglist,$parameters=false) {
			helper::debugPrint("Creating API-object","api");
			$time=microtime(true);
			if(!$parameters)
				$this->parameters=$_GET;
			else
				$this->parameters=$parameters;
			$this->defaultMax=config_conf::getSingleton()->get('default_api_max_value',$this->defaultMax);
			$lang=lang_lang::getSingleton()->getLanguage();
			$this->db=new data_readOnlyDatabase();
			$this->qb=new data_queryBuilder($this->db);

			if(!$ret=$this->addMore($arglist,true)){
				return;
			}
			if(isset($this->parameters['opponent'])) {
				helper::debugPrint("Opponent filter is set","api");
				if($this->parameters['opponent']=='me')
					$this->parameters['opponent']=config_conf::getSingleton()->get('my_team');
				$this->addToWhere($this->parameters['opponent']." IN (SELECT teamid FROM competitor WHERE matchid=ma.id AND teamid<>te.id)");
			}

			if($this->search) {
				$w=array();
				foreach($this->qb->getColumns($this->table . "Strings") as $col)
					$w[]="$this->abbr"."s.$col LIKE '%$this->search%'";
				$this->addToWhere("(".implode(" OR ",$w).")");
				helper::debugPrint("Search for: ".$this->search,"api");
				helper::debugPrint("Clause: (".implode(" OR ",$w).")","api");
			}

			$include=false;
			if(isset($this->parameters['fields']))
				$include=array_merge(array('id'),explode(",",$this->parameters['fields']));
			$this->qb->addSelect($this->table,$this->abbr,$this->table."_",$include,$this->exclude,$this->where);
			$this->qb->reverseJoinList();


			$max=$this->defaultMax;
			$page=1;
			if(isset($this->parameters['max_result']))
				$max=$this->parameters['max_result'];
			if(isset($this->parameters['page']))
				$page=$this->parameters['page'];

			$start=($page-1)*$max;
			$this->qb->limit="$start,$max";

			$this->qb->order=$this->abbr.'.id';
			if(isset($this->parameters['order']))
				$this->qb->order=$this->parameters['order'];

			if(isset($this->parameters['when'])) {
				if($this->parameters['when']=='now')
					$atDate=date('Y-m-d');
				else {
					foreach(explode(",",strtolower($this->parameters['when'])) as $date)
					{
						if(strlen($date)==2) {
							if($this->qb->hasTable("match"))
								$this->qb->addWhereClause("ma","LOWER(SUBSTRING(DATE_FORMAT(ma.date,'%a'),1,2))='$date'");
						} elseif(strlen($date)==3 && $date!='now') {
							if($this->qb->hasTable("match"))
								$this->qb->addWhereClause("ma","LOWER(DATE_FORMAT(ma.date,'%b'))='$date'");
						}
						else {
							if($date=='now')
								$atDate=date('Y-m-d');
							else
								$atDate=$date;
							if($this->qb->hasTable("personRole")) {
								$this->qb->addWhereClause("per","(NOT isnull(per.startDate) AND per.startDate<=STR_TO_DATE('$atDate','%Y-%m-%d'))");
								$this->qb->addWhereClause("per","(isnull(per.endDate) or per.endDate>=STR_TO_DATE('$atDate','%Y-%m-%d') or per.endDate='0000-00-00')");
							}
							if($this->qb->hasTable("match"))
								$this->qb->addWhereClause("ma","ma.date LIKE REPLACE(STR_TO_DATE('$atDate','%Y-%m-%d'),'-00','%')");
						}
					}
				}
			}

			$q=$this->qb->getQuery();
			if($this->replaceColumns)
				foreach($this->replaceColumns as $col => $rep)
					$q=str_ireplace($col,$rep,$q);
			try{
				helper::debugPrint("Query: $q","api");
				@$this->db->query($q,false,true);
			} catch(Exception $e) {
				helper::debugPrint("Error: ".$e->getMessage(),"api");
				$this->error="Database returned error";
				return;
			}

			$c=$this->c;
			$list=new baseClassList();
			while($row = $this->db->getRow())
			{
				$storedObj=data_dataStore::getObjectWithId($c->class,$row->id);
				if(is_null($storedObj)) {
					$object=new $c->class();
					helper::debugPrint("Could not find $c->class with id $row->id in dataStore. Fetch from DB.",'cache');
					$object->getData($row,$c->table."_");
					data_dataStore::setObject($c->class,$object);
					$storedObj=$object;
				}
				if(!is_string($ret))
					$list->Append($storedObj);
				else {
					$arg=$ret;
					while($arg!="") {
						$func=$storedObj->getFunction($arg);
						$var=false;
						if(count($arglist)>0 && is_numeric($arglist[0])) {
							$var=array_shift($arglist);
						}
						if(!is_null($func) && method_exists($storedObj,$func))
							$storedObj=$storedObj->$func($var);
						else {
							$this->error="$arg is not a valid key";
							return;
						}
						$arg=array_shift($arglist);
					}
					$list->Append($storedObj);
				}
			}
			$this->list=$list;
			$this->time=microtime(true)-$time;
		}

		function addToWhere($where) {
			if(!$this->where)
				$this->where=array();
			helper::debugPrint("Add to where clause: $where","api");
			$this->where[]=$where;
		}

		function printJSON() {
			if(!$this->error) {
				$time=microtime(true);
				$max=$this->defaultMax;
				$page=1;
				if(isset($this->parameters['max_result']))
					$max=$this->parameters['max_result'];
				if(isset($this->parameters['page']))
					$page=$this->parameters['page'];
				$url=$_SERVER['REQUEST_URI'];
				if(stristr($url,"page=$page")) {
					$next=str_replace("page=$page","page=".($page+1),$url);
					if($page>1)
						$prev=str_replace("page=$page","page=".($page-1),$url);
				}
				else {
					$next=$url.(stristr($url,"?") ? "&" : "?")."page=".($page+1);
					if($page>1)
						$prev=str_replace("page=$page","page=".($page-1),$url);
				}
				$json=$this->list->getJSON(true);
				$time=microtime(true)-$time;
				print '[{"status":"success"},{"data":'.$json.'},{"paging":{"next":"'.$next.'","prev":"'.$prev.'"}},{"time":"'.$this->time.'","serialization":"'.$time.'"}]';
			} else {
				print '[{"status":"error"},{"message":"Invalid query: '.$this->error.'"}]';
			}
		}

		function printXML() {
			if(!$this->error) {
				$max=$this->defaultMax;
				$page=1;
				if(isset($this->parameters['max_result']))
					$max=$this->parameters['max_result'];
				if(isset($this->parameters['page']))
					$page=$this->parameters['page'];
				$url=$_SERVER['REQUEST_URI'];
				if(stristr($url,"page=$page")) {
					$next=str_replace("page=$page","page=".($page+1),$url);
					if($page>1)
						$prev=str_replace("page=$page","page=".($page-1),$url);
				}
				else {
					$next=$url.(stristr($url,"?") ? "&" : "?")."page=".($page+1);
					if($page>1)
						$prev=str_replace("page=$page","page=".($page-1),$url);
				}
				print '<?xml version="1.0" encoding="UTF-8"?>';
				print "<response>";
				print "<status>success</status>";
				print "<data>".$this->list->getXML()."</data>";
				print "<paging><next>".urlencode($next)."</next><prev>".urlencode($prev)."</prev></paging>";
				print "</response>";
			}
		}

		function printHTML($type = 'div') {
			// $type can (so far) be "div", "table", "list" and "select"
			if(!$this->error) {
				$max=$this->defaultMax;
				$page=1;
				if(isset($this->parameters['max_result']))
					$max=$this->parameters['max_result'];
				if(isset($this->parameters['page']))
					$page=$this->parameters['page'];
				$url=$_SERVER['REQUEST_URI'];
				if(stristr($url,"page=$page")) {
					$next=str_replace("page=$page","page=".($page+1),$url);
					if($page>1)
						$prev=str_replace("page=$page","page=".($page-1),$url);
				}
				else {
					$next=$url.(stristr($url,"?") ? "&" : "?")."page=".($page+1);
					if($page>1)
						$prev=str_replace("page=$page","page=".($page-1),$url);
				}
				print $this->list->getHTML(false, $type);
			}
		}

		private function addMore(&$arglist,$base=false) {
			$lang=lang_lang::getSingleton()->getLanguage();
			helper::debugPrint("AddMore: ".json_encode($arglist),"api");
			$arg=$arglist[0];
			helper::debugPrint("Arg: $arg","api");
			array_shift($arglist);
			if($arg=='me' && !in_array("matches", $this->args)) {
				helper::debugPrint("Me found","api");
				$arg='teams';
				array_unshift($arglist,config_conf::getSingleton()->get('my_team'));
			} /*elseif ($arg=='players') {
				if(in_array("matches",$this->args)) {
					$arg='matchplayer';
					array_unshift($arglist,"persons");				
				} else {
					$arg='player';
					array_unshift($arglist,"persons");
				}
			}*/ elseif ($arg=='matches') {
				helper::debugPrint('Arg is "matches" - table='.$this->table,"api");
				if(($this->qb->hasTable('team') || $this->table=='team') && $this->table!='competitor') {
					helper::debugPrint("Has a team table","api");
					$arg='_competitors';
					array_unshift($arglist,"matches");
				}
			}
			$this->args[]=$arg;
			if ($arg!="" && !$this->argIsParameter($arg,$arglist)) {
				helper::debugPrint("Find class for $arg","api");

				$c=new argToClass($arg);
				if($c->table=='') {
					return $arg;					
				}
				$c->remainingArgs=$arglist;
				if($base && !$c->isBase)
					throw new Exception("$arg is not a valid key");
				$this->c=$c;
				if($c->where)
					foreach($c->where as $w)
						$this->addToWhere($w);
				helper::debugPrint("argToClass: ".json_encode($c),"api");
				if(is_numeric($arglist[0])) {
					$this->addToWhere($c->abbr.".$c->idcolumn=".$arglist[0]);
					array_shift($arglist);
				}

				$include=false;
				if(isset($this->parameters['fields']))
					$include=array_merge(array('id',$c->idcolumn,$c->keycolumn),explode(",",$this->parameters['fields']));

				if($this->table) {
					helper::debugPrint("Create join: $this->table","api");
					//$this->qb->addJoin($this->table,$this->abbr,$this->table."_",false,false,array($this->abbr.'.'.$c->keycolumn."=".$c->abbr.".id"));
					if($c->idcolumn!='id')
						$this->qb->addInnerJoin($this->table,$this->abbr,$this->table."_",$include,false,array($this->abbr.'.'.$c->idcolumn."=".$c->abbr.".".$c->keycolumn));
					elseif($this->reverseColumns)
						$this->qb->addInnerJoin($this->table,$this->abbr,$this->table."_",$include,false,array($this->abbr.'.'.$c->keycolumn."=".$c->abbr.".".$c->idcolumn));
					else
						$this->qb->addInnerJoin($this->table,$this->abbr,$this->table."_",$include,false,array($this->abbr.'.'.$c->idcolumn."=".$c->abbr.".".$this->keycolumn));
				}
				$this->table=$c->table;
				$this->abbr=$c->abbr;
				$this->keycolumn=$c->keycolumn;
				$this->foreigncolumn=$c->foreigncolumn;
				$this->reverseColumns=$c->reverseColumns;
				$this->replaceColumns=array_merge_recursive($c->replaceColumns,$this->replaceColumns);
				helper::debugPrint("Replace columns: ".json_encode($this->replaceColumns),"api");
				if(!$c->skipStrings)
					$this->qb->addJoin($this->table."Strings",$this->abbr."s",$this->table."_",$include,array('id'),array($this->abbr."s.".$this->table."Id=".$this->abbr.".id",$this->abbr."s.languageId='$lang'"));
				helper::debugPrint("end of AddMore: ".json_encode($arglist),"api");

			}
			// *** VAR S H€R: ***
			//if(count($arglist)>0 && $arglist[0]!='') 
			if(count($arglist)>0)
				return $this->addMore($arglist);
			return true;
		}

		function ArgIsParameter($arg,&$arglist) {
			helper::debugPrint("Check if $arg is parameter","api");
			switch($arg) {
				case "now":
					$this->parameters['when']='now';
					return true;
					break;
				case "home":
					if(!in_array("matchplayer",$this->args)) {
						$this->addToWhere("cmp.orderNumber=1");
						$this->addToWhere("cmp.teamid=te.id");
					} else {
						$this->addToWhere("ply.competitorid IN (SELECT id FROM competitor WHERE matchid=ma.id and ordernumber=1)");						
					}
					return true;
					break;
				case "away":
					if(!in_array("matchplayer",$this->args)) {
						$this->addToWhere("cmp.orderNumber=2","cmp.teamid=te.id");
						$this->addToWhere("cmp.teamid=te.id");
					} else {
						$this->addToWhere("ply.competitorid IN (SELECT id FROM competitor WHERE matchid=ma.id and ordernumber=2)");						
					}
					return true;
					break;
				case "next":
					$this->addToWhere("ma.date>now()");
					if(!isset($this->parameters['max_result']))
						$this->parameters['max_result']=1;
					$this->parameters['order']='ma.date asc';
					return true;
					break;
				case "prev":
					$this->addToWhere('ma.date<now()');
					if(!isset($this->parameters['max_result']))
						$this->parameters['max_result']=1;
					$this->parameters['order']='ma.date desc';
					return true;
					break;
				case "page":
					$page=$arglist[0];
					array_shift($arglist);
					$this->parameters['page']=$page;
					return true;
					break;
				case "search":
					$this->search=$arglist[0];
					array_shift($arglist);
					return true;
					break;
			}
			return false;
		}
		
		public function getList() {
			return $this->list;
		}
		
		public function getClass() {
			return $this->c;
		}
	}

	class argToClass {

		public $class;
		public $table;
		public $isBase;
		public $abbr;
		public $keycolumn;
		public $idcolumn;
		public $where=false;
		public $skipStrings=false;
		public $reverseColumns=false;
		public $replaceColumns=array();
		public $remainingArgs=array();
		public $controller;
		
		function __construct($arg) {
			helper::debugPrint("Construct class from $arg","api");
			$this->controller=$arg;
			switch($arg) {
				case "countries":
					helper::debugPrint("Countries","api");
					$this->class='location_country';
					$this->table='country';
					$this->isBase=true;
					$this->abbr='co';
					$this->idcolumn='id';
					$this->keycolumn='countryid';
					break;
				/*case "country":
					helper::debugPrint("Country","api");
					$this->class='location_country';
					$this->table='country';
					$this->isBase=false;
					$this->abbr='co_';
					$this->idcolumn='id';
					$this->keycolumn='countryid';
					$this->reverseColumns=true;
					$this->controller="countries";*/
					break;					
				case "capital":
					helper::debugPrint("Capitals","api");
					$this->class='location_city';
					$this->table='city';
					$this->isBase=false;
					$this->abbr='caci';
					$this->idcolumn='capitalCityId';
					$this->keycolumn='id';
					$this->reverseColumns=false;
					$this->controller="cities";
					/*
					$this->replaceColumns=array();
					$this->replaceColumns["`caci`.`continentId`"]="IFNULL(caci.continentId,IFNULL((SELECT continentid FROM state WHERE caci.stateid=state.id),(SELECT continentid FROM country WHERE country.id=caci.countryid)))";
					$this->replaceColumns["caci.continentid"]="IFNULL(caci.continentId,IFNULL((SELECT continentid FROM state WHERE caci.stateid=state.id),(SELECT continentid FROM country WHERE country.id=caci.countryid)))";
					$this->replaceColumns["`caci`.`countryId`"]="IFNULL(caci.countryId,(SELECT countryid FROM state WHERE caci.stateid=state.id))";
					$this->replaceColumns["caci.countryid"]="IFNULL(caci.countryId,(SELECT countryid FROM state WHERE caci.stateid=state.id))";
					*/
					break;
				case "cities":
					helper::debugPrint("Cities","api");
					$this->class='location_city';
					$this->table='city';
					$this->isBase=true;
					$this->abbr='ci';
					$this->idcolumn='id';
					$this->keycolumn='cityid';
					$this->replaceColumns=array();
					$this->replaceColumns["`ci`.`continentId`"]="IFNULL(ci.continentId,IFNULL((SELECT continentid FROM state WHERE ci.stateid=state.id),(SELECT continentid FROM country WHERE country.id=ci.countryid)))";
					$this->replaceColumns["ci.continentid"]="IFNULL(ci.continentId,IFNULL((SELECT continentid FROM state WHERE ci.stateid=state.id),(SELECT continentid FROM country WHERE country.id=ci.countryid)))";
					$this->replaceColumns["`ci`.`countryId`"]="IFNULL(ci.countryId,(SELECT countryid FROM state WHERE ci.stateid=state.id))";
					$this->replaceColumns["ci.countryid"]="IFNULL(ci.countryId,(SELECT countryid FROM state WHERE ci.stateid=state.id))";
					break;
				case "states":
					helper::debugPrint("States","api");
					$this->class='location_state';
					$this->table='state';
					$this->isBase=true;
					$this->abbr='st';
					$this->idcolumn='id';
					$this->keycolumn='stateid';
					$this->replaceColumns=array();
					$this->replaceColumns["`st`.`continentId`"]="IFNULL(st.continentId,(SELECT continentId FROM country WHERE st.countryid=country.id))";
					$this->replaceColumns["st.continentId"]="IFNULL(st.continentId,(SELECT continentId FROM country WHERE st.countryid=country.id))";
					break;
				case "state":
					helper::debugPrint("State","api");
					$this->class='location_state';
					$this->table='state';
					$this->isBase=false;
					$this->abbr='st_';
					$this->idcolumn='id';
					$this->keycolumn='stateid';
					$this->reverseColumns=true;
					$this->controller="states";
					break;					
				case "continents":
					helper::debugPrint("Continents","api");
					$this->class='location_continent';
					$this->table='continent';
					$this->isBase=true;
					$this->abbr='con';
					$this->idcolumn='id';
					$this->keycolumn='continentid';
					break;
					/*
				case "continent":
					helper::debugPrint("Continent","api");
					$this->class='location_continent';
					$this->table='continent';
					$this->isBase=false;
					$this->abbr='con_';
					$this->idcolumn='id';
					$this->keycolumn='continentid';
					$this->reverseColumns=true;
					$this->controller="continents";
					break;	
					*/				
				case "arenas":
					helper::debugPrint("Arenas","api");
					$this->class='arena';
					$this->table='arena';
					$this->isBase=true;
					$this->abbr='ar';
					$this->idcolumn='id';
					$this->keycolumn='arenaid';
					$this->replaceColumns=array();
					$this->replaceColumns["`ar`.`continentid`"]="IFNULL(ar.continentid,IFNULL((SELECT continentid FROM city WHERE ar.cityid=city.id),IFNULL((SELECT continentid FROM state WHERE state.id=ar.stateid),(SELECT continentid FROM country WHERE country.id=ar.countryid))))";
					$this->replaceColumns["ar.continentid"]="IFNULL(ar.continentid,IFNULL((SELECT continentid FROM city WHERE ar.cityid=city.id),IFNULL((SELECT continentid FROM state WHERE state.id=ar.stateid),(SELECT continentid FROM country WHERE country.id=ar.countryid))))";
					$this->replaceColumns["`ar`.`countryid`"]="IFNULL(ar.countryid,IFNULL((SELECT countryid FROM city WHERE ar.cityid=city.id),(SELECT countryid FROM state WHERE state.id=ar.stateid)))";
					$this->replaceColumns["ar.countryid"]="IFNULL(ar.countryid,IFNULL((SELECT countryid FROM city WHERE ar.cityid=city.id),(SELECT countryid FROM state WHERE state.id=ar.stateid)))";
					$this->replaceColumns["`ar`.`stateid`"]="IFNULL(ar.stateId,(SELECT stateId FROM state WHERE ar.stateid=state.id))";
					$this->replaceColumns["ar.stateId"]="IFNULL(ar.stateId,(SELECT stateId FROM state WHERE ar.stateid=state.id))";
					break;
				case "teams":
					helper::debugPrint("Teams","api");
					$this->class='team';
					$this->table='team';
					$this->isBase=true;
					$this->abbr='te';
					$this->idcolumn='id';
					$this->keycolumn='teamid';
					break;
				case "persons":
					helper::debugPrint("Persons","api");
					$this->class='person_person';
					$this->table='person';
					$this->isBase=true;
					$this->abbr='pe';
					$this->idcolumn='id';
					$this->keycolumn='personid';
					break;
				case "matches":
					helper::debugPrint("Matches","api");
					$this->class='match_match';
					$this->table='match';
					$this->isBase=true;
					$this->abbr='ma';
					$this->idcolumn='id';
					$this->keycolumn='matchid';
					break;
				case "_competitors":
					helper::debugPrint("Competitors","api");
					$this->class='match_competitor';
					$this->table='competitor';
					$this->isBase=true;
					$this->abbr='cmp';
					$this->idcolumn='id';
					$this->keycolumn='teamid';
					$this->reverseColumns=true;
					$this->where=array('cmp.teamid=te.id','cmp.matchid=ma.id');
					break;
				case "player":
					helper::debugPrint("Player","api");
					$conf=config_conf::getSingleton();
					$playerRole=data_dataStore::getObjectWithId('person_role',$conf->get('playerRoleId',1));
					if(is_null($playerRole))
						$playerRole=$this->getRoleById($conf->get('playerRoleId',1));
					$playerRoles=$playerRole->getAllChildren();
					$list="($playerRole->id,";
					foreach($playerRoles as $role) {
						$list.=$role->id.',';
					}
					$list=substr_replace($list,")",strlen($list)-1);
					$this->where=array("per.roleId IN ".$list);
					$this->class='person_personRole';
					$this->table='personRole';
					$this->isBase=false;
					$this->abbr='per';
					$this->idcolumn='id';
					$this->keycolumn='teamid';
					$this->reverseColumns=true;
					$this->skipStrings=true;
				case "matchplayer":
					helper::debugPrint("Match Player","api");
					$conf=config_conf::getSingleton();
					$playerRole=data_dataStore::getObjectWithId('person_role',$conf->get('playerRoleId',1));
					if(is_null($playerRole))
						$playerRole=$this->getRoleById($conf->get('playerRoleId',1));
					$playerRoles=$playerRole->getAllChildren();
					$list="($playerRole->id,";
					foreach($playerRoles as $role) {
						$list.=$role->id.',';
					}
					$list=substr_replace($list,")",strlen($list)-1);
					$this->where=array("ply.roleId IN ".$list);
					$this->class='person_player';
					$this->table='player';
					$this->isBase=false;
					$this->abbr='ply';
					$this->idcolumn='id';
					$this->keycolumn='teamid';
					$this->reverseColumns=true;
					$this->skipStrings=true;
					$this->replaceColumns=array();
					$this->replaceColumns["ma.id=ply.matchid"]="ma.id=IFNULL(ply.matchid,(SELECT matchid FROM competitor WHERE ply.competitorid=competitor.id))";
				default:
					$this->controller="";
			}
		}
	}
?>