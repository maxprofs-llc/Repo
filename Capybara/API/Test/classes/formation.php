<?php
	class formation extends baseClass {
		
		private $roles;
		private $formationString;
		
		function __construct($formation='') {
			$this->roles=new baseClassList();	
			$this->parseFormationString($formation);	
		}
		
		public function getDefaultRoles() {
			return $this->roles;
		}
		
		function parseFormationString($formation) {
			$conf=config_conf::getSingleton();
			$this->formationString=$formation;
			
			//If no formation was found, count the players and add as many player roles + a goalie
			
			//Add the goalie
			$this->roles->Append(data_dataStore::getProperty('dataReader')->getRoleById($conf->get('goalie_role_id')));
			
			$list=explode('-',$formation);
			$tot=0;
			foreach($list as $pos)
				$tot+=$pos;
			for($i=1;$i<=$tot;$i++)
				$this->roles->Append(data_dataStore::getProperty('dataReader')->getRoleById($conf->get('player_role_id',1)));
		}
		
		function parseSquad($squad) {
			
		}
		
		function getName() {
			return $this->formationString;
		}
	}