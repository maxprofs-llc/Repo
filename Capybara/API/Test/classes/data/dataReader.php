<?php
	class data_dataReader {
		
		protected $db=NULL;
		protected $lang=NULL;
		
		function __construct(data_database $db,$lang=NULL) {
			$this->db=$db;
			if(is_null($lang))
				$lang=new lang_lang('en');
			$this->lang=$lang;
			data_dataStore::setProperty('dataReader',$this);
		}	
		
		function getDatabaseName() {
			return $this->db->databaseName;
		}
		
		//Generic read functions
		
		function getGenericById($id,$table,$abbrevation,$className) {
			$object=data_dataStore::getObjectWithId($className,$id);
			if($object!=NULL && $object->cached)
				return $object;
			$object=new $className();
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			if(is_null($id)) {
				$object=$className::getUnknown();
				data_dataStore::setObject($className,$object);
				return $object;
			}
			if($id==0) {
				if(method_exists($className,'getNone'))
					$object=$className::getNone();
				else
					$object=$className::getUnknown();
				
				data_dataStore::setObject($className,$object);
				return $object;
			}
						
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect($table,$abbrevation,'',false,false,array($abbrevation.'.id='.$id));
			$qb->addJoin($table.'Strings',$abbrevation.'s','',false,array('id','languageid',$table.'id'),array($abbrevation.'s.'.$table.'Id='.$abbrevation.'.id',$abbrevation.'s.languageid="'.$lang.'"'));
			$qb->addJoin($table.'Strings','str','strings_',false,false,array('str.'.$table.'Id='.$abbrevation.'.id'));
			/*if(is_a($object,'locatable_inLocation'))
				$this->joinLocation($qb,$abbrevation);
			*/
			$qb->order=$abbrevation.'s.name';
			
			$query=$qb->getQuery();		
			$db->query($query);

			while($row = $db->getRow())
			{
				if(is_null($object->id)) {
					$object->getData($row);
					/*
					if(is_a($object,'locatable_inLocation'))
						$this->parseLocation($object,$row,'');
					*/
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$object->strings[$string->languageId]=$string;				
			}
			$object->cached=true;
			data_dataStore::setObject($className,$object);
			return $object;			
		}
			
		function getGenericList($table,$abbrevation,$className,$includeUnknown=false,$includeNone=false,$where=NULL) {			
			$lang=$this->lang->getLanguage();
			helper::debugPrint('Get list from database: '.$this->db->databaseName,'queries');
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect($table,$abbrevation,'');
			$qb->addJoin($table.'Strings',$abbrevation.'s','',false,array('id','languageid',$table.'id'),array($abbrevation.'s.'.$table.'id='.$abbrevation.'.id',$abbrevation.'s.languageid="'.$lang.'"'));
			if(!is_null($where))
				$qb->addWhereClause($abbrevation,$where);
			$qb->order=$abbrevation.'s.name';
			
			$query=$qb->getQuery();	
			$db->query($query);
			
			$objects=new baseClassList();
			if(method_exists($className,'getNone')) {
				$none=data_dataStore::getObjectWithId($className,0);
				if(is_null($none)) {
					$none=$className::getNone();
					data_dataStore::setObject($className,$none);
				}
			}
			if(method_exists($className,'getUnknown')) {
				$unknown=data_dataStore::getObjectWithId($className,NULL);
				if(is_null($unknown)) {
					$unknown=$className::getUnknown();
					data_dataStore::setObject($className,$unknown);
				}
			}
			if($includeNone)
			{
				$objects->Append($none);
			}
			if($includeUnknown)
			{
				$objects->Append($unknown);
			}
			while($row = $db->getRow())
			{
				$storedObj=data_dataStore::getObjectWithId($className,$row->id);	
				if(is_null($storedObj)) {
					$object=new $className();
					helper::debugPrint("Could not find $className with id $row->id in dataStore. Fetch from DB.",'cache');
					$object->getData($row);
					data_dataStore::setObject($className,$object);
					$objects->Append($object);
				} else {
					$objects->Append($storedObj);
				}
			}
	
			return $objects;
		}

		function getGenericKeyValueList($table,$abbrevation,$className,$includeUnknown=false,$includeNone=false) {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect($table,$abbrevation,'',false,false);
			$qb->addJoin($table.'Strings',$abbrevation.'s','',false,array('id'),array($abbrevation.'s.'.$table.'Id='.$abbrevation.'.id',$abbrevation.'s.languageid="'.$lang.'"'));
			$qb->order=$abbrevation."s.name";
			$query=$qb->getQuery();		
			$db->query($query);
			
			$objects=new baseClassList();
			if($includeUnknown) 
				$objects->Append(new keyValue($className::getUnknown()));
			if($includeNone) 
				$objects->Append(new keyValue($className::getNone()));
				
			while($row = $db->getRow())
			{
				$object=new $className();
				$object->getData($row);
				$kv=new keyValue($object);
				$objects->Append($kv);
			}
			return $objects;			
		}		

		//Match report
		
		function getMatchReport($matchId,$languageId,$organizationId) {
			//Implementera funktionen	
			return "";
		}
				
		//Precipitation types
		
		function getPrecipitationTypeList($includeUnknown=false,$includeNone=false) {
			return $this->getGenericList('precipitationType','pt','precipitationType',$includeUnknown,$includeNone);
		}
		
		function getPrecipitationTypeById($id) {
			return $this->getGenericById($id,'precipitationType','pt','precipitationType');
		}
		//GeoDirection
		
		function getGeoDirectionList($includeUnknown=false) {
			return $this->getGenericList('geoDirection','gd','geoDirection',$includeUnknown);
		}
		
		function getGeoDirectionById($id) {
			return $this->getGenericById($id,'geoDirection','gd','geoDirection');
		}
		
		//Search
		
		function getSearchResult($search,$table,$className,$keyvalues=true) {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			if($keyvalues)
				$cols=array('id');
			else
				$cols=false;
				
			$qb->addSelect($table,'obj','',$cols);
			$qb->addInnerJoin($table.'Strings','str','',false,array('id','languageid',$table.'id'),array('str.'.$table.'id=obj.id','str.languageid="'.$lang.'"'));
			$qb->addWhereClause('str',array("str.name LIKE '%$search%'"));
			$qb->order='str.name';
			
			$query=$qb->getQuery();		
			$db->query($query);
						
			$objects=new baseClassList();			
			while($row = $db->getRow())
			{
				$storedObj=&data_dataStore::getObjectWithId($className,$row->id);	
				if(is_null($storedObj)) {
					$object=new $className();
					helper::debugPrint("Could not find $className with id $row->id in dataStore. Fetch from DB.",'cache');
					$object->getData($row);
					data_dataStore::setObject($className,$object);
					if($keyvalues)
						$objects->Append(new keyValue($object));
					else
						$objects->Append($object);
				} else {
					if($keyvalues)
						$objects->Append(new keyValue($storedObj));
					else
						$objects->Append($storedObj);
				}
			}
			return $objects;
		}
		
		//Organization

		function getOrganizationById($id) {
			$object=data_dataStore::getObjectWithId('organization',$id);
			if(!is_null($object) && $object->cached)
				return $object;
			if(is_null($id)) {
				$object=organization::getUnknown();
				$object->cached=true;
				data_dataStore::setObject('organization',$object);
				return $object;	
			}
			if($id==0) {
				$object=organization::getNone();
				$object->cached=true;
				data_dataStore::setObject('organization',$object);
				return $object;
			}
			
			$table='organization';
			$abbrevation='org';
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect($table,$abbrevation,'',false,false,array($abbrevation.'.id='.$id));
			$qb->addJoin($table.'Strings',$abbrevation.'s','',false,array('id','languageId',$table.'id'),array($abbrevation.'s.'.$table.'Id='.$abbrevation.'.id',$abbrevation.'s.languageId="'.$lang.'"'));
			$qb->addJoin($table.'Strings','str','strings_',false,false,array('str.'.$table.'Id='.$abbrevation.'.id'));
			/*
			$qb->addJoin('organization','porg','parentOrganization_',false,false,array('org.parentOrganizationId=porg.id'));
			$qb->addJoin('organizationStrings','porgs','parentOrganization_',false,array('id','languageId','organiztionId'),array('porgs.organizationId=porg.id','porgs.languageId="'.$lang.'"'));
			$qb->addJoin('organizationType','ot','organizationType_',false,false,array('org.organizationTypeId=ot.id'));
			$qb->addJoin('organizationTypeStrings','ots','organizationType_',false,array('id','languageId','organizationTypeId'),array('ot.id=ots.organizationTypeId','ots.languageId='.$lang));
			*/
			//$qb=$this->joinLocation($qb,$abbrevation);
			$qb->order=$abbrevation.'s.name';
			
			$query=$qb->getQuery();		
			$db->query($query);

			while($row = $db->getRow())
			{
				if(is_null($object)) {
					$object=new organization();
					$object->getData($row);
					/*
					$this->parseLocation($object,$row,'');
					$object->parentOrganization=new organization();
					$object->parentOrganization->id=$row->parentOrganizationId;
					$object->parentOrganization->getData($row,'parentOrganization_');
					$object->organizationType=new organizationType();
					$object->organizationType->id=$row->organizationTypeId;
					$object->organizationType->getData($row,'organizationType_');
					*/
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$object->strings[$string->languageId]=$string;				
			}
			$object->cached=true;
			data_dataStore::setObject('organization',$object);
			return $object;	
		}
		
		function getOrganizationList($includeUnknown=false,$includeNone=false) {
			return $this->getGenericList('organization','org','organization',$includeUnknown,$includeNone);			
		}	

		//Organization Type
		
		function getOrganizationTypeById($id) {
			$table='organizationType';
			$abbrevation='ot';
			if(is_null($id))
				return organizationType::getUnknown();
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect($table,$abbrevation,'',false,false,array($abbrevation.'.id='.$id));
			$qb->addJoin($table.'Strings',$abbrevation.'s','',false,array('id','languageId',$table.'id'),array($abbrevation.'s.'.$table.'Id='.$abbrevation.'.id',$abbrevation.'s.languageId="'.$lang.'"'));
			$qb->addJoin($table.'Strings','str','strings_',false,false,array('str.'.$table.'Id='.$abbrevation.'.id'));
			$qb->addJoin('organizationType','pot','parentOrganizationType_',false,false,array('ot.parentOrganizationTypeId=pot.id'));
			$qb->addJoin('organizationTypeStrings','pots','parentOrganizationType_',false,array('id','languageId','organizationTypeId'),array('pot.id=pots.organizationTypeId','pots.languageId='.$lang));
			$qb->order=$abbrevation.'s.name';
			
			$query=$qb->getQuery();		
			$db->query($query);

			while($row = $db->getRow())
			{
				if(is_null($object)) {
					$object=new organizationType();
					$object->getData($row);
					$object->parentOrganizationType=new organizationType();
					$object->parentOrganizationType->id=$row->parentOrganizationTypeId;
					$object->parentOrganizationType->getData($row,'parentOrganizationType_');
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$object->strings[$string->languageId]=$string;				
			}
			return $object;			
		}
		
		function getOrganizationTypeList() {
			return $this->getGenericList('organizationType','ot','organizationType');
		}
		
		//Cohort

		function getCohortById($id) {
			return $this->getGenericById($id,'cohort','ch','team_cohort');		
		}
		
		function getCohortList($includeUnknown=false,$includeNone=false) {
			return $this->getGenericList('cohort','ch','team_cohort',$includeUnknown,$includeNone);					
		}
				
		//AgeGroup

		function getAgeGroupById($id) {
			return $this->getGenericById($id,'ageGroup','ag','team_ageGroup');		
		}
		
		function getAgeGroupList($includeUnknown=false,$includeNone=false) {
			return $this->getGenericList('ageGroup','ag','team_ageGroup',$includeUnknown,$includeNone);			
		}
		

		//Match report
		
		function getMatchReportById($id) {
			//getMatchReportForMatchWithId returns article designated as matchReport with matchReport.id = $id.
			//There can be several articles designated as match reports, chosen by different organizations and written in different languages.
						
			$abbrevation = 'mr';
			$where = array(
				$abbrevation.'.id='.$id,
				'a.isHidden=false',
			);
			
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('matchReport', 'mr', '', false, false, $where);
			$qb->addJoin('article', 'a', '', false, false, 'a.id=mr.articleId');
			$qb->addJoin('writer', 'w', '', false, false, 'w.articleId=a.id');
			
			$query=$qb->getQuery();
			$db->query($query);
			
			while($row = $db->getRow())
			{
				$object=new match_matchReport();
				$object->getData($row); //TODO: article.organizationId = publisher, and matchReport.organizationId = the org that designated article as matchReport. How do we determine which column is which?
				$string=new strings(); //TODO: Are the strings functionality really necessary for matchReports? They're actually there, but since we explicitely set $languageId?
				$string->getData($row,'strings_');
				$object->strings[$string->languageId]=$string;
			}
			return $object;
		}		
				
		function getMatchReportForMatchWithId($matchId,$languageId = false,$organizationId = false) {
			//getMatchReportForMatchWithId returns article designated as matchReport for the match $matchId.
			//There can be several articles designated as match reports, chosen by different organizations and written in different languages.
			
			if ( $languageId == false || $languageId == 0) {
				$languageId = $this->lang->getLanguage();
			}
			if ( $organizationId == false || $organizationId == 0) {
				$organizationId = $this->lang->getDefaultOrganization(); //TODO: How to get the default organizationId?
			}
			
			$abbrevation = 'mr';
			$where = array(
				$abbrevation.'.matchId='.$matchId,
				$abbrevation.'.languageId='.$languageId,
				$abbrevation.'.organizationId='.$organizationId,
				'a.isHidden=false',
			);
			
			$db=clone $this->db;
			
			//TODO: Get matchReport in default language if chosen language article does not exist.
			//TODO: Get matchReport in second language (English?) if chosen and default language articles do not exist?
			//TODO: Get matchReport in any other language if none of the above exist?
			//TODO: Get matchReport for period if report for full match does not exist?
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('matchReport', 'mr', '', false, false, $where);
			$qb->addJoin('article', 'a', '', false, false, 'a.id=mr.articleId');
			$qb->addJoin('writer', 'w', '', false, false, 'w.articleId=a.id');
			
			$query=$qb->getQuery();
			$db->query($query);
			
			while($row = $db->getRow())
			{
				$object=new match_matchReport();
				$object->getData($row); //TODO: article.organizationId = publisher, and matchReport.organizationId = the org that designated article as matchReport. How do we determine which column is which?
				$string=new strings(); //TODO: Are the strings functionality really necessary for matchReports? They're actually there, but since we explicitely set $languageId?
				$string->getData($row,'strings_');
				$object->strings[$string->languageId]=$string;
			}
			return $object;
		}		

		function getMatchReportListForMatchWithId($matchId,$languageId = NULL,$organizationId = NULL) {
			//getMatchReportForMatchWithId returns article designated as matchReport for the match $matchId.
			//There can be several articles designated as match reports, chosen by different organizations and written in different languages.
				
			if ( $languageId == false || $languageId == 0) {
				$languageId = $this->lang->getLanguage();
			}
			if ( $organizationId == false || $organizationId == 0) {
				$organizationId = $this->lang->getDefaultOrganization(); //TODO: How to get the default organizationId?
			}
				
			$abbrevation = 'mr';
			$where = array( $abbrevation.'.matchId='.$matchId );
			if ( $languageId != NULL ) {
				$where[] = $abbrevation.'.languageId='.$languageId;
			}
			if ( $organizationId != NULL ) {
				$where[] = $abbrevation.'.organizationId='.$organizationId;
			}
			$where[] = 'a.isHidden=false';
				
			$db=clone $this->db;
				
			//TODO: Get matchReports in default language if chosen language articles does not exist.
			//TODO: Get matchReports in second language (English?) if chosen and default language articles do not exist?
			//TODO: Get matchReports in any other language if none of the above exist?
			//TODO: Get matchReports for period if report for full match does not exist?
			
			$qb=new data_queryBuilder($db);
				
			$qb->addSelect('matchReport', 'mr', '', false, false, $where);
			$qb->addJoin('article', 'a', '', false, false, 'a.id=mr.articleId');
			$qb->addJoin('writer', 'w', '', false, false, 'w.articleId=a.id');
				
			$query=$qb->getQuery();
			$db->query($query);
			
			$reports = new baseClassList();
			while($row = $db->getRow())
			{
				$storedObj=data_dataStore::getObjectWithId('match_matchReport',$row->id); //TODO: Cache stuff needed?
				if(is_null($storedObj)) { //TODO: Cache stuff needed?
					$object=new match_matchReport();
					helper::debugPrint("Could not find match_matchReport with id $row->id in dataStore. Fetch from DB.",'cache'); //TODO: Cache stuff needed?
					$object->getData($row);
					data_dataStore::setObject('match_matchReport',$object); //TODO: Cache stuff needed?
					$report=$object;
				} else { //TODO: Cache stuff needed?
					$ref=$storedObj; //TODO: Cache stuff needed?
				} //TODO: Cache stuff needed?
				$reports['id'.$row->id]=new keyValue($report);
			}
			
			return $reports;
		}
		
		//Referees
		
		function getRefereeList($includeUnknown=false,$includeNone=false,$atDate=NULL) {
			$refRole=$this->getRoleById(config_conf::getSingleton()->get('referee_role_id',65));
			$refRoles=$refRole->getAllChildren();
			$list="(".config_conf::getSingleton()->get('referee_role_id',65).",";
			foreach($refRoles as $role) {
				$list.=$role->id.',';
			}
			$list=substr_replace($list,")",strlen($list)-1);
			
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect("person","pe",'',array('id'),false);
			$qb->addJoin('personStrings','pes','',false,array('id'),array('pes.personId=pe.id'));
			$role=array("pe.id=per.personId","per.roleId IN ".$list);
			if(!is_null($teamId))
				$role[]="per.teamId=$teamId";
			if(!is_null($atDate)) {
				$role[]="ifnull(per.startDate,0)<='$atDate'";
				$role[]="(isnull(per.endDate) or per.endDate>='$atDate')";
			}
			$qb->addInnerJoin('personRole','per','',array('roleId'),false,$role);
			$qb->order="pes.name";
			$query=$qb->getQuery();		
			$db->query($query);
			
			$refs=new baseClassList();
			if($includeUnknown)
				$refs['id']=new keyValue($this->getPersonById(NULL));
			if($includeNone)
				$refs['id0']=new keyValue($this->getPersonById(0));
				
			while($row = $db->getRow())
			{
				$storedObj=data_dataStore::getObjectWithId('person_person',$row->id);	
				if(is_null($storedObj)) {
					$object=new person_person();
					helper::debugPrint("Could not find person_person with id $row->id in dataStore. Fetch from DB.",'cache');
					$object->getData($row);
					data_dataStore::setObject('person_person',$object);
					$ref=$object;
				} else {
					$ref=$storedObj;
				}				
				$refs['id'.$row->id]=new keyValue($ref);
			}
			return $refs;
		}		
		
		//Players
		
		function getPlayerList($includeUnknown=false,$includeNone=false,$teamId=NULL,$atDate=NULL) {
			$conf=config_conf::getSingleton();
			$lang=$this->lang->getLanguage();
			$playerRole=data_dataStore::getObjectWithId('person_role',$conf->get('playerRoleId',1));
			if(is_null($playerRole))
				$playerRole=$this->getRoleById($conf->get('playerRoleId',1));
			$playerRoles=$playerRole->getAllChildren();
			$list="(1,";
			foreach($playerRoles as $role) {
				$list.=$role->id.',';
			}
			$list=substr_replace($list,")",strlen($list)-1);
			
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect("person","pe",'',false,false);
			$qb->addJoin('personStrings','pes','',false,array('id'),array('pes.personId=pe.id','pes.languageid="'.$lang.'"'));
			$role=array("pe.id=per.personId","per.roleId IN ".$list);
			if(!is_null($teamId))
				$role[]="per.teamId=$teamId";
			if(!is_null($atDate)) {
				$role[]="ifnull(per.startDate,0)<='$atDate'";
				$role[]="(isnull(per.endDate) or per.endDate>='$atDate')";
			}
			$qb->addInnerJoin('personRole','per','',array('roleId'),false,$role);
			$qb->order="pes.name";
			$query=$qb->getQuery();		
			$db->query($query);
			
			$players=new baseClassList();
			if($includeUnknown)
				$players['id']=new keyValue($this->getPersonById(NULL));
			if($includeNone)
				$players['id0']=new keyValue($this->getPersonById(0));
				
			while($row = $db->getRow())
			{
				$storedObj=data_dataStore::getObjectWithId('person_person',$row->id);	
				if(is_null($storedObj)) {
					$object=new person_person();
					helper::debugPrint("Could not find person_person with id $row->id in dataStore. Fetch from DB.",'cache');
					$object->getData($row);
					data_dataStore::setObject('person_person',$object);
					$player=$object;
				} else {
					$player=$storedObj;
				}				
				$players['id'.$row->id]=new keyValue($player);
			}
			return $players;
		}
		
		function getPlayerById($id) {
			if(is_null($id)) {
				$object=person_player::getUnknown();
				$object->cached=true;
				data_dataStore::setObject('person_player',$object);
				return $object;
			}
			if($id==0) {
				$object=person_player::getNone();
				$object->cached=true;
				data_dataStore::setObject('person_player',$object);
				return $object;	
			}
			helper::debugPrint('Get player from db '.$id,'goal');
			$object=new person_player();
			
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('player','pl','',false,false,array("pl.id=$id"));
			$qb->addJoin("person","pe",'',false,array('id'),array("pl.personId=pe.id"));
			$qb->addJoin('personStrings','pes','',false,array('id','personId'),array('pes.personId=pe.id','pes.languageid="'.$lang.'"'));
			$qb->order='pl.id';
			
			$query=$qb->getQuery();		
			$db->query($query);
			helper::debugPrint('Query: <br>'.$query,'goal');
			
			while($row = $db->getRow())
			{
				if(is_null($object->id)) {
					$object->getData($row);
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$object->strings[$string->languageId]=$string;				
			}
			return $object;			
		}
		
		function getPlayerFromPersonOnMatch($personId,$matchId,$competitorId=false) {
			$object=new person_player();
			
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$where=array("pl.personId=$personId","pl.matchId=$matchId");
			if($competitorId)
				$where[]="pl.competitorId=$competitorId";
							
			$qb->addSelect('player','pl','',false,false,$where);
			$qb->addJoin("person","pe",'',false,array('id'),array("pl.personId=pe.id"));
			$qb->addJoin('personStrings','pes','',false,array('id'),array('pes.personId=pe.id','pes.languageid="'.$lang.'"'));
			$qb->order='pl.id';
			
			$query=$qb->getQuery();		
			$db->query($query);

			while($row = $db->getRow())
			{
				if(is_null($object->id)) {
					$object->getData($row);
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$object->strings[$string->languageId]=$string;				
			}
			return $object;
		}
		
		function getSquadForCompetitor($id) {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			$qb->addSelect('player','pl','',false,false,array('competitorId='.$id,"pl.id NOT IN (SELECT nextPlayerId FROM substitution s,matchEvent me WHERE s.matchEventId=me.id AND me.competitorId=$id)"));
			$qb->addJoin("person","pe",'',false,array('id'),array("pl.personId=pe.id"));
			$qb->addJoin('personStrings','pes','',false,array('id','personId'),array('pes.personId=pl.personid','pes.languageid="'.$lang.'"'));
			$qb->order='pl.id';

			$query=$qb->getQuery();		
			$db->query($query);

			$players=new baseClassList();
			while($row = $db->getRow())
			{
				$storedObj=data_dataStore::getObjectWithId('person_player',$row->id);	
				if(is_null($storedObj)) {
					$object=new person_player();
					helper::debugPrint("Could not find person_player with id $row->id in dataStore. Fetch from DB.",'cache');
					$object->getData($row);
					data_dataStore::setObject('person_player',$object);
					$player=$object;
				} else {
					$player=$storedObj;
				}				
				if($i=$players->find($player->personId,'personId')) {
					$oldplayer=$players[$i];
					//Add code to replace pseudo code below
					//if($oldplayer is more fit to be in starting squad than $player)
					//$players[$i]=$player
				} else {
					$players->append($player);
				}
			}
			return $players;	
		}
		
		function getCaptainsForCompetitor($id) {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			$qb->addSelect('player','pl','',false,false,array("pl.id IN (SELECT c.playerid FROM captain c,player WHERE c.competitorid=$id OR (c.playerid=player.id and player.competitorid=$id))"));
			$qb->addJoin("person","pe",'',false,array('id'),array("pl.personId=pe.id"));
			$qb->addJoin('personStrings','pes','',false,array('id','personId'),array('pes.personId=pl.personid','pes.languageid="'.$lang.'"'));
			$qb->order='pl.id';

			$query=$qb->getQuery();		
			$db->query($query);

			$players=new baseClassList();
			while($row = $db->getRow())
			{
				$storedObj=data_dataStore::getObjectWithId('person_player',$row->id);	
				if(is_null($storedObj)) {
					$object=new person_player();
					helper::debugPrint("Could not find person_player with id $row->id in dataStore. Fetch from DB.",'cache');
					$object->getData($row);
					data_dataStore::setObject('person_player',$object);
					$player=$object;
				} else {
					$player=$storedObj;
				}				
				if($i=$players->find($player->personId,'personId')) {
					$oldplayer=$players[$i];
					//Add code to replace pseudo code below
					//if($oldplayer is more fit to be in starting squad than $player)
					//$players[$i]=$player
				} else {
					$players->append($player);
				}
			}
			return $players;	
		}
		
		function getSubstitutionsForCompetitor($id) {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			$qb->addSelect('substitution','sub','',false,false,array('competitorId='.$id));
			$qb->addJoin('matchEvent','m','',false,array('id'),array('sub.matchEventId=m.id'));
			
			$query=$qb->getQuery();		
			$db->query($query);

			$subs=new baseClassList();
			while($row = $db->getRow())
			{
				$storedObj=data_dataStore::getObjectWithId('match_substitution',$row->id);	
				if(is_null($storedObj)) {
					$object=new match_substitution();
					helper::debugPrint("Could not find match_substitution with id $row->id in dataStore. Fetch from DB.",'cache');
					$object->getData($row);
					data_dataStore::setObject('match_substitution',$object);
					$sub=$object;
				} else {
					$sub=$storedObj;
				}				
				$subs->append($sub);			
			}
			return $subs;
		}
		
		//Person
		
		function getPersonById($id,$canBeIncomplete=false) {
			helper::debugPrint('Person Id: '.$id,'cache');
			$object=data_dataStore::getObjectWithId('person_person',$id);
			helper::debugPrint('Found in cache: '.(is_null($object)?'No':'Yes'),'cache');
			helper::debugPrint('Complete cache: '.($object->cached?'Yes':'No'),'cache');
			if(!is_null($object) && ($object->cached || $canBeIncomplete)) {
				return $object;
			}
			if(is_null($id)) {
				$object=person_person::getUnknown();
				$object->cached=true;
				data_dataStore::setObject('person_person',$object);
				return $object;
			}
			if($id==0) {
				$object=person_person::getNone();
				$object->cached=true;
				data_dataStore::setObject('person_person',$object);
				return $object;	
			}
			helper::debugPrint("Read from Database",'cache');
			$object=new person_person();
			$abbrevation='pe';
			$table='person';
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect($table,$abbrevation,'',false,false,array($abbrevation.'.id='.$id));
			$qb->addJoin($table.'Strings',$abbrevation.'s','',false,array('id','languageid',$table.'id'),array($abbrevation.'s.'.$table.'Id='.$abbrevation.'.id',$abbrevation.'s.languageid="'.$lang.'"'));
			$qb->addJoin($table.'Strings','str','strings_',false,false,array('str.'.$table.'Id='.$abbrevation.'.id'));
			$this->joinLocation($qb,$abbrevation);
//			$this->joinCity($qb,$abbrevation.'.birthCityId','birthLocation_','blci');
//			$this->joinCity($qb,$abbrevation.'.birthStateId','birthLocation_','blst');
			$qb->order=$abbrevation.'s.name';
			
			$query=$qb->getQuery();		
			$db->query($query);

			while($row = $db->getRow())
			{
				if(is_null($object->id)) {
					$object->getData($row);
					/*
					$this->parseLocation($object,$row,'');
					$object->birthLocation->city=$this->getCityById($row->birthCityId);
					$object->birthLocation->state=$this->getStateById($row->birthStateId);
					$object->birthLocation->country=$this->getCountryById($row->birthCountryId);
					$object->birthLocation->continent=$this->getContinentById($row->birthContinentId);
					helper::safeSetProperty($object->birthLocation,'latitude',$row,'birthLatitude');
					helper::safeSetProperty($object->birthLocation,'longitude',$row,'birthLongitude');
					*/
					$object->roles=$this->getPersonRoleList($id);
					$object->dimensions=$this->getPersonDimensions($id);
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$object->strings[$string->languageId]=$string;				
			}
			$object->cached=true;
			helper::debugPrint('Read and parsed person_person with id '.$object->id,'database');
			data_dataStore::setObject('person_person',$object);
			helper::debugPrint('Stored person_person has id:'.data_dataStore::getStaticStore('person_person',$id)->id,'database');
			return $object;	
		}
		
		function getPersonList($includeUnknown=false,$includeNone=false,$teamId=false) {
			if(!$teamId)
				return $this->getGenericList('person','pe','person_person',$includeUnknown,$includeNone);
			else
				return $this->getGenericList('person','pe','person_person',$includeUnknown,$includeNone); //-
		}

		//Role
		
		function getRoleList($includeUnknown=false,$includeNone=false) {
			$list=$this->getGenericList('role','ro','person_role',$includeUnknown,$includeNone);
			return $list;
		}
		
		function getRoleById($id) {
			if(is_null($id)) {
				helper::debugPrint("Return NULL from dataStore",'roles');
				$object=person_role::getUnknown();
				$object->cached=true;
				data_dataStore::setObject('person_role',$object);
				return $object;
			}
			if($id==0) {
				$object=person_role::getNone();
				helper::debugPrint("Return None from dataStore",'roles');
				$object->cached=true;
				data_dataStore::setObject('person_role',$object);
				return $object;
			}
			$object=data_dataStore::getObjectWithId("person_role",$id);
			if(is_null($object))
				helper::debugPrint("Object is NULL for ID $id",'roles');
			else
				helper::debugPrint("Object is not NULL for ID $id",'roles');
			
			if($object->cached)
				helper::debugPrint("Object is cached for ID $id",'roles');
			else
				helper::debugPrint("Object is not cached for ID $id",'roles');
		
			if($object!=NULL && $object->cached) {
				helper::debugPrint("Return $id from dataStore",'roles');
				return $object;
			}
			helper::debugPrint("Return $id from database",'roles');
			$object=NULL;
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('role','ro','',false,false,array('ro.id='.$id));
			$qb->addJoin('roleStrings','ros','',false,array('id','languageId','roleid'),array('ros.'.'roleId='.'ro.id','ros.languageId="'.$lang.'"'));
			$qb->addJoin('roleStrings','str','strings_',false,false,array('str.'.'roleId='.'ro.id'));
			//$qb->addJoin('role','pro','parentRole_',false,false,array('ro.parentRoleId=pro.id'));
			//$qb->addJoin('roleStrings','pros','parentRole_',false,array('id','languageId','roleId'),array('pros.roleId=pro.id','pros.languageId="'.$lang.'"'));
			$qb->order='ros.name';
			
			$query=$qb->getQuery();		
			$db->query($query);

			while($row = $db->getRow())
			{
				if(is_null($object)) {
					$object=new person_role();
					$object->getData($row);
					/*
					$object->parentRole=new person_role();
					$object->parentRole->id=$row->parentRoleId;
					$object->parentRole->getData($row,'parentRole_');
					*/
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$object->strings[$string->languageId]=$string;				
			}
			$object->cached=true;
			data_dataStore::setObject('person_role',$object);
			return $object;
		}
		
		//Person role
		
		function getPersonRoleList($personId) { //,$includeTeamUnknownOrNone=false,$includeOrganizationUnknownOrNone=false) {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;

			$qb=new data_queryBuilder($db);
			
			/*
			$where=array();
			if(!$includeTeamUnknownOrNone) 
				$where[]="IFNULL(ro.teamId,0)>0";
			if(!$includeOrganizationUnknownOrNone) 
				$where[]="IFNULL(ro.organizationId,0)>0";
			*/
			
			$qb->addSelect('personRole','pero','',false,false,array('pero.personId='.$personId));
			$qb->addJoin('role','ro','',false,array('id','privateComment'),array('pero.roleId=ro.id'));
			$qb->addJoin('roleStrings','ros','',false,array('id','languageId','roleId'),array('ros.roleId=pero.roleId','ros.languageId="'.$lang.'"'));
			$qb->addJoin('team','te','team_',false,false,array('pero.teamId=te.id'));
			$qb->addJoin('teamStrings','tes','team_',false,array('id','languageId','roleId'),array('tes.teamId=te.id','tes.languageId="'.$lang.'"'));
			$qb->order='pero.startDate,pero.isPrimary desc';
			
			$query=$qb->getQuery();		
			$db->query($query);

			$roles=new baseClassList();
			while($row = $db->getRow())
			{
				$role=new person_personRole();
				$role->getData($row);
				$roles->Append($role);
			}
			return $roles;
		}
		
		function getPersonDimensions($personId) {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;

			$qb=new data_queryBuilder($db);
			
			/*
			$where=array();
			if(!$includeTeamUnknownOrNone) 
				$where[]="IFNULL(ro.teamId,0)>0";
			if(!$includeOrganizationUnknownOrNone) 
				$where[]="IFNULL(ro.organizationId,0)>0";
			*/
			
			$qb->addSelect('personDimension','pedi','',false,false,array('pedi.personId='.$personId));
			$qb->order='pedi.date';
			
			$query=$qb->getQuery();		
			$db->query($query);

			$dimensions=new baseClassList();
			while($row = $db->getRow())
			{
				$dim=new person_personDimension();
				$dim->getData($row);
				$dimensions->Append($dim);
			}
			return $dimensions;
		}
		
		//Team
			
		function getTeamById($id) {
			$team=data_dataStore::getObjectWithId('team',$id);
			if($team!=NULL && $team->cached)
				return $team;

			if(is_null($id)) {
				$team=team::getUnknown();
				$team->cached=true;
				data_dataStore::setObject('team',$team);
				return $team;	
			}
			if($id==0) {
				$team=team::getUnknown();
				$team->cached=true;
				data_dataStore::setObject('team',$team);
				return $team;	
			}
												
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('team','te','',false,false,array('te.id='.$id));
			$qb->addJoin('teamStrings','tes','',false,array('id','languageid','teamid'),array('tes.teamId=te.id','tes.languageId="'.$lang.'"'));
			$qb->addJoin('teamStrings','str','strings_',false,false,array('str.teamId=te.id'));
			$qb->addJoin('organization','org','organization_',false,false,array('org.id=te.organizationId'));
			$qb->addJoin('organizationStrings','orgs','organization_',false,false,array('org.id=orgs.organizationId','orgs.languageId='.$lang));
			$qb->addJoin('sport','sp','sport_',false,false,array('te.sportId=sp.id'));
			$qb->addJoin('sportStrings','sps','sport_',false,false,array('te.sportId=sps.sportId','sps.languageId='.$lang));
			$qb->addJoin('gender','ge','gender_',false,false,array('te.genderId=ge.id'));
			$qb->addJoin('genderStrings','ges','gender_',false,false,array('te.genderId=ges.genderId','ges.languageId='.$lang));
			$qb->addJoin('section','se','section_',false,false,array('te.sectionId=se.id'));
			$qb->addJoin('sectionStrings','ses','section_',false,false,array('te.sectionId=ses.sectionId','ses.languageId='.$lang));
			$qb->order='tes.name';
			
			$query=$qb->getQuery();		
			$db->query($query);

			while($row = $db->getRow())
			{
				if(is_null($team)) {
					$team=new team();
					$team->getData($row);
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$team->strings[$string->languageId]=$string;				
			}
			$team->cached=true;
			data_dataStore::setObject('team',$team);
			return $team;		
		}
		
		function getTeamList($includeUnknown=false) {	
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('team','te','');
			$qb->addJoin('teamStrings','tes','',false,array('id','languageid','teamid'),array('tes.teamid=te.id','tes.languageid="'.$lang.'"'));
			$qb->addJoin('sport','sp','sport_',false,false,array('te.sportId=sp.id'));
			$qb->addJoin('sportStrings','sps','sport_',false,false,array('te.sportId=sps.sportId','sps.languageId='.$lang));
			$qb->addJoin('gender','ge','gender_',false,false,array('te.genderId=ge.id'));
			$qb->addJoin('genderStrings','ges','gender_',false,false,array('te.genderId=ges.genderId','ges.languageId='.$lang));
			$qb->addJoin('section','se','section_',false,false,array('te.sectionId=se.id'));
			$qb->addJoin('sectionStrings','ses','section_',false,false,array('te.sectionId=ses.sectionId','ses.languageId='.$lang));
			$qb->order='tes.name';
			
			$query=$qb->getQuery();		
			$db->query($query);

			$teams=new baseClassList();
			$list=new baseClassList();
			$unknown=team::getUnknown();
			$list->Append($unknown);
			if($includeUnknown)
			{
				$teams->Append($unknown);
			}
			while($row = $db->getRow())
			{
				$team=data_dataStore::getObjectWithId('team',$row->id);
				if($team==NULL) {
					$team=new team();
					$team->getData($row);				
					//$team->sport=new sport();
					//$team->sport->getData($row,'sport_');
					//$team->gender=new gender();
					//$team->gender->getData($row,'gender_');
					//$team->section=new team_section();
					//$team->section->getData($row,'section_');
				}
				$teams->Append($team);
				$list->Append($team);				
			}
			data_dataStore::setObjectList('team',$list);	
			return $teams;			
		}
		
		//MatchType

		function getMatchTypeById($id) {
			return $this->getGenericById($id,'matchType','mt','matchType');		
		}
		
		function getMatchTypeList() {
			return $this->getGenericList('matchType','mt','matchType');			
		}
		
		//Gender

		function getGenderById($id) {
			return $this->getGenericById($id,'gender','ge','gender');		
		}
		
		function getGenderList() {
			return $this->getGenericList('gender','ge','gender');			
		}
		
		//Season
		function getSeasonById($id) {
			return $this->getGenericById($id,'season','se','season');
		}
		
		function getSeasonList() {
			return $this->getGenericList('season','se','season');
		}
		//Sport
		
		function getSportById($id) {
			return $this->getGenericById($id,'sport','sp','sport');
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('sport','sp','',false,false,array('sp.id='.$id));
			$qb->addJoin('sportStrings','sps','',false,array('id','languageid','sportid'),array('sps.sportid=sp.id','sps.languageid="'.$lang.'"'));
			$qb->addJoin('sportStrings','str','strings_',false,false,array('str.sportid=sp.id'));
			$qb->order='sps.name';
			
			$query=$qb->getQuery();		
			$db->query($query);

			while($row = $db->getRow())
			{
				if(is_null($sport)) {
					$sport=new sport();
					$sport->getData($row);
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$sport->strings[$string->languageId]=$string;				
			}
			return $sport;		
		}
		
		function getSportList() {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('sport','sp','');
			$qb->addJoin('sportStrings','sps','',false,array('id','languageid','sportid'),array('sps.sportid=sp.id','sps.languageid="'.$lang.'"'));
			$qb->order='sps.name';
			
			$query=$qb->getQuery();		
			$db->query($query);

			$sports=new baseClassList();
			if($includeUnknown)
			{
				$unknown=sport::getUnknown();
				$sports->Append($unknown);
			}
			while($row = $db->getRow())
			{
				$sport=new sport();
				$sport->getData($row);				
				$sports->Append($sport);
			}
			return $sports;			
		}

		//Section
		
		function getSectionById($id) {
			return $this->getGenericById($id,'section','se','team_section');
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('section','se','',false,false,array('se.id='.$id));
			$qb->addJoin('sectionStrings','ses','',false,array('id','languageid','sectionid'),array('ses.sectionid=se.id','ses.languageid="'.$lang.'"'));
			$qb->addJoin('sectionStrings','str','strings_',false,false,array('str.sectionid=se.id'));
			$qb->order='ses.name';
			
			$query=$qb->getQuery();		
			$db->query($query);

			while($row = $db->getRow())
			{
				if(is_null($section)) {
					$section=new team_section();
					$section->getData($row);
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$section->strings[$string->languageId]=$string;				
			}
			return $section;		
		}
		
		function getSectionList() {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('section','se','');
			$qb->addJoin('sectionStrings','ses','',false,array('id','languageid','sectionid'),array('ses.sectionid=se.id','ses.languageid="'.$lang.'"'));
			$qb->order='ses.name';
			
			$query=$qb->getQuery();		
			$db->query($query);

			$sections=new baseClassList();
			if($includeUnknown)
			{
				$unknown=section::getUnknown();
				$sections->Append($unknown);
			}
			while($row = $db->getRow())
			{
				$section=new team_section();
				$section->getData($row);				
				$sections->Append($section);
			}
			return $sections;			
		}
				
		//Match
		
		function getMatchList($year='%') {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('match','ma','');
			$qb->addJoin('matchStrings','mas','',false,array('id','languageid','matchid'),array('mas.matchid=ma.id','mas.languageid="'.$lang.'"'));
			$qb->order='ma.date';
			
			$query=$qb->getQuery();		
			$db->query($query);
						
			$matches=new baseClassList();
			while($row = $db->getRow())
			{
				$storedObj=&data_dataStore::getObjectWithId('match_match',$row->id);	
				if(is_null($storedObj)) {
					$object=new match_match();
					helper::debugPrint("Could not find match with id $row->id in dataStore. Fetch from DB.",'cache');
					$object->getData($row);
					data_dataStore::setObject($className,$object);
					$object->competitors=$this->getCompetitorsForMatchWithId($object->id);			
					$matches->Append($object);
				} else {
					$matches->Append($storedObj);
				}
			}
			return $matches;
		}
		
		function getMatchesForTeamWithId($teamid) {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('match','ma','',false,false,array("ma.id IN (SELECT matchid FROM competitor WHERE teamid=$teamid)"));
			$qb->addJoin('matchStrings','mas','',false,array('id','languageid','matchid'),array('mas.matchid=ma.id','mas.languageid="'.$lang.'"'));
			$qb->addJoin('matchStrings','str','strings_',false,false,array('str.matchid=ma.id'));
			$qb->order='ma.date';
			
			$query=$qb->getQuery();		
			$db->query($query);

			$matches=new BaseClassList();
			while($row = $db->getRow())
			{
				if(is_null($match)) {
					$match=new match_match();
					$match->getData($row);
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$match->strings[$string->languageId]=$string;	
				$match->competitors=$this->getCompetitorsForMatchWithId($id);	
				$matches->Append($match);
			}
			return $matches;			
		}
		
		function getMatchById($id) {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('match','ma','',false,false,array('ma.id='.$id));
			$qb->addJoin('matchStrings','mas','',false,array('id','languageid','matchid'),array('mas.matchid=ma.id','mas.languageid="'.$lang.'"'));
			$qb->addJoin('matchStrings','str','strings_',false,false,array('str.matchid=ma.id'));
			$qb->order='ma.date';
			
			$query=$qb->getQuery();		
			$db->query($query);

			while($row = $db->getRow())
			{
				if(is_null($match)) {
					$match=new match_match();
					$match->getData($row);
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$match->strings[$string->languageId]=$string;	
				$match->competitors=$this->getCompetitorsForMatchWithId($id);		
			}
			return $match;			
		}
		
		function getCompetitorsForMatchWithId($id) {
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			$qb->addSelect('competitor','co','',false,false,array('co.matchid='.$id));
			$qb->order='co.orderNumber';
			
			$query=$qb->getQuery();		
			$db->query($query);

			$comps=new baseClassList();
			while($row = $db->getRow()) {
				$comp=new match_competitor();
				$comp->getData($row);
				$comps->Append($comp);
			}
			while($comps->count()<2)
				$comps->Append(new match_competitor());
			return $comps;
		}
		
		function getCompetitorById($id) {
			$db=clone $this->db;
			
			if(is_null($id))
				return match_competitor::getUnknown();
			
			$qb=new data_queryBuilder($db);
			$qb->addSelect('competitor','co','',false,false,array('co.id='.$id));
			$qb->order='co.orderNumber';
			
			$query=$qb->getQuery();		
			$db->query($query);

			$comp=new match_competitor();
			if($row = $db->getRow()) {
				$comp->getData($row);
			}
			return $comp;			
		}
		
		function getGoalsForCompetitorWithId($id) {
			$db=clone $this->db;
						
			$qb=new data_queryBuilder($db);
			$qb->addSelect('goal','go','',false,false);
			$qb->addInnerJoin('matchEvent','me','',false,false,array("(me.competitorid=$id OR me.playerid IN (SELECT p.id FROM player p WHERE p.competitorid=$id))","go.matcheventid=me.id"));
			
			$query=$qb->getQuery();		
			$db->query($query);

			$goals=array();
			while($row = $db->getRow()) {
				$goal=new match_goal();
				$goal->getData($row);
				$goals[]=$goal;
			}
			return $goals;
		}

		function getWarningsForCompetitorWithId($id) {
			helper::debugPrint("Get warnings for competitor: $id","warnings");
			$db=clone $this->db;
						
			$qb=new data_queryBuilder($db);
			$qb->addSelect('warning','wa','',false,false);
			$qb->addInnerJoin('matchEvent','me','',false,false,array("(me.competitorid=$id OR me.playerid IN (SELECT p.id FROM player p WHERE p.competitorid=$id))","wa.matcheventid=me.id"));
			
			$query=$qb->getQuery();		
			helper::debugPrint("Query: $query","warnings");
			$db->query($query);
			helper::debugPrint("Rows: ".$db->getAffectedRows(),"warnings");
			$warnings=new BaseClassList();
			while($row = $db->getRow()) {
				helper::debugPrint("Warning: $row->id","warnings");
				$warning=new match_warning();
				$warning->getData($row);
				$warnings->Append($warning);
			}
			return $warnings;
		}

		
		function getPeriodsForMatchWithId($id) {
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			$qb->addSelect('period','pe','',false,false,array('pe.matchid='.$id));
			$qb->order='pe.id';

			$query=$qb->getQuery();		
			$db->query($query);

			$periods=new baseClassList();
			while($row = $db->getRow()) {
				$period=new match_period();
				$period->getData($row);
				$periods->Append($period);
			}			
			return $periods;
		}
		
		function getRefereesForMatchWithId($id) {
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			$qb->addSelect('referee','re','',false,false,array('re.matchid='.$id));
			$qb->addJoin('person','pe','',false,array('id'),array("pe.id=re.personid"));
			$qb->addJoin('personStrings','pes','',false,array('id','name'),array('pes.personId=re.personid'));
			$qb->order='re.id';

			$query=$qb->getQuery();		
			$db->query($query);

			$referees=array();
			while($row = $db->getRow()) {
				$referee=new person_referee();
				$referee->getData($row);
				$referees[$referee->id]=$referee;
			}			
			return $referees;
		}
		
		function getGoalsForMatchWithId($id) {
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			$qb->addSelect('matchEvent','me','',false,array('id'),array('me.matchid='.$id));
			$qb->addInnerJoin('goal','go','',false,false,array('me.matchid='.$id,'go.matchEventId=me.id'));
			$qb->order='go.id';

			$query=$qb->getQuery();		
			$db->query($query,true);

			$goals=array();
			while($row = $db->getRow()) {
				$goal=new match_goal();
				$goal->getData($row);
				$goals[]=$goal;
			}			
			return $goals;			
		}
		
		function getWarningsForMatchWithId($id) {
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			$qb->addSelect('matchEvent','me','',false,array('id'),array('me.matchid='.$id));
			$qb->addInnerJoin('goal','wa','',false,false,array('me.matchid='.$id,'wa.matchEventId=me.id'));
			$qb->order='wa.id';

			$query=$qb->getQuery();		
			$db->query($query,true);

			$warnings=new baseClassList();
			while($row = $db->getRow()) {
				helper::debugPrint("Warning: $row->id","warnings");
				$warning=new match_warning();
				$warning->getData($row);
				$warnings->Append($warning);
			}
			return $warnings;	
		}
		
		function getAssistsForGoal($id) {
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			$qb->addSelect('assist','as','',false,false,array('as.goalId='.$id));
			$qb->addInnerJoin('goal','go','',array('ownScore','opponentScore','orderNumber','matchEventId'),false,array('as.goalId=go.id'));
			$qb->addInnerJoin('matchEvent','me','',false,array('id','playerId','personId','teamId','competitorId'),array('go.matchEventId=me.id'));
			$qb->order='as.id';

			$query=$qb->getQuery();		
			$db->query($query,true);

			$assists=array();
			while($row = $db->getRow()) {
				$assist=new match_assist();
				$assist->getData($row);
				$assists[]=$assist;
			}			
			return $assists;				
		}
		
		//File
		
		function getFileById($id,$class='file') {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;

			$qb=new data_queryBuilder($db);

			$qb->addSelect('file','','',false,false,array('id='.$id));
			
			$query=$qb->getQuery();
			$db->query($query);
			
			if($row=$db->getRow())
			{
				$file=new $class();
				$file->getData($row);
			}			
			return $file;
		}
		
		//Images
		
		/*
		function getImageList($table=false,$id=false) {
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$where=array("f.fileType='picture'");
			if($table)
				$where[]="fc.tableName='$table'";
			if($id) 
				$where[]="tableRowId=$id";
			$qb->addSelect('fileConnector','fc','',false,false,$where);
			$qb->addJoin('file','f','',array('fileType'),false,array("f.id=fc.fileId"));
			$qb->order="fc.isPrimary,fc.id";
			$query=$qb->getQuery();		
			$db->query($query);
			
			$images=array();
				
			while($row = $db->getRow())
			{
				$images[]=$row;
			}
			return $images;				
		}
		*/
		function getImageList($table=false,$id=false) {
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$where=array("f.id=fc.fileId");
			if($table)
				$where[]="fc.tableName='$table'";
			if($id) 
				$where[]="tableRowId=$id";
			$qb->addSelect('file','f','',array('id','filetype'),false,array("f.fileType='picture'"));
			if($table)
				$qb->addInnerJoin('fileConnector','fc','',false,false,$where);
			if($table)
				$qb->order="fc.isPrimary,fc.id";
			$query=$qb->getQuery();		
			$db->query($query);
			
			$images=array();
				
			while($row = $db->getRow())
			{
				$images[]=$row;
			}
			return $images;				
		}		
		//Arena

		function getArenaById($id) {
			return $this->getGenericById($id,'arena','ar','arena');
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('arena','ar','',false,false,array('ar.id='.$id));
			$qb->addJoin('arenaStrings','ars','',false,array('id','languageid','arenaid'),array('ars.arenaid=ar.id','ars.languageid="'.$lang.'"'));
			$qb->addJoin('arenaStrings','str','strings_',false,false,array('str.arenaid=ar.id'));
			//$qb=$this->joinLocation($qb,'ar');
			$qb->order='IFNULL(ars.name,ar.nativeName)';
			
			$query=$qb->getQuery();		
			$db->query($query);

			while($row = $db->getRow())
			{
				if(is_null($arena)) {
					$arena=new arena();
					$arena->getData($row);
						
					//$this->parseLocation($arena,$row,'');
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$arena->strings[$string->languageId]=$string;				
			}
			return $arena;
		}	
		
		function getArenaKeyValueList($includeUnknown=false) {
			return $this->getGenericKeyValueList('arena','ar','arena',$includeUnknown,false);
		}
				
		function getArenaList($includeUnknown=false) {
			//return $this->getGenericList('arena','ar','arena',true,true);
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('arena','ar','');
			$qb->addJoin('arenaStrings','ars','',false,array('id','languageid','arenaid'),array('ars.arenaid=ar.id','ars.languageid="'.$lang.'"'));
			//$qb=$this->joinLocation($qb,'ar');
			$qb->order='IFNULL(ars.name,ar.nativeName)';
			
			$query=$qb->getQuery();		
			$db->query($query);

			$arenas=new baseClassList();
			if($includeUnknown)
			{
				$unknown=arena::getUnknown();
				$arenas->Append($unknown);
			}
			while($row = $db->getRow())
			{
				$arena=new arena();
				$arena->getData($row);
				
				//$this->parseLocation($arena,$row,'');
				
				$arenas->Append($arena);
			}
			return $arenas;
		}	

		
		//Weather
		
		function getWeatherById($id) {
			if(is_null($id))
				return new weather_weather();
			else
				return $this->getGenericById($id,'weather','we','weather_weather');
		}
		
		//Location
		
		protected function parseLocation($location,$row,$prefix='') {
			$location->getData($row,$prefix);
			
			$location->city=new location_city();
			$this->parseCity($location->city,$row,$prefix.'city_');

			$location->state=new location_state();
			$this->parseState($location->state,$row,'state_');

			$location->country=new location_country();
			$this->parseCountry($location->country,$row,'country_');

			$location->continent=new location_continent();
			$this->parseContinent($location->continent,$row,'continent_');
		}
		/*
		protected function joinLocation($qb,$key) {			
			$qb->addJoin('location','loc','location_',false,false,array('loc.id='.$key));
			$qb=$this->joinCity($qb,'loc.cityid');
			$qb=$this->joinState($qb,'loc.stateid');
			$qb=$this->joinCountry($qb,'loc.countryid');
			$qb=$this->joinContinent($qb,'loc.continentid');
			return $qb;
		}
		*/
		
		protected function joinLocation($qb,$table,$prefix='') {			
			$qb=$this->joinCity($qb,$table.'.cityid',$prefix);
			$qb=$this->joinState($qb,$table.'.stateid',$prefix);
			$qb=$this->joinCountry($qb,$table.'.countryid',$prefix);
			$qb=$this->joinContinent($qb,$table.'.continentid',$prefix);
			return $qb;
		}	
			
		function getLocationById($id) {
			$lang=$this->lang->getLanguage();
			$qb=new data_queryBuilder($this->db);
			
			$qb->addSelect('location','loc','',false,false,array('loc.id='.$id));
			$qb=$this->joinCity($qb,'loc.cityid');
			$qb=$this->joinState($qb,'loc.cityid');
			$qb=$this->joinCountry($qb,'loc.cityid');
			$qb=$this->joinContinent($qb,'loc.cityid');

			$query=$qb->getQuery();
			$db->query($query);
			while($row = $db->getRow())
			{
				if(is_null($loc))
				{
					$loc=new location_location();
					$loc->getData($row);

					$loc->city=new location_state();
					$loc->city->getData($row,'city_');
					$loc->state=new location_state();
					$loc->state->getData($row,'state_');
					$loc->country=new location_country();
					$loc->country->getData($row,'country_');
					$loc->continent=new location_continent();
					$loc->continent->getData($row,'continent_');

					$loc->city->state=new location_country();
					$loc->city->state($row,'city_state_');
					$loc->city->country=new location_country();
					$loc->city->country->getData($row,'city_country_');
					$loc->city->continent=new location_continent();
					$loc->city->continent->getData($row,'city_continent_');
					
					$loc->state->country=new location_country();
					$loc->state->country->getData($row,'state_country_');
					$loc->state->continent=new location_continent();
					$loc->state->continent->getData($row,'state_continent_');

					$loc->country->continent=new location_continent();
					$loc->country->continent->getData($row,'country_continent_');
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$city->strings[$string->languageId]=$string;				
			}
			return $city;		
		}
		
		//City
		
		protected function parseCity($city,$row,$prefix='') {
			$city->getData($row,$prefix);

			$city->state=new location_state();
			$city->state->getData($row,$prefix.'state_');
			$city->country=new location_country();
			$city->country->getData($row,$prefix.'country_');
			$city->continent=new location_continent();
			$city->continent->getData($row,$prefix.'continent_');

			$city->state->country=new location_country();
			$city->state->country->getData($row,$prefix.'state_country_');
			$city->state->continent=new location_continent();
			$city->state->continent->getData($row,$prefix.'state_continent_');

			$city->country->continent=new location_continent();
			$city->country->continent->getData($row,$prefix.'country_continent_');		
		}
		
		protected function joinCity(data_queryBuilder $qb,$key,$prefix='',$abbrevation='ci') {
			$lang=$this->lang->getLanguage();
			$qb->addJoin('city',$abbrevation,$prefix.'city_',false,false,array($abbrevation.'.id='.$key));
			$qb->addJoin('cityStrings',$abbrevation.'s',$prefix.'city_',false,false,array($abbrevation."s.cityid=$abbrevation.id",$abbrevation.'s.languageId="'.$lang.'"'));
			
			$qb->addJoin('state',$abbrevation.'st',$prefix.'city_state_',false,false,array($abbrevation."st.id=$abbrevation.stateid"));
			$qb->addJoin('stateStrings',$abbrevation.'sts',$prefix.'city_state_',array('name'),false,array($abbrevation.'sts.stateId='.$abbrevation.'.stateId',$abbrevation.'sts.languageId="'.$lang.'"'));
			$qb->addJoin('country',$abbrevation.'co',$prefix.'city_country_',false,false,array($abbrevation.'co.id='.$abbrevation.'.countryid'));
			$qb->addJoin('countryStrings',$abbrevation.'cos',$prefix.'city_country_',false,array('id','languageId'),array($abbrevation.'cos.countryId='.$abbrevation.'.countryId',$abbrevation.'cos.languageId="'.$lang.'"'));
			$qb->addJoin('continent',$abbrevation.'cn',$prefix.'city_continent_',false,false,array($abbrevation.'cn.id='.$abbrevation.'.continentId'));
			$qb->addJoin('continentStrings',$abbrevation.'cns',$prefix.'city_continent_',false,false,array($abbrevation.'cns.continentId='.$abbrevation.'.continentId',$abbrevation.'cns.languageId="'.$lang.'"'));

			$qb->addJoin('country',$abbrevation.'stco',$prefix.'city_state_country_',false,false,array($abbrevation.'stco.id='.$abbrevation.'st.countryid'));
			$qb->addJoin('countryStrings',$abbrevation.'stcos',$prefix.'city_state_country_',false,array('id','languageId'),array($abbrevation.'stcos.countryId='.$abbrevation.'st.countryId',$abbrevation.'stcos.languageId="'.$lang.'"'));
			$qb->addJoin('continent',$abbrevation.'stcn',$prefix.'city_state_continent_',false,false,array($abbrevation.'stcn.id='.$abbrevation.'st.continentId'));
			$qb->addJoin('continentStrings',$abbrevation.'stcns',$prefix.'city_state_continent_',false,false,array($abbrevation.'stcns.continentId='.$abbrevation.'st.continentId',$abbrevation.'stcns.languageId="'.$lang.'"'));

			$qb->addJoin('continent',$abbrevation.'cocn',$prefix.'city_country_continent_',false,false,array($abbrevation.'cocn.id='.$abbrevation.'co.continentId'));
			$qb->addJoin('continentStrings',$abbrevation.'cocns',$prefix.'city_country_continent_',false,false,array($abbrevation.'cocns.continentId='.$abbrevation.'co.continentId',$abbrevation.'cocns.languageId="'.$lang.'"'));
			return $qb;
		}
		
		function getCityList($includeUnknown=false,$countryId=false,$stateId=false) {
			$list=$this->getGenericList('city','ci','location_city',$includeUnknown,false);
			if(!($countryId || $stateId))
				return $list;
			$cities=new baseClassList();
			foreach($list as $city) {
				if((!$countryId || $countryId==$city->getCountry()->id) && (!$stateId || $stateId==$city->getState()->id))
					$cities->Append($city);
			}
			return $cities;
		}
		
		function getCityById($id,$canBeIncomplete=false) {
			helper::debugPrint("Get city $id",'init');
			helper::debugPrint('Get City: '.$id,'store');
			$city=data_dataStore::getObjectWithId('location_city',$id);
			helper::debugPrint('City is in dataStore: '.(is_null($city)?'No':'Yes'),'store');
			helper::debugPrint('City is cached: '.($city->cached?'Yes':'No'),'store');
			if($city!=NULL && ($canBeIncomplete || $city->cached)) {
				helper::debugPrint('Get from dataStore','store');
				return $city;
			}
			if(is_null($id)) {
				$city=location_city::getUnknown();
				$city->cached=true;
				data_dataStore::setObject('location_city',$city);
				return $city;
			}
			if($id==0) {
				$city=location_city::getNone();
				$city->cached=true;
				data_dataStore::setObject('location_city',$city);
				helper::debugPrint("City ID is 0 - Return a object None.","datareader");
				return $city;
			}
						
			helper::debugPrint('Get from Db','store');
			
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('city','ci','',false,false,array('ci.id='.$id));
			$qb->addJoin('cityStrings','cis','',array('name'),false,array('cis.cityId=ci.id','cis.languageId="'.$lang.'"'));
			$qb->addJoin('cityStrings','str','strings_',array('languageId','name'),false,array('str.cityId=ci.id'));
			/*
			$qb->addJoin('continent','cn','continent_',array('id'),false,array('cn.id=co.continentid'));
			$qb->addJoin('continentStrings','cns','continent_',array('name'),false,array('cns.continentId=co.continentId','cns.languageId="'.$lang.'"'));
			$qb->addJoin('city','ci','capitalCity_',false,false,array('co.capitalCityId=ci.id'));
			$qb->addJoin('cityStrings','cis','capitalCity_',false,array('id','languageId'),array('ci.id=cis.cityid','cis.languageId="'.$lang.'"'));
			*/
			$qb->order='cis.name';
			
			$query=$qb->getQuery();
			
			$db->query($query);
			while($row = $db->getRow())
			{
				if(is_null($city)) 
				{
					$city=new location_city();
					$city->getData($row);
					/*
					$city->continent=new location_continent();
					$city->continent->getData($row,'continent_');
					$city->capitalCity=new location_city();
					$city->capitalCity->getData($row,'capitalCity_');
					*/
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$city->strings[$string->languageId]=$string;								
			}
			$city->cached=true;
			data_dataStore::setObject('location_city',$city);
			return $city;	
		}

		//State
		
		protected function parseState($state,$row,$prefix='') {
			$state->getData($row,$prefix);
			
			$state->country=new location_country();
			$state->country->getData($row,$prefix.'country_');
			$state->continent=new location_continent();
			$state->continent->getData($row,$prefix.'continent_');
			
			$state->country->continent=new location_continent();
			$state->country->continent->getData($row,$prefix.'country_continent_');
			
			$state->capitalCity=new location_city();
			$state->capitalCity->getData($row,$prefix.'capitalCity_');		
		}

		protected function joinState(data_queryBuilder $qb,$key,$prefix='',$abbrevation='st') {
			$lang=$this->lang->getLanguage();
			$qb->addJoin($abbrevation.'ate',$abbrevation,$prefix.'state_',false,false,array($abbrevation.'.id='.$key));
			$qb->addJoin($abbrevation.'ateStrings',$abbrevation.'s',$prefix.'state_',array('name'),false,array($abbrevation.'s.stateId='.$abbrevation.'.id',$abbrevation.'s.languageId="'.$lang.'"'));

			$qb->addJoin('country',$abbrevation.'co',$prefix.'state_country_',false,false,array($abbrevation.'co.id='.$abbrevation.'.countryid'));
			$qb->addJoin('countryStrings',$abbrevation.'cos',$prefix.'state_country_',false,array('id','languageId'),array($abbrevation.'cos.countryId='.$abbrevation.'.countryId',$abbrevation.'cos.languageId="'.$lang.'"'));

			$qb->addJoin('continent',$abbrevation.'cn',$prefix.'state_continent_',false,false,array($abbrevation.'cn.id='.$abbrevation.'.continentId'));
			$qb->addJoin('continentStrings',$abbrevation.'cns',$prefix.'state_continent_',false,false,array($abbrevation.'cns.continentId='.$abbrevation.'.continentId',$abbrevation.'cns.languageId="'.$lang.'"'));
			$qb->addJoin('continent',$abbrevation.'cocn',$prefix.'state_country_continent_',false,false,array($abbrevation.'cocn.id='.$abbrevation.'co.continentId'));
			$qb->addJoin('continentStrings',$abbrevation.'cocns',$prefix.'state_country_continent_',false,false,array($abbrevation.'cocns.continentId='.$abbrevation.'co.continentId',$abbrevation.'cocns.languageId="'.$lang.'"'));
			$qb->addJoin('city','stci','capitalCity_',false,false,array($abbrevation.'.capitalCityId='.$abbrevation.'ci.id'));
			$qb->addJoin('cityStrings','stcis','capitalCity_',false,array('id','languageId'),array($abbrevation.'ci.id='.$abbrevation.'cis.cityid',$abbrevation.'cis.languageId="'.$lang.'"'));
			return $qb;				
		}

		function getStateList($includeUnknown=false) {
			return $this->getGenericList('state','st','location_state',$includeUnknown);
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('state','st','');
			$qb->addJoin('stateStrings','sts','',false,array('id','languageId'),array('sts.stateId=st.id','sts.languageId="'.$lang.'"'));
			$qb->addJoin('country','co','country_',false,false,array('co.id=st.countryid'));
			$qb->addJoin('countryStrings','cos','country_',false,array('id','languageId'),array('cos.countryId=st.countryId','cos.languageId="'.$lang.'"'));
			$qb->addJoin('continent','cn','continent_',array('id'),false,array('cn.id=st.continentid'));
			$qb->addJoin('continentStrings','cns','continent_',false,array('id','languageId'),array('cns.continentId=st.continentId','cns.languageId="'.$lang.'"'));
			$qb->addJoin('continent','cocn','country_continent_',array('id'),false,array('cocn.id=co.continentid'));
			$qb->addJoin('continentStrings','cocns','country_continent_',false,array('id','languageId'),array('cocns.continentId=co.continentId','cocns.languageId="'.$lang.'"'));
			$qb->addJoin('city','ci','capitalCity_',false,false,array('st.capitalCityId=ci.id'));
			$qb->addJoin('cityStrings','cis','capitalCity_',false,array('id','languageId'),array('ci.id=cis.cityid','cis.languageId="'.$lang.'"'));
			$qb->order='ifnull(sts.name,st.nativeName)';
			
			$query=$qb->getQuery();
			
			$db->query($query);
			$states=new baseClassList();
			if($includeUnknown)
			{
				$unknown=location_state::getUnknown();
				$states->Append($unknown);
			}
			while($row = $db->getRow())
			{
				$state=new location_state();
				$state->getData($row);
				/*
				$state->country=new location_country();
				$state->country->getData($row,'country_');
				$state->continent=new location_continent();
				$state->continent->getData($row,'continent_');
				$state->country->continent=new location_continent();
				$state->country->continent->getData($row,'country_continent_');
				$state->capitalCity=new location_city();
				$state->capitalCity->getData($row,'capitalCity_');
				*/
				$states->Append($state);
			}
			return $states;
		}

		function getStateById($id,$canBeIncomplete=false) {
			helper::debugPrint("Get state $id",'init');
			$state=data_dataStore::getObjectWithId('location_state',$id);
			if($state!=NULL && ($canBeIncomplete || $state->cached))
				return $state;
			
			if(is_null($id)) {
				$state=location_state::getUnknown();
				data_dataStore::setObject('location_state',$state);
				return $state;
			}
			if($id==0) {
				$state=location_state::getUnknown();
				data_dataStore::setObject('location_state',$state);
				return $state;
			}
									
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('state','st','',false,false,array('st.id='.$id));
			$qb->addJoin('stateStrings','sts','',false,array('id','languageId'),array('sts.stateId=st.id','sts.languageId="'.$lang.'"'));
			/*
			$qb->addJoin('country','co','country_',false,false,array('co.id=st.countryid'));
			$qb->addJoin('countryStrings','cos','country_',false,array('id','languageId'),array('cos.countryId=st.countryId','cos.languageId="'.$lang.'"'));
			$qb->addJoin('continent','cn','continent_',array('id'),false,array('cn.id=st.continentid'));
			$qb->addJoin('continentStrings','cns','continent_',false,array('id','languageId'),array('cns.continentId=st.continentId','cns.languageId="'.$lang.'"'));
			$qb->addJoin('continent','cocn','country_continent_',array('id'),false,array('cocn.id=co.continentid'));
			$qb->addJoin('continentStrings','cocns','country_continent_',false,array('id','languageId'),array('cocns.continentId=co.continentId','cocns.languageId="'.$lang.'"'));
			$qb->addJoin('city','ci','capitalCity_',false,false,array('st.capitalCityId=ci.id'));
			$qb->addJoin('cityStrings','cis','capitalCity_',false,array('id','languageId'),array('ci.id=cis.cityid','cis.languageId="'.$lang.'"'));
			*/
			$qb->addJoin('stateStrings','str','strings_',false,array('id'),array('str.stateId=st.id'));
			$qb->order='sts.name';
			
			$query=$qb->getQuery();
			
			$db->query($query);
			while($row = $db->getRow())
			{
				if(is_null($state))
				{
					helper::debugPrint('Create state from db','location');
					$state=new location_state();
					$state->getData($row);
					/*
					helper::debugPrint('Create state->country from db','location');
					$state->country=new location_country();
					$state->country->getData($row,'country_');
					helper::debugPrint('Create state->continent from db','location');
					$state->continent=new location_continent();
					$state->continent->getData($row,'continent_');
					helper::debugPrint('Create state->country->continent from db','location');
					$state->country->continent=new location_continent();
					$state->country->continent->getData($row,'country_continent_');
					$state->capitalCity=new location_city();
					$state->capitalCity->getData($row,'capitalCity_');
					*/
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$state->strings[$string->languageId]=$string;								
			}
			$state->cached=true;
			data_dataStore::setObject('location_state',$state);
			return $state;		
		}		
		
		//Country
		
		protected function parseCountry($country,$row,$prefix='') {
			$country->getData($row,$prefix);
			$country->continent=new location_continent();
			$country->continent->getData($row,$prefix.'continent_');
			$country->capitalCity=new location_city();
			$country->capitalCity->getData($row,$prefix.'capitalCity_');	
		}

		protected function joinCountry($qb,$key) {
			$lang=$this->lang->getLanguage();
			$qb->addJoin('country','co','country_',false,false,array('co.id='.$key));
			$qb->addJoin('countryStrings','cos','country_',false,array('id','languageId'),array('cos.countryId=co.id','cos.languageId="'.$lang.'"'));
			$qb->addJoin('continent','cocn','country_continent_',false,false,array('cocn.id=co.continentid'));
			$qb->addJoin('continentStrings','cocns','country_continent_',false,array('id','languageId'),array('cocns.continentId=co.continentId','cocns.languageId="'.$lang.'"'));	

			$qb->addJoin('city','coci','country_capitalCity_',false,false,array('co.capitalCityId=coci.id'));
			$qb->addJoin('cityStrings','cocis','country_capitalCity_',false,array('id','languageId'),array('coci.id=cocis.cityid','cocis.languageId="'.$lang.'"'));
			return $qb;						
		}
		function &getCountryList($includeUnknown=false) {
			$list=$this->getGenericList('country','co','location_country',$includeUnknown);
			return $list;
			$list=data_dataStore::getObjectList('location_country');
			if($list!=NULL && data_dataStore::getObjectListIsComplete('location_country')) {
				helper::debugPrint('Get countries from dataStore:'.$list->getJSON(),'store');
				$countries=new baseClassList();
				foreach($list as $country) {
					$skip=false;
					if(!$includeUnknown && is_null($country->id))
						$skip=true;
					if(!$skip)
						$countries->Append($country);
				}
			} else {	
				helper::debugPrint('Get countries from DB','store');
				$lang=$this->lang->getLanguage();
				$db=clone $this->db;
				
				$qb=new data_queryBuilder($db);
				
				$qb->addSelect('country','co','');
				$qb->addJoin('countryStrings','cos','',array('name'),false,array('cos.countryId=co.id','cos.languageId="'.$lang.'"'));
				/*
				$qb->addJoin('continent','cn','continent_',array('id'),false,array('cn.id=co.continentid'));
				$qb->addJoin('continentStrings','cns','continent_',array('name'),false,array('cns.continentId=co.continentId','cns.languageId="'.$lang.'"'));
				$qb->addJoin('city','ci','capitalCity_',false,false,array('co.capitalCityId=ci.id'));
				$qb->addJoin('cityStrings','cis','capitalCity_',false,array('id','languageId'),array('ci.id=cis.cityid','cis.languageId="'.$lang.'"'));
				*/
				$qb->order='cos.name';
				
				$query=$qb->getQuery();
				
				$db->query($query);
				$countries=new baseClassList();
				$list=new baseClassList();
				$unknown=location_country::getUnknown();
				$list[NULL]=$unknown;
				if($includeUnknown)
					$countries->Append($unknown);
				while($row = $db->getRow())
				{
					$country=new location_country();
					$country->getData($row);
					/*
					$country->continent=new location_continent();
					$country->continent->getData($row,'continent_');
					$country->capitalCity=new location_city();
					$country->capitalCity->getData($row,'capitalCity_');
					*/
					$countries->Append($country);
					$list->Append($country);
				}
				data_dataStore::setObjectList('location_country',$list);
			}
			data_dataStore::setObjectListIsComplete('location_country');
			return $countries;
		}

		function getCountryById($id,$canBeIncomplete=false) {
			helper::debugPrint("Get country $id",'init');
			helper::debugPrint('Get Country: '.$id,'store');
			$country=data_dataStore::getObjectWithId('location_country',$id);
			helper::debugPrint('Country is in dataStore: '.(is_null($country)?'No':'Yes'),'store');
			helper::debugPrint('Country is cached: '.($country->cached?'Yes':'No'),'store');
			if($country!=NULL && ($canBeIncomplete || $country->cached)) {
				helper::debugPrint('Get from dataStore','store');
				return $country;
			}
			if(is_null($id)) {
				$country=location_country::getUnknown();
				data_dataStore::setObject('location_country',$country);
				return $country;
			}
			if($id==0) {
				$country=location_country::getUnknown();
				data_dataStore::setObject('location_country',$country);
				return $country;
			}
			
			helper::debugPrint('Get from Db','store');
			
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('country','co','',false,false,array('co.id='.$id));
			$qb->addJoin('countryStrings','cos','',array('name'),false,array('cos.countryId=co.id','cos.languageId="'.$lang.'"'));
			$qb->addJoin('countryStrings','str','strings_',array('languageId','name'),false,array('str.countryId=co.id'));
			/*
			$qb->addJoin('continent','cn','continent_',array('id'),false,array('cn.id=co.continentid'));
			$qb->addJoin('continentStrings','cns','continent_',array('name'),false,array('cns.continentId=co.continentId','cns.languageId="'.$lang.'"'));
			$qb->addJoin('city','ci','capitalCity_',false,false,array('co.capitalCityId=ci.id'));
			$qb->addJoin('cityStrings','cis','capitalCity_',false,array('id','languageId'),array('ci.id=cis.cityid','cis.languageId="'.$lang.'"'));
			*/
			$qb->order='cos.name';
			
			$query=$qb->getQuery();
			
			$db->query($query);
			$country=location_country::getUnknown();
			while($row = $db->getRow())
			{
				helper::debugPrint('Found in Db','store');
				if(is_null($country)) 
				{
					helper::debugPrint('Create new and get data','store');
					$country=new location_country();
					$country->getData($row);
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$country->strings[$string->languageId]=$string;								
				helper::debugPrint("Country: ".$country->getJSON(),'store');
			}
			$country->cached=true;
			data_dataStore::setObject('location_country',$country);
			return $country;		
		}
		
		//Continent
		
		protected function parseContinent($continent,$row,$prefix) {
			$continent->getData($row,$prefix);
		}
		
		protected function joinContinent($qb,$key) {
			$lang=$this->lang->getLanguage();
			$qb->addJoin('continent','cn','continent_',false,false,array('cn.id='.$key));
			$qb->addJoin('continentStrings','cns','continent_',false,array('id','languageId'),array('cns.continentId=cn.id','cns.languageId="'.$lang.'"'));
			return $qb;			
		}
		
		function getContinentList($includeUnknown=false,$includeNone=false) {
			return $this->getGenericList('continent','cn','location_continent',$includeUnknown);
			$list=data_dataStore::getObjectList('location_continent');
			if($list!=NULL) {
				$continents=new baseClassList();
				foreach($list as $continent) {
					$skip=false;
					if(!$includeUnknown && is_null($continent->id))
						$skip=true;
					if(!$skip)
						$continents->Append($continent);
				}
			} else {	
				$lang=$this->lang->getLanguage();
				$db=clone $this->db;
				
				$qb=new data_queryBuilder($db);
				
				$qb->addSelect('continent','co','');
				$qb->addJoin('continentStrings','cos','',false,array('id','languageId'),array('cos.continentId=co.id','cos.languageId="'.$lang.'"'));
				$qb->order='cos.name';
				
				$query=$qb->getQuery();
				
				$db->query($query);
				$continents=new baseClassList();
				$list=new baseClassList();
				$unknown=location_continent::getUnknown();
				$list[NULL]=$unknown;
				if($includeUnknown)
					$continents->Append($unknown);
				while($row = $db->getRow())
				{
					$continent=new location_continent();
					$continent->getData($row);
					$continents->Append($continent);
					$list->Append($continent);
				}
				data_dataStore::setObjectList('location_continent',$list);
			}
			return $continents;
		}
		
		function getContinentById($id,$canBeIncomplete=false) {
			$continent=data_dataStore::getObjectWithId('location_continent',$id);
			if($continent!=NULL && ($canBeIncomplete || $continent->cached))
				return $continent;
			
			if(is_null($id)) {
				$continent=location_continent::getUnknown();
				data_dataStore::setObject('location_continent',$continent);
				return $continent;
			}
			if($id==0) {
				$continent=location_continent::getUnknown();
				data_dataStore::setObject('location_continent',$continent);
				return $continent;
			}
			helper::debugPrint("Get continent $id from db",'init');
			
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('continent','co','',false,false,array('co.id='.$id));;
			$qb->addJoin('continentStrings','cos','',false,array('id','languageId'),array('cos.continentId=co.id','cos.languageId="'.$lang.'"'));
			$qb->addJoin('continentStrings','str','strings_',false,array('id'),array('str.continentId=co.id'));
			$qb->order='cos.name';
			
			$query=$qb->getQuery();
			
			$db->query($query);
			while($row = $db->getRow())
			{
				if(is_null($continent)) 
				{
					$continent=new location_continent();
					$continent->getData($row);
				}
				$string=new strings();
				$string->getData($row,'strings_');
				$continent->strings[$string->languageId]=$string;								
			}
			$continent->cached=true;
			data_dataStore::setObject('location_continent',$continent);
			return $continent;		
		}
		
		function getUserKeyValueList() {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('users','us','',false,false);
			$query=$qb->getQuery();		
			$db->query($query);
			
			$objects=new baseClassList();
				
			while($row = $db->getRow())
			{
				$object=new user_user();
				$object->getData($row);
				$kv=new keyValue($object);
				$objects->Append($kv);
			}
			return $objects;				
		}
		
		function getUserById($id) {
			$object=new user_user();
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			if(is_null($id)) {
				return NULL;
			}
			if($id==0) {
				return NULL;
			}
						
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('users','us','',false,false,array('us.id='.$id));
			/*if(is_a($object,'locatable_inLocation'))
				$this->joinLocation($qb,$abbrevation);
			*/
			$qb->order='us.lastname';
			
			$query=$qb->getQuery();		
			$db->query($query);

			while($row = $db->getRow())
			{
				$object->getData($row);
				$object->privileges=$this->getUserPrivileges($id);
			}
			return $object;			
		}
		
		function getUserPrivileges($userid) {
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('user_access_rights','usa','',false,false,array('userid='.$userid));
			$query=$qb->getQuery();		
			$db->query($query);
			
			$objects=new baseClassList();
				
			while($row = $db->getRow())
			{
				$object=new user_userPrivilege();
				$object->getData($row);
				$objects->Append($object);
			}
			return $objects;				
		}
		
		private static $chains = array(
			"goal" => array(
				"competitor" => array("competitor", "player", "matchevent", "goal")
			)
		);
		
				
		//Organization
/*
		function getOrganizationById($id) {
			$org=new organization();
			$lang=$this->lang->getLanguage();
			$db=clone $this->db;
			$qb=new data_queryBuilder($db);
			
			$qb->addSelect('organization','o','',false,false,array('o.id=' . $id));
			$qb->addSelect('location','loc','',false,$qb->getColumns('location'),array('o.locationId=loc.id'));
			$qb->addJoin('city','ci','city_',array('numCode','url','nativeName'),false,array('ci.id=loc.cityid'));
			$qb->addJoin('cityStrings','cis','city_',array('name'),false,array('cis.cityid=loc.cityId','cis.languageId="'.$lang.'"'));
			$qb->addJoin('country','co','country_',array('numCode','iso2','iso3','nativeName'),false,array('co.id=loc.countryid'));
			$qb->addJoin('countryStrings','cos','country_',array('name'),false,array('cos.countryId=loc.countryId','cos.languageId="'.$lang.'"'));
			
			$query=$qb->getQuery();
			$db->query($query);
			if($row = $db->getRow())
			{
				$org->getData($row);
				$org->location=new location();
				$org->location->city->getData($row,'city_');
				$org->location->city->state->getData($row,'state_');
				$org->location->city->state->country->getData($row,'country_');				
				$org->location->city->state->country->continent->getData($row,'continent_');				
				return $org;
			} else {
				return false;
			}	
		}
*/
	}

?>