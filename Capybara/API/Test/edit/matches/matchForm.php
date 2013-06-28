<?php
	include_once('../_define.php');
	
	$sess->checkUrl(false,$_SESSION['basedir'].'/matches.php',true);
	
	$matchid=$_GET['id'];
			
	if($matchid>0)
		$match=$dr->getMatchById($matchid);
	else {
		$match=new match_match();
		if($matchid==-2) {
			$match->getHomeCompetitor()->teamId=$conf->get('my_team');
			$match->hostOrganizationId=$match->getHomeTeam()->getOrganization()->id;
			$match->arenaId=$match->getHomeTeam()->getHomeArena()->id;
		}
		elseif($matchid==-3)
			$match->getAwayCompetitor()->teamId=$conf->get('my_team');
		$match->sportId=$conf->get('default_sport_id',1);
	}
	
	$form=new form_standardForm('match','matches');

	if(!is_null($match->id)) 
		$form->headline=$match->getName();
	else
		$form->headline=$lang->get('New match');
	$form->dataReader=$dr;
			
	//Info
	
	$matchinfo=$form->addExpandableArea('Info','match_info','Match_information');	
		
	$form->addSearchField('Sport','Sport',$match->getSport()->id,$match->getSport()->getName(),'sports/sportJSON.php','addSport',$dr->getSportList());
	//$form->addSearchField('Season','Season',$match->getSeason()->id,$match->getSeason()->getName(),'season/seasonJSON.php','addSeason',$dr->getSeasonList());
	$form->addTextField('Round','Round',$match->roundNumber);
	
	//$form->addSearchField('MatchType','Match_type',$match->getMatchType()->id,$match->getMatchType()->getName(),'matchtypes/matchtypeJSON.php','addMatchType',$dr->getMatchTypeList());
	$form->addSearchField('HomeTeam','Home_team',$match->getHomeTeam()->id,$match->getHomeTeam()->getName(),'teams/teamJSON.php','addTeam',NULL,NULL,'matchTeam');
	$form->addSearchField('AwayTeam','Away_team',$match->getAwayTeam()->id,$match->getAwayTeam()->getName(),'teams/teamJSON.php','addTeam',NULL,NULL,'matchTeam');
	$form->addHiddenField('HomeCompetitorId',$match->getHomeCompetitor()->id);
	$form->addHiddenField('AwayCompetitorId',$match->getAwayCompetitor()->id);
	$form->addDateField('Date','Date',$match->date);
	$form->addTextField('Time','Time',$match->time);
	$form->addTextField('HomeGoals','Home_goals',count($match->getHomeGoals()));
	$form->addTextField('AwayGoals','Away_goals',count($match->getAwayGoals()));
	//$form->addSearchField('Arena','Arena',$match->getArena()->id,$match->getArena()->getName(),'arenas/arenaJSON.php','addArena');
	$form->addSearchField('ArenaOnly','Arena',$match->getArena()->id,$match->getArena()->getName(),'arenas/arenaJSON.php','addArena');
	$form->addTextField('Attendance','Attendance',$match->attendance);	
	$form->addCheckBoxField('IsPlayed','Has_been_played',$match->isPlayed);
	//$form->addUpdatableDropDownField('Kickoff','Kickoff',$match->getStarterTeam()->id,'.matchTeam',array(''=>$lang->get('Unknown_team')),array($match->getHomeTeam()->id=>$match->getHomeTeam()->getName(),$match->getAwayTeam()->id=>$match->getAwayTeam()->getName()));	
	$form->addCheckBoxField('IsPublic','Visible',$match->isPublic);
	$form->addCheckBoxField('IsCounted','Is_counted',$match->isIncludedInSummary);
	$form->addLongTextField('PrivateComment','Internal comments',$match->privateComment);
	$form->addLangField('PublicComment','Public comments',$match->strings,'publicComment');
	
	$form->addLocation($match);
	$imageList=$dr->getImageList('match',$match->id);
	$form->addImages($imageList,'match',$match->id);
	
	$details=$form->addExpandableArea('DetailedInfo','detailed match_info','Detailed match_info');
	$form->addSearchField('Host','Host organization',$match->getHostOrganization()->id,$match->getHostOrganization()->getName(),'organizations/organizationJSON.php','addOrganization',NULL,NULL,'populateOnExpand');
	$form->addExpandableArea('ReportArea','match_report','Match_report','',$details);
	$form->addTextEditor($match->getReport(),'Report');
	$periods=$form->addExpandableArea('MatchPeriods','periods','Periods',NULL,$details);
	$form->addPeriodGrid($match->getPeriods(),array($match->getHomeTeam(),$match->getAwayTeam()));
	$referees=$form->addExpandableArea('Referees','referees','Referees',NULL,$details);
	$form->addRefereeGrid($match->getReferees());
	$weather=$form->addExpandableArea('Weather','weather','Weather',NULL,$details);
	$form->addHiddenField('WeatherId',$match->getWeather()->id);
	$form->addTextField('Temperature','Temperature',$match->getWeather()->temperature,'&deg;C');
	$form->addTextField('WindSpeed','Wind_speed',$match->getWeather()->windSpeed,'m/s');
	$form->addSearchField('WindDirection','Wind direction',$match->getWeather()->getWindGeoDirection()->id,$match->getWeather()->getWindGeoDirection()->getName(),'geoDirections/geoDirectionJSON.php','addGeoDirection',NULL,NULL,'populateOnExpand');
	$form->addTextField('Visibility','Visibility',$match->getWeather()->visibility);
	$form->addTextField('Humidity','Humidity',$match->getWeather()->humidity,'%');
	$form->addTextField('Pressure','Pressure',$match->getWeather()->pressure);
	$form->addTextField('Precipitation','Precipitation',$match->getWeather()->precipitation,'mm');
	$form->addSearchField('PrecipitationType','Precipitation type',$match->getWeather()->getPrecipitationType()->id,$match->getWeather()->getPrecipitationType()->getName(),'precipitationTypes/precipitationTypeJSON.php','addPrecipitationType',NULL,NULL,'populateOnExpand');
	$form->addTextField('Cloudiness','Cloudiness',$match->getWeather()->cloudiness,'%');
	$form->addTextField('GustSpeed','Gust_speed',$match->getWeather()->gustSpeed,'m/s');
	$form->addLocation($match->getWeather(),'weather_station location','matchWeather',$weather);
	
	
	$hometeaminfo=$form->addExpandableArea('HomeTeamDetails','home_team_details','Home_team_details');
	$hometeaminfo->subHeadline=$match->getHomeTeam()->getName();
	$form->addTextField('HomeFormation','Formation',$match->getHomeTeamFormation()->getName());
	$hometeamdress=$form->addExpandableArea('HomeTeamDress','dress','Dress',NULL,$hometeaminfo);
	$hometeamsquad=$form->addExpandableArea('HomeTeamSquad','squad','Squad',NULL,$hometeaminfo);
	$form->addSquadGrid('HomeTeam',$match->getHomeSquad());
	$hometeamsubs=$form->addExpandableArea('HomeTeamSubstitutions','substitutions','Substitutions','subs',$hometeamsquad);
	$form->addSubstitutionsGrid('HomeTeam',$match->getHomeSubstitutions());
	$hometeamcaptains=$form->addExpandableArea('HomeTeamCaptains','captains','Captains','captain',$hometeamsquad);
	$form->addCaptainsGrid('HomeTeam');
	$hometeammom=$form->addExpandableArea('HomeTeamMoM','man_of_the_match','Man_of_the_match','MoM',$hometeamsquad);
	$form->addMoMGrid('HomeTeam');
	$hometeamgoals=$form->addExpandableArea('HomeTeamGoals','goals','Goals',NULL,$hometeaminfo);
	$form->addGoalGrid('HomeTeam',$match->getHomeGoals());
	//$hometeamcards=$form->addExpandableArea('HomeTeamCards','cards','Cards',NULL,$hometeaminfo);
	//$form->addLink($lang->get('Add card'),'javascript:addCard("Home")');

	$awayteaminfo=$form->addExpandableArea('AwayTeamDetails','away_team_details','Away_team_details');
	$awayteaminfo->subHeadline=$match->getAwayTeam()->getName();
	$form->addTextField('AwayFormation','Formation',$match->getAwayTeamFormation()->getName());
	$awayteamdress=$form->addExpandableArea('AwayTeamDress','dress','Dress',NULL,$awayteaminfo);
	$awayteamsquad=$form->addExpandableArea('AwayTeamSquad','squad','Squad',NULL,$awayteaminfo);
	$form->addSquadGrid('AwayTeam',$match->getAwaySquad());
	
	$awayteamsubs=$form->addExpandableArea('AwayTeamSubstitutions','substitutions','Substitutions','subs',$awayteamsquad);
	$form->addSubstitutionsGrid('AwayTeam',$match->getAwaySubstitutions());
	$awayteamcaptains=$form->addExpandableArea('AwayTeamCaptains','captains','Captains','captain',$awayteamsquad);
	$form->addCaptainsGrid('AwayTeam');
	$awayteammom=$form->addExpandableArea('AwayTeamMoM','man_of_the_match','Man_of_the_match','MoM',$awayteamsquad);
	$form->addMoMGrid('AwayTeam');
	
	$awayteamgoals=$form->addExpandableArea('AwayTeamGoals','goals','Goals',NULL,$awayteaminfo);
	$form->addGoalGrid('AwayTeam',$match->getAwayGoals());
	//$awayteamcards=$form->addExpandableArea('AwayTeamCards','cards','Cards',NULL,$awayteaminfo);
	//$form->addLink($lang->get('Add card'),'javascript:addCard("Away")');
	
	$form->showSave=(!isset($_GET['nosave']));
	$form->saveFunction='saveMatch';
	
	$form->printHTML();
	
	//helper::debugPrint(json_encode($match),'match');
?>