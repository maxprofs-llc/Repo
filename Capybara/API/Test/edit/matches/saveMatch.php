<?php
	include "../_define.php";

	if(!$sess->checkUrl(false,$_SESSION['basedir'].'/matches.php',false)) {
		$obj->status='Error';
		$obj->statusMsg=$lang->get('You do not have sufficient privileges to write to database').".";
		die(json_encode($obj));
	}	
	
	$dw=new data_dataWriter();
	
	$weatherid=$dw->writeGeneric($_POST['weather'],'weather');
	$_POST['match']['weatherId']=$weatherid;
	$matchId=$dw->writeGeneric($_POST['match'],'match');	
	if($matchId==-1) {
		$obj->status='error';
		$obj->statusMsg=$lang->get('Not_logged_in');
		die(json_encode($obj));
	}
	$personPlayer=array();
	$playerids=array();
	foreach($_POST['competitors'] as $comp) {
		$comp['matchId']=$matchId;
		$comp['id']=$dw->writeGeneric($comp,'competitor',array('matchEvents','players'));
		if(isset($comp['players'])) {
			foreach($comp['players'] as $player) {
				$player['competitorId']=$comp['id'];
				$player['matchId']=$matchId;
				$playerId=$dw->writeGeneric($player,'player');
				$personPlayer['id'.$player['personId']]=$playerId;
				$playerids[]=$playerId;
			}
		}
		if(isset($comp['matchEvents'])) {
			foreach($comp['matchEvents'] as $matchEvent) {
				$matchEvent['matchId']=$matchId;
				$matchEvent['competitorId']=$comp['id'];
				$matchEvent['playerId']=$personPlayer['id'.$matchEvent['personId']];					
				$matchEvent['id']=$dw->writeGeneric($matchEvent,'matchEvent',array('goal'));
				if(isset($matchEvent['goal'])) {	
					$goal=$matchEvent['goal'];
					$goal['matchEventId']=$matchEvent['id'];
					$goal['id']=$dw->writeGeneric($goal,'goal',array('assist'));
					if(isset($goal['assist'])) {
						$assist=$goal['assist'];
						$assist['goalId']=$goal['id'];
						$assist['playerId']=$personPlayer['id'.$assist['personId']];					
						$assist['id']=$dw->writeGeneric($assist,'assist');
					}
				}
			}
		}
	}
	$dw->deleteGenericNotInList($playerids,'player',array("matchid=$matchId"));
	
	$lastPeriod=NULL;
	if(isset($_POST['periods'])) {
		$ids=array();
		foreach($_POST['periods'] as $period) {
			helper::debugPrint('Save period','save');
			$period['matchId']=$matchId;
			if(!is_null($lastPeriod)) 
				$period['previousPeriodId']=$lastPeriod['id'];
			$periodid=$dw->writeGeneric($period,'period');
			helper::debugPrint('Period saved!','save');
			$period['id']=$periodid;
			$ids[]=$periodid;
			/*		
			if(!is_null($lastPeriod)) {
				$lastPeriod['nextPeriodId']=$periodid;
				$dw->writeGeneric($lastPeriod,'period');
			}
			*/
			$lastPeriod=$period;
		}
		$dw->deleteGenericNotInList($ids,'period',array("matchid=$matchId"));
	}
	if(isset($_POST['referees'])) {
		$ids=array();
		foreach($_POST['referees'] as $referee) {
			$referee['matchId']=$matchId;
			$refereeid=$dw->writeGeneric($referee,'referee');
			$ids[]=$refereeid;
		}	
		$dw->deleteGenericNotInList($ids,'referee',array("matchid=$matchId"));
	}	
	
	helper::debugPrint("All is saved","save");
	
	$dr=new data_dataReader($db,$lang);	

	/*
	foreach($_POST['roles'] as $role) {
		$role['matchId']=$matchId;
		$dw->writeGeneric($role,'matchRole');
	}
	*/
	$obj=$dr->getMatchById($matchId);
	$obj->status='ok';
	$obj->statusMsg=$lang->get('Match was saved');
	print $obj->getJSON();
?>