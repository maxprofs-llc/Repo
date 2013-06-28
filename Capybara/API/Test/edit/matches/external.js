
function saveMatch(onComplete,args) {
	var saveAll=new Object();
	
	var match=new Object();
	if($('selectMatch')!=null)
		match.id=$('selectMatch').value;
	else
		match.id=-1;
	
	match.sportId=$('matchSport_id').value;
	//match.seasonId=$('matchSeason_id').value;
	match.roundNumber=$('matchRound').value;
	match.date=$('matchDate').value;
	match.time=$('matchTime').value;
	match.attendance=$('matchAttendance').value;
	match.arenaId=$('matchArena_id').value;
	match.cityId=$('matchCity_id').value;
	match.stateId=$('matchState_id').value;
	match.countryId=$('matchCountry_id').value;
	match.continentId=$('matchContinent_id').value;
	var pos=$('matchMap').retrieve('marker').getPosition();
	if($('matchMap_lat').value!=pos.lat())
		match.latitude=pos.lat();
	if($('matchMap_long').value!=pos.lng())
		match.longitude=pos.lng();
	match.isPlayed=$('matchIsPlayed').checked ? 1 : 0;
	match.isHidden=$('matchIsPublic').checked ? 0 : 1;
	match.isExcludedFromSummary=$('matchIsCounted').checked ? 0 : 1;
	match.hostOrganizationId=$('matchHost_id').value
	
	match.privateComment=$('matchPrivateComment').getElement('textarea').value;
	match.strings=new Array();
	$('matchPublicComment').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var comment=$('matchPublicComment_'+lang).value;
		match.strings.push({'languageId':langId,'publicComment':comment,'matchId':match.id});	
	});
	
	saveAll.competitors=new Array();
	
	var homeTeam=new Object();
	homeTeam.id=$('matchHomeCompetitorId').value;
	homeTeam.teamId=$('matchHomeTeam_id').value;
	homeTeam.orderNumber=1;
	//homeTeam.isStarter=($('matchKickoff').value==homeTeam.teamId);
	
	var awayTeam=new Object();
	awayTeam.id=$('matchAwayCompetitorId').value;
	awayTeam.teamId=$('matchAwayTeam_id').value;
	awayTeam.orderNumber=2;
	//awayTeam.isStarter=($('matchKickoff').value==awayTeam.teamId);
	
	var periods=new Array();
	$('matchPeriods').getElements('.period').each(function(el){ 
		var period=new Object();
		period.periodTypeId=el.getElement('.matchPeriodType').getValue();
		period.length=el.getElement('.length').value;
		if(el.getElement('.id'))
			period.id=el.getElement('.id').value;
		period.startingTeamId=el.getElement('.kickoff').value;
		sbox=el.getElement('.matchPeriodDirection');
		period.startingGeoDirectionId=$(sbox.get('id')+"_id").value;
		periods.push(period);
	});
	
	referees=new Array();
	$('matchReferees').getElements('.referee').each(function(el){
		var referee=new Object();
		referee.roleId=el.getElement('.refereeRole').getValue();
		if(el.getElement('.id'))
			referee.id=el.getElement('.id').value;
		referee.personId=el.getElement('.refereePerson').getValue();
		referees.push(referee);
	});
	
	weather=new Object();
	weather.id=$('matchWeatherId').value;
	weather.precipitationTypeId=$('matchPrecipitationType').getValue();
	weather.weatherTypeId=null;
	weather.cityId=$('matchWeatherCity_id').value;
	weather.stateId=$('matchWeatherState_id').value;
	weather.countryId=$('matchWeatherCountry_id').value;
	weather.continentId=$('matchWeatherContinent_id').value;
	var pos=$('matchWeatherMap').retrieve('marker').getPosition();
	if($('matchWeatherMap_lat').value!=pos.lat())
		weather.latitude=pos.lat();
	if($('matchWeatherMap_long').value!=pos.lng())
		weather.longitude=pos.lng();
	weather.windGeoDirectionId=$('matchWindDirection').getValue();
	weather.temperature=$('matchTemperature').value;
	weather.windSpeed=$('matchWindSpeed').value;
	weather.date=match.date;
	weather.time=match.time;
	weather.visibility=$('matchVisibility').value;
	weather.humidity=$('matchHumidity').value;
	weather.pressure=$('matchPressure').value;
	weather.precipitation=$('matchPrecipitation').value;
	weather.cloudiness=$('matchCloudiness').value;
	weather.gustSpeed=$('matchGustSpeed').value;
	
	var players=new Array();
	$('matchHomeTeamSquadGrid').getElements('tr.player').each(function(p) {
		var player=new Object();
		player.id=p.getElement('.id').value;
		player.shirtNumber=p.getElement('.shirtnumber').value;
		player.personId=p.getElement('.person').getValue();
		player.roleId=p.getElement('.role').getValue();
		player.distance=p.getElement('.distance').value;
		player.speed=p.getElement('.speed').value;
		player.matchFull=p.getElement('.entire').checked ? 1 : 0;
		players.push(player);
	});
	homeTeam.players=players;	
	
	players=new Array();
	$('matchAwayTeamSquadGrid').getElements('tr.player').each(function(p) {
		var player=new Object();
		player.id=p.getElement('.id').value;
		player.shirtNumber=p.getElement('.shirtnumber').value;
		player.personId=p.getElement('.person').getValue();
		player.roleId=p.getElement('.role').getValue();
		player.distance=p.getElement('.distance').value;
		player.speed=p.getElement('.speed').value;
		player.matchFull=p.getElement('.entire').checked ? 1 : 0;
		players.push(player);
	});
	awayTeam.players=players;
	
	matchEvents=new Array();
	$('matchHomeTeamGoals').getElements('tr.goal').each(function(g) {
		var goal=new Object();
//		goal.scorerId=g.getElement('.scorer').value;
//		goal.assistId=g.getElement('.assist').value;
//		goal.time=g.getElement('.time').value;
		goal.id=g.getElement('.id').value;
		goal.ownScore=g.getElement('.homeScore').value;
		goal.opponentScore=g.getElement('.awayScore').value;
		
		var assist=new Object();
		assist.personId=g.getElement('.assist').value;
		goal.assist=assist;
		
		var matchEvent=new Object();
		matchEvent.goal=goal;
		matchEvent.personId=g.getElement('.scorer').value;
		
		matchEvents.push(matchEvent);
	});
	homeTeam.matchEvents=matchEvents;
	
	matchEvents=new Array();
	$('matchAwayTeamGoals').getElements('tr.goal').each(function(g) {
		if(typeof console != 'undefined') console.log(g);
		var goal=new Object();
//		goal.scorerId=g.getElement('.scorer').value;
//		goal.assistId=g.getElement('.assist').value;
//		goal.time=g.getElement('.time').value;
		if(g.getElement('.id')!=null)
			goal.id=g.getElement('.id').value;
		goal.opponentScore=g.getElement('.homeScore').value;
		goal.ownScore=g.getElement('.awayScore').value;
		
		var assist=new Object();
		if(g.getElement('.assistId')!=null)
			assist.id=g.getElement('.assistId').value;
		else
			console.log('Assist Id not found');
		assist.personId=g.getElement('.assist').value;
		goal.assist=assist;
		
		var matchEvent=new Object();
		if(g.getElement('.matchEventId')!=null)
			matchEvent.id=g.getElement('.matchEventId').value;
		matchEvent.goal=goal;
		matchEvent.personId=g.getElement('.scorer').value;
		
		matchEvents.push(matchEvent);
	});
	awayTeam.matchEvents=matchEvents;
	
	saveAll.match=match;
	saveAll.competitors.push(homeTeam);
	saveAll.competitors.push(awayTeam);
	saveAll.periods=periods;
	saveAll.referees=referees;
	saveAll.weather=weather;
	
	var ajax=new Request.JSON({url:'matches/saveMatch.php',onSuccess:function(result,resultText) {
		if(result!=null && result.status=='ok') {
			if(onComplete==null) {
				$('matchSaveStatus').removeClass('error');
				saveInitialValues();
				if(match.id==-1) {
					$('selectMatch').adopt(new Element('option',{'value':result.id,'html':result._name+' (ID: '+result.id+')'}));
				}
				$('matchForm').getElement('.headline').set('html',result._name);
				$('selectMatch').getElements('option').each(function(opt) {
					if(typeof console != 'undefined') console.log(opt);
					if(opt.value==result.id) {
						opt.set('html',result._name);
						return;
					}
				});
				$('matchSaveStatus').set('html',result.statusMsg);
				$('selectMatch').value=result.id;
				$('selectMatch').fireEvent('change',{target:$('selectMatch'),message:result.statusMsg});
			} else {
				onComplete(args,result);	
			}
		} else {
			$('matchSaveStatus').addClass('error');
			if(result!=null)
				$('matchSaveStatus').set('html',result.statusMsg);
			else
				$('matchSaveStatus').set('html',resultText);
		}
	}}).post(saveAll);	
	/*
	var goals=...;
	match.event=new Array();
	match.goal=new Array();
	match.shot=new Array();
	match.assist=new Array();
	goals.each(function(goal){
		var matchId=;
		var personId=;
		var teamId=;
		//var roleId=;
		var time=new Object();
		time.timeString=;
		//var coordinates;
		//var nextMatchEventId
		match.event.push('matchId':matchId ...);
		
		//var homeScore;
		//var awayScore;
		var orderNumber;
		
		match.goal.push('matchEventId');
		
		var shotTypeId=;
		var directionId=;
		var height=;
		var width=;
		var speed=;
		var isInGoal=1;
		var isOnGoal=1;
		var isOnPost=;
		var isOnBar=;
		var isOnPlayer=;
		var onPlayerId=;
		
		match.shot.push('matchEventId');
		
		var goalId=;
		var playerId=;
		var orderNumber=1;
		
		match.assist.push();
	});
	
	match.referee=new Array();
	
	var refs=...;
	refs.each(function(player) {
		var matchId=;
		var personId=;
		var roleId=;
		var time=new Object();
		time.timeString=;
		var dressId=;
		var geoDirectionId=;
	});
	
	match.player=new Array();
	
	var homePlayers=...;
	homePlayers.each(function(player) {
		var matchId=;
		var personId=;
		var teamId=;
		var roleId=;
		var time=new Object();
		time.timeString=;
		var distance=;
		var speed=;
		var dressId=;
		//var coordinates=;
		
		match.player.push();
	});

	var captains=...;
	captains.each(function(player) {
		var matchId=;
		var personId=;
		var teamId=;
		var roleId=;
		var time=new Object();
		time.timeString=;
		var distance=;
		var speed=;
		var dressId=;
		//var coordinates=;
		
		match.player.push();
	});
	
	match.substitutions=new Array();
	var substitutions=;
	subsitutions.each(function(sub) {
		var matchId=;
		var personId=;
		var teamId=;
		//var roleId=;
		var time=new Object();
		time.timeString=;
		//var coordinates;
		//var nextMatchEventId			
		match.event.push();
		
		var nextPlayerId=;
		var substitutionReasonId=;
		match.substitutions.push();
	})
	
	match.cards=new Array();
	match.warning=new Array();
	match.penalty=new Array();
	
	var cards=;
	cards.each(function(card) {
		var matchId=;
		var personId=;
		var teamId=;
		//var roleId=;
		var time=new Object();
		time.timeString=;
		//var coordinates;
		//var nextMatchEventId
		match.event.push('matchId':matchId ...);
		
		var colorId=;
		var cardReasonId=;
		var orderNumber=;
		
		match.cards.push('matcheEventID')
		
		if(rštt kort) {
			var length;
			var isRemainder;
			
			match.penalty.push;
		} else {
			var 
		}
	});
	*/
}
