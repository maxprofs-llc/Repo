// JavaScript Document

var homeGoalAjax=null;
var awayGoalAjax=null;

var homeTeam;
var awayTeam;
var homeTeamAjax;
var awayTeamAjax;

var arenaAjax;
var cityAjax;
var stateAjax;
var countryAjax;

function matchFormLoaded() {
	$('matchArena').addEvent('update',function(e) {
		$('matchCity').waitForUpdate();
		$('matchState').waitForUpdate();
		$('matchCountry').waitForUpdate();
		$('matchContinent').waitForUpdate();
		var fn=function() {
			arenaAjax=new Request.JSON({'url':'arenas/arenaJSON.php',onSuccess:function(arena){
				arenaAjax=null;
				ajaxRequests.erase('arena');
				
				if(arena._city!=undefined)
					setValue('matchCity',arena._city.id,arena._city._name,arena,true);
				if(arena._state!=undefined)
					setValue('matchState',arena._state.id,arena._state._name,arena,true);
				if(arena._country!=undefined)
					setValue('matchCountry',arena._country.id,arena._country._name,arena,true);
				if(arena._continent!=undefined)
					setValue('matchContinent',arena._continent.id,arena._continent._name,arena,true);
				if(arena.latitude!=null)
					$('matchMap_lat').value=arena.latitude;
				if(arena.longitude!=null)
					$('matchMap_long').value=arena.longitude;
				if(arena.streetName!=null)
					$('matchStreet').value=arena.streetName;
				if(arena.streetNumber!=null)
					$('matchStreetNumber').value=arena.streetNumber;
				if(arena.zipCode!=null)
					$('matchZipCode').value=arena.zipCode;
				if(arena.zipArea!=null)
					$('matchZipArea').value=arena.zipArea;
				initMap();
				setValue('matchArenaOnly',arena.id,arena._name,arena,true);	
				$('matchCity').updateReady();
				$('matchState').updateReady();
				$('matchCountry').updateReady();
				$('matchContinent').updateReady();					
			},onCancel:function() {
				ajaxRequests.erase('arena');
				$('matchCity').updateReady();
				$('matchState').updateReady();
				$('matchCountry').updateReady();
				$('matchContinent').updateReady();					
			}}).get({'id':e.object.id,'verbose':1});
			ajaxRequests.include('arena',arenaAjax);
		};
		if(arenaAjax==null)
			fn();
		else {
			arenaAjax.cancel();
			fn();
		}		
	});
	$('matchArenaOnly').addEvent('update',function(e) {
		setValue('matchArena',e.object.id,e.object._name,e.object);
	});
	$('matchCity').addEvent('update',function(e) {
		$('matchState').waitForUpdate();
		$('matchCountry').waitForUpdate();
		$('matchContinent').waitForUpdate();
		var fn=function() {
			cityAjax=new Request.JSON({'url':'cities/cityJSON.php',onSuccess:function(city){
				cityAjax=null;
				ajaxRequests.erase('city');
				setValue('matchState',city._state.id,city._state._name,city,true);
				setValue('matchCountry',city._country.id,city._country._name,city,true);
				setValue('matchContinent',city._continent.id,city._continent._name,city,true);	
				$('matchState').updateReady();
				$('matchCountry').updateReady();
				$('matchContinent').updateReady();				
			},onCancel:function() {
				ajaxRequests.erase('city');
				$('matchState').updateReady();
				$('matchCountry').updateReady();
				$('matchContinent').updateReady();	
			}}).get({'id':e.object.id,'verbose':1});
			ajaxRequests.include('city',cityAjax);
		};
		if(cityAjax==null)
			fn();
		else {
			cityAjax.cancel();
			fn();
		}	
	});
	$('matchState').addEvent('update',function(e) {
		$('matchCountry').waitForUpdate();
		$('matchContinent').waitForUpdate();
		var fn=function() {
			stateAjax=new Request.JSON({'url':'states/stateJSON.php',onSuccess:function(state){
				stateAjax=null;
				ajaxRequests.erase('state');
				setValue('matchCountry',state._country.id,state._country._name,state,true);
				setValue('matchContinent',state._continent.id,state._continent._name,state,true);				
				$('matchCountry').updateReady();
				$('matchContinent').updateReady();	
			},onCancel:function() {
				ajaxRequests.erase('state');
				$('matchCountry').updateReady();
				$('matchContinent').updateReady();	
			}}).get({'id':e.object.id,'verbose':1});
			ajaxRequests.include('state',stateAjax);
		};
		if(stateAjax==null)
			fn();
		else {
			stateAjax.cancel();
			fn();
		}
	});
	$('matchCountry').addEvent('update',function(e) {
		$('matchContinent').waitForUpdate();
		var fn=function() {
			countryAjax=new Request.JSON({'url':'countries/countryJSON.php',onSuccess:function(country){
				countryAjax=null;
				ajaxRequests.erase('country');
				
				setValue('matchContinent',country._continent.id,country._continent._name,country,true);				
				$('matchContinent').updateReady();	
			},onCancel:function() {
				ajaxRequests.erase('country');
				$('matchContinent').updateReady();	
			}}).get({'id':e.object.id,'verbose':1});
			ajaxRequests.include('country',countryAjax);
		};
		if(countryAjax==null)
			fn();
		else {
			countryAjax.cancel();
			fn();
		}
	});
	$('matchWeatherCity').addEvent('update',function(e) {
		$('matchWeatherState').waitForUpdate();
		$('matchWeatherCountry').waitForUpdate();
		$('matchWeatherContinent').waitForUpdate();
		var fn=function() {
			cityAjax=new Request.JSON({'url':'cities/cityJSON.php',onSuccess:function(city){
				cityAjax=null;
				ajaxRequests.erase('wcity');
				
				setValue('matchWeatherState',city._state.id,city._state._name,city,true);
				setValue('matchWeatherCountry',city._country.id,city._country._name,city,true);
				setValue('matchWeatherContinent',city._continent.id,city._continent._name,city,true);				
				$('matchWeatherState').updateReady();
				$('matchWeatherCountry').updateReady();
				$('matchWeatherContinent').updateReady();	
			},onCancel:function() {
				ajaxRequests.erase('wcity');
				$('matchWeatherState').updateReady();
				$('matchWeatherCountry').updateReady();
				$('matchWeatherContinent').updateReady();	
			}}).get({'id':e.object.id,'verbose':1});
			ajaxRequests.include('wcity',cityAjax);
		};
		if(cityAjax==null)
			fn();
		else {
			cityAjax.cancel();
			fn();
		}	
	});
	$('matchWeatherState').addEvent('update',function(e) {
		$('matchWeatherCountry').waitForUpdate();
		$('matchWeatherContinent').waitForUpdate();
		var fn=function() {
			stateAjax=new Request.JSON({'url':'states/stateJSON.php',onSuccess:function(state){
				stateAjax=null;
				ajaxRequests.erase('wstate');
				
				setValue('matchWeatherCountry',state._country.id,state._country._name,state,true);
				setValue('matchWeatherContinent',state._continent.id,state._continent._name,state,true);				

				$('matchWeatherCountry').updateReady();
				$('matchWeatherContinent').updateReady();	
			},onCancel:function() {
				ajaxRequests.erase('wstate');

				$('matchWeatherCountry').updateReady();
				$('matchWeatherContinent').updateReady();	
			}}).get({'id':e.object.id,'verbose':1});
			ajaxRequests.include('wstate',stateAjax);
		};
		if(stateAjax==null)
			fn();
		else {
			stateAjax.cancel();
			fn();
		}
	});
	$('matchWeatherCountry').addEvent('update',function(e) {
		$('matchWeatherContinent').waitForUpdate();
		var fn=function() {
			countryAjax=new Request.JSON({'url':'countries/countryJSON.php',onSuccess:function(country){
				countryAjax=null;
				ajaxRequests.erase('wcountry');
				
				setValue('matchWeatherContinent',country._continent.id,country._continent._name,country,true);				

				$('matchWeatherContinent').updateReady();	
			},onCancel:function() {
				ajaxRequests.erase('wcountry');

				$('matchWeatherContinent').updateReady();	
			}}).get({'id':e.object.id,'verbose':1});
			ajaxRequests.include('wcountry',countryAjax);
		};
		if(countryAjax==null)
			fn();
		else {
			countryAjax.cancel();
			fn();
		}
	});
	$('matchHomeTeam').addEvent('update',function(e) {
		var fn=function() {
			homeTeamAjax=new Request.JSON({'url':'teams/teamJSON.php',onSuccess:function(team){
				homeTeam=team;
				homeTeamAjax=null;
				ajaxRequests.erase('homeTeam');
				homeTeamChanged();
			},onCancel:function() {
				ajaxRequests.erase('homeTeam');
			}}).get({'id':e.object.id,'verbose':1});
			ajaxRequests.include('homeTeam',homeTeamAjax);
		};
		if(homeTeamAjax==null)
			fn();
		else {
			homeTeamAjax.cancel();
			fn();
		}		
	});
	$('matchHomeGoals').addEvent('change',function(e) {
		var fn=function() {
			//var prevGoals=parseInt($('matchHomeGoals').retrieve('goals'));
			var prevGoals=$('matchHomeTeamGoals_table').getElements('tr.goal').length;
			var goals=$('matchHomeGoals').value;
			var table=$('matchHomeTeamGoals_table');
			if(goals<prevGoals) {
				var g=0;
				var delGoals=new Array();
				var isSet=false;
				$('matchHomeTeamGoals_table').getElements('tr.goal').each(function(el) {
					g=g+1;
					if(g>goals) { 
						delGoals.push(el);
						if(el.getElement('.scorer').value!='' || el.getElement('.assist').value!='')
							isSet=true
					}
				});
				if(!isSet || confirm(translate('Goals with data will be deleted. Continue?')))
					delGoals.each(function(el) {
						el.destroy();
					});
				$('matchHomeGoals').store('goals',goals);
				return;
			}
			var tr=new Element('tr');
			var td=new Element('td',{'html':'<img src="icons/ajax-loader.gif" alt="Loading..." />','colspan':3});
			tr.adopt(td);
			table.adopt(tr);
			homeGoalAjax=new Request.HTML({'url':'goals/goalForm.php',update:td,onSuccess:function(tree,elements,html,js) {
				//tr.destroy();
				homeGoalAjax=null;
				$('matchHomeGoals').store('goals',goals);
				ajaxRequests.erase('homeGoals');
			},onCancel:function() {
				tr.destroy();
				ajaxRequests.erase('homeGoals');
			}}).get({'teamid':$('matchHomeTeam_id').value,'goalnr':(prevGoals+1),'prefix':'home','goals':(goals)});	
			ajaxRequests.include('homeGoals',homeGoalAjax);
		};
		if(homeGoalAjax==null)
			fn();
		else {
			homeGoalAjax.cancel();
			fn();
		}
	});
	$('matchAwayTeam').addEvent('update',function(e) {
		var fn=function() {
			awayTeamAjax=new Request.JSON({'url':'teams/teamJSON.php',onSuccess:function(team){
				awayTeam=team;
				awayTeamAjax=null;
				ajaxRequests.erase('awayTeam');
				awayTeamChanged();
			},onCancel:function() {
				ajaxRequests.erase('awayTeam');
			}}).get({'id':e.object.id,'verbose':1});
			ajaxRequests.include('awayTeam',awayTeamAjax);
		};
		if(awayTeamAjax==null)
			fn();
		else {
			awayTeamAjax.cancel();
			fn();
		}		
	});
	$('matchAwayGoals').addEvent('change',function(e) {
		var fn=function() {
			//var prevGoals=parseInt($('matchAwayGoals').retrieve('goals'));
			var prevGoals=$('matchAwayTeamGoals_table').getElements('tr.goal').length;
			var goals=$('matchAwayGoals').value;
			var table=$('matchAwayTeamGoals_table');
			if(goals<prevGoals) {
				var g=0;
				var delGoals=new Array();
				var isSet=false;
				$('matchAwayTeamGoals_table').getElements('tr.goal').each(function(el) {
					g=g+1;
					if(g>goals) { 
						delGoals.push(el);
						if($(el.getElement('.scorer')).getSelected()[0].value!='' || $(el.getElement('.assist')).getSelected()[0].value!='')
							isSet=true;
					}
				});
				if(!isSet || confirm(translate('Goals with data will be deleted. Continue?')))
					delGoals.each(function(el) {
						el.destroy();
					});
				$('matchAwayGoals').store('goals',goals);
				return;
			}
			var tr=new Element('tr');
			var td=new Element('td',{'html':'<img src="icons/ajax-loader.gif" alt="Loading..." />','colspan':3});
			tr.adopt(td);
			table.adopt(tr);
			homeGoalAjax=new Request.HTML({'url':'goals/goalForm.php',update:td,onSuccess:function(tree,elements,html,js) {
				//tr.destroy();
				homeGoalAjax=null;
				$('matchAwayGoals').store('goals',goals);
				ajaxRequests.erase('homeGoals');
			},onCancel:function() {
				tr.destroy();
				ajaxRequests.erase('homeGoals');
			}}).get({'teamid':$('matchAwayTeam_id').value,'goalnr':(prevGoals+1),'prefix':'away','goals':(goals)});	
			ajaxRequests.include('awayGoals',awayGoalAjax);
		};
		if(awayGoalAjax==null)
			fn();
		else {
			awayGoalAjax.cancel();
			fn();
		}
	});
	$('matchHomeGoals').store('goals',0);
	$('matchAwayGoals').store('goals',0);
	$('matchIsPlayed').addEvent('click',function(e){
		/*
		if($('matchIsPlayed').checked)		
			$('matchKickoff').getParent('tr').setStyle('display','');
		else
			$('matchKickoff').getParent('tr').setStyle('display','none');
		*/
	});
	$('matchDate').addEvent('change',function(e){
		var matchDate=new Date($('matchDate').value);
		var now=new Date();
		if(matchDate>now)
			$('matchIsPlayed').checked='';
		else
			$('matchIsPlayed').checked='checked';
		$('matchIsPlayed').fireEvent('click');
	});
	$('matchIsPlayed').fireEvent('click');
}

var contRead=false;

function abortRead() {
	contRead=false;	
}

function getYearMatches(year) {
	var ajax=new Request.JSON({url:'matches/match_json.php',onSuccess:function(matches) { 
		for(var m in matches) {
			var mtch=matches[m];		
			date=getShortDate(mtch.date);
			matchString=date+", "+(mtch.hometeam==null ? '<okänd>' : mtch.hometeam.name)+"-"+(mtch.awayteam==null ? '<okänd>' : mtch.awayteam.name);
			var opt=new Element('option',{'value':mtch.id,'html':matchString});
			opt.inject($('selectMatch'),'bottom');
		}
		year-=1;
		if(year>1890 && contRead)
			getYearMatches(year);
	}}).get({'year':year});
}

function getShortDate(date) {
	if(date.day==null || date.day==0) {
		if(date.month==null || date.month==0) {
			if(date.year==null || date.year==0)
				return "Okänt datum"; //-	
			else 
				return date.year;
		} else {
			return date.year+"-"+date.month;
		}
	} else {
		return date.year+"-"+date.month+"-"+date.day;
	}
}

function getNextRow(table,checkelement,extrarows) {
	var no=table.getElements('tr').length-extrarows;
	if(typeof console != 'undefined') console.log(checkelement+no);
	while($(checkelement+no)!=null) {
		no+=1;
	}
	return no;
}

function addMatchReferee() {
	var table=$('matchRefereeGrid');
	var tr=new Element('tr',{'class':'referee'});
	var buttonTr=table.getElement('input[type=button]').getParent().getParent();
	var td=new Element('td',{'html':'<img src="icons/ajax-loader.gif" alt="Loading..." />','colspan':3});
	tr.adopt(td);
	tr.inject(buttonTr,'before');
	var ajax=new Request.HTML({'url':'referees/refereeForm.php',update:tr,onSuccess:function(tree,elements,html,js) {
		//tr.destroy();
		ajaxRequests.erase('referees');
	},onCancel:function() {
		//tr.destroy();
		ajaxRequests.erase('referees');
	}}).get({'no':getNextRow(table,'referee',1)});	
	ajaxRequests.include('referees',ajax);
}

function addMatchPeriod() {
	var table=$('matchPeriods');
	var tr=new Element('tr',{'class':'period'});
	var buttonTr=table.getElement('input[type=button]').getParent().getParent();
	var td=new Element('td',{'html':'<img src="icons/ajax-loader.gif" alt="Loading..." />','colspan':3});
	tr.adopt(td);
	tr.inject(buttonTr,'before');
	var ajax=new Request.HTML({'url':'periods/periodForm.php',update:tr,onSuccess:function(tree,elements,html,js) {
		//tr.destroy();
		fixSearchBoxes();
		ajaxRequests.erase('matchPeriod');
	},onCancel:function() {
		//tr.destroy();
		ajaxRequests.erase('matchPeriod');
	}}).get({'no':getNextRow(table,'matchPeriodType',2)});	
	ajaxRequests.include('matchPeriod',ajax);
}

function deleteMatchReferee(ref) {
	if($('matchReferee'+ref+"_id").value!="") 
		if(!confirm(translate('Are you sure you want to remove this referee?')))
			return;
	var tr=$('matchReferee'+ref+"_id").getParent('.referee');
	tr.dispose();
}

function addCard(homeAway) {
	var table=$('match'+homeAway+'TeamCards_table');
	var tr=new Element('tr');
	var td=new Element('td',{'html':'<img src="icons/ajax-loader.gif" alt="Loading..." />','colspan':3,'class':'card'});
	tr.adopt(td);
	tr.inject(table,'bottom');
	var ajax=new Request.HTML({'url':'cards/cardForm.php',update:tr,onSuccess:function(tree,elements,html,js) {
		//tr.destroy();
		ajaxRequests.erase('cards');
	},onCancel:function() {
		//tr.destroy();
		ajaxRequests.erase('cards');
	}}).get({'teamid':$('match'+homeAway+'Team_id').value,'prefix':homeAway,'cardnr':getNextRow(table,homeAway+'Card',1)});	
	ajaxRequests.include('cards',ajax);
}

function deleteCard(homeAway,card) {
	if($(homeAway+'CardPlayer'+card).getSelected()[0].value!=0) 
		if(!confirm(translate('Are you sure you want to remove this card?')))
			return;
	var tr=$(homeAway+'CardPlayer'+card).getParent('.card');
	tr.dispose();
}

function awayTeamChanged() {
	if($('matchHost_id').value=='') 
		setValue('matchHost',awayTeam._organization.id,awayTeam._organization._name,awayTeam._organization);
	$('matchAwayTeamDetails').getElement('.subheadline').set('html',awayTeam._name);
	
	//Add functions to reload player list if goals or cards where added
}

function homeTeamChanged() {
	if(typeof console != 'undefined') console.log(homeTeam);
	if($('matchArena_id').value=='') 
		setValue('matchArena',homeTeam._homeArena.id,homeTeam._homeArena._name,homeTeam._homeArena);
	if($('matchHost_id').value=='') 
		setValue('matchHost',homeTeam._organization.id,homeTeam._organization._name,homeTeam._organization);
	$('matchHomeTeamDetails').getElement('.subheadline').set('html',homeTeam._name);
	
	//Add functions to reload player list if goals or cards where added
}

function addMatchHomeTeamPlayer() {
	addPlayer('Home');
}

function addMatchAwayTeamPlayer() {
	addPlayer('Away');
}

function addPlayer(side) {
	var table=$('match'+side+'TeamSquadGrid');
	var tr=new Element('tr',{'class':'player'});
	var buttonTr=table.getElement('input[type=button]').getParent().getParent();
	if(typeof console != 'undefined') console.log(buttonTr);
	var td=new Element('td',{'html':'<img src="icons/ajax-loader.gif" alt="Loading..." />','colspan':3});
	tr.adopt(td);
	tr.inject(buttonTr,'before');
	var ajax=new Request.HTML({'url':'players/matchPlayerForm.php',update:tr,onSuccess:function(tree,elements,html,js) {
		//tr.destroy();
		ajaxRequests.erase(side+'Player');
	},onCancel:function() {
		//tr.destroy();
		ajaxRequests.erase(side+'Player');
	}}).get({'no':getNextRow(table,side+'Player',3),'side':side});	
	ajaxRequests.include(side+'Player',ajax);
}

function addAllMatchHomeTeamRoles() {
	addAllMatchTeamRoles('Home');
}

function addAllMatchAwayTeamRoles() {
	addAllMatchTeamRoles('Away');
}

function addAllMatchTeamRoles(side) {
	var table=$('match'+side+'TeamSquadGrid');
	var tr=new Element('tr',{'class':'player'});
	var buttonTr=table.getElement('input[type=button]').getParent().getParent();
	if(typeof console != 'undefined') console.log(buttonTr);
	var td=new Element('td',{'html':'<img src="icons/ajax-loader.gif" alt="Loading..." />','colspan':3});
	tr.adopt(td);
	tr.inject(buttonTr,'before');
	var ajax=new Request.HTML({'url':'players/matchFormation.php',onSuccess:function(tree,elements,html,js) {
		var trs=Elements.from(html,true);
		trs.inject(tr,'after');
		tr.dispose();
		fixSearchBoxes(trs);
		ajaxRequests.erase(side+'Player');
	},onCancel:function() {
		//tr.destroy();
		ajaxRequests.erase(side+'Player');
	}}).get({'no':getNextRow(table,side+'Player',3),'side':side,'formation':$('match'+side+'Formation').value});	
	ajaxRequests.include(side+'Player',ajax);	
}

function addMatchHomeTeamSubstitution() {
	addMatchTeamSubstitution('Home');
}

function addMatchAwayTeamSubstitution() {
	addMatchTeamSubstitution('Away');
}

function addMatchTeamSubstitution(side) {
	var table=$('match'+side+'TeamSubstitutionsGrid');
	var tr=new Element('tr');
	var buttonTr=table.getElement('input[type=button]').getParent().getParent();
	if(typeof console != 'undefined') console.log(buttonTr);
	var td=new Element('td',{'html':'<img src="icons/ajax-loader.gif" alt="Loading..." />','colspan':3});
	tr.adopt(td);
	tr.inject(buttonTr,'before');
	var ajax=new Request.HTML({'url':'matches/formSubstitution.php',update:tr,onSuccess:function(tree,elements,html,js) {
		//tr.destroy();
		ajaxRequests.erase(side+'Sub');
	},onCancel:function() {
		//tr.destroy();
		ajaxRequests.erase(side+'Sub');
	}}).get({'no':getNextRow(table,'match'+side+'SubIn',2),'side':side});	
	ajaxRequests.include(side+'Sub',ajax);
}

function addMatchHomeTeamCaptain() {
	addMatchTeamCaptain('Home');
}

function addMatchAwayTeamCaptain() {
	addMatchTeamCaptain('Away');
}

function addMatchTeamCaptain(side) {
	var table=$('match'+side+'TeamCaptainsGrid');
	var tr=new Element('tr');
	var buttonTr=table.getElement('input[type=button]').getParent().getParent();
	if(typeof console != 'undefined') console.log(buttonTr);
	var td=new Element('td',{'html':'<img src="icons/ajax-loader.gif" alt="Loading..." />','colspan':3});
	tr.adopt(td);
	tr.inject(buttonTr,'before');
	var ajax=new Request.HTML({'url':'matches/formCaptains.php',update:tr,onSuccess:function(tree,elements,html,js) {
		//tr.destroy();
		ajaxRequests.erase(side+'Captain');
	},onCancel:function() {
		//tr.destroy();
		ajaxRequests.erase(side+'Captain');
	}}).get({'no':getNextRow(table,'match'+side+'Captain',2),'side':side});	
	ajaxRequests.include(side+'Captain',ajax);
}

function addMatchHomeTeamMoM() {
	addMatchTeamMoM('Home');
}

function addMatchAwayTeamMoM() {
	addMatchTeamMoM('Away');
}

function addMatchTeamMoM(side) {
	var table=$('match'+side+'TeamMoMGrid');
	var tr=new Element('tr');
	var buttonTr=table.getElement('input[type=button]').getParent().getParent();
	if(typeof console != 'undefined') console.log(buttonTr);
	var td=new Element('td',{'html':'<img src="icons/ajax-loader.gif" alt="Loading..." />','colspan':3});
	tr.adopt(td);
	tr.inject(buttonTr,'before');
	var ajax=new Request.HTML({'url':'matches/formMoM.php',update:tr,onSuccess:function(tree,elements,html,js) {
		//tr.destroy();
		fixSearchBoxes();
		ajaxRequests.erase(side+'MoM');
	},onCancel:function() {
		//tr.destroy();
		ajaxRequests.erase(side+'MoM');
	}}).get({'no':getNextRow(table,'match'+side+'MoM',2),'side':side});	
	ajaxRequests.include(side+'MoM',ajax);
}

function arenaUpdated() {
	
}

function deleteMatchHomeTeamPlayer(ref) {
	if($('matchHomeTeamPlayer'+ref+"_id").value!="") 
		if(!confirm(translate('Are you sure you want to remove this player?')))
			return;
	var tr=$('matchHomeTeamPlayer'+ref+"_id").getParent('tr');
	tr.dispose();
}

function deleteMatchAwayTeamPlayer(ref) {
	if($('matchAwayTeamPlayer'+ref+"_id").value!="") 
		if(!confirm(translate('Are you sure you want to remove this player?')))
			return;
	var tr=$('matchAwayTeamPlayer'+ref+"_id").getParent('tr');
	tr.dispose();
}

function deleteMatchHomeTeamSub(ref) {
	if($('matchHomeTeamSubIn'+ref).getSelected()[0].value!=0 || $('matchHomeTeamSubOut'+ref).getSelected()[0].value!=0) 
		if(!confirm(translate('Are you sure you want to remove this substitution?')))
			return;
	var tr=$('matchHomeTeamSubIn'+ref).getParent('tr');
	tr.dispose();
}

function deleteHomeCaptain(ref) {
	if($('matchHomeTeamCaptain'+ref).getSelected()[0].value!=0) 
		if(!confirm(translate('Are you sure you want to remove this captain?')))
			return;
	var tr=$('matchHomeTeamCaptain'+ref).getParent('tr');
	tr.dispose();
}

function deleteHomeMoM(ref) {
	if($('matchHomeTeamMoM'+ref).getSelected()[0].value!=0) 
		if(!confirm(translate('Are you sure you want to remove this player?')))
			return;
	var tr=$('matchHomeTeamMoM'+ref).getParent('tr');
	tr.dispose();
}

function deleteMatchAwayTeamSub(ref) {
	if($('matchAwayTeamSubIn'+ref).getSelected()[0].value!=0 || $('matchAwayTeamSubOut'+ref).getSelected()[0].value!=0) 
		if(!confirm(translate('Are you sure you want to remove this substitution?')))
			return;
	var tr=$('matchAwayTeamSubIn'+ref).getParent('tr');
	tr.dispose();
}

function deleteAwayCaptain(ref) {
	if($('matchAwayCaptain'+ref).getSelected()[0].value!=0) 
		if(!confirm(translate('Are you sure you want to remove this captain?')))
			return;
	var tr=$('matchAwayCaptain'+ref).getParent('tr');
	tr.dispose();
}

function deleteAwayMoM(ref) {
	if($('matchAwayMoM'+ref).getSelected()[0].value!=0) 
		if(!confirm(translate('Are you sure you want to remove this player?')))
			return;
	var tr=$('matchAwayMoM'+ref).getParent('tr');
	tr.dispose();
}

function addMatchPeriod() {
	var table=$('matchPeriods');
	var tr=new Element('tr',{'class':'period'});
	var buttonTr=table.getElement('input[type=button]').getParent().getParent();
	if(typeof console != 'undefined') console.log(buttonTr);
	var td=new Element('td',{'html':'<img src="icons/ajax-loader.gif" alt="Loading..." />','colspan':3});
	tr.adopt(td);
	tr.inject(buttonTr,'before');
	var ajax=new Request.HTML({'url':'periods/periodForm.php',update:tr,onSuccess:function(tree,elements,html,js) {
		//tr.destroy();
		fixSearchBoxes();
		ajaxRequests.erase('matchPeriod');
	},onCancel:function() {
		//tr.destroy();
		ajaxRequests.erase('matchPeriod');
	}}).get({'no':getNextRow(table,'matchPeriodType',2)});	
	ajaxRequests.include('matchPeriod',ajax);
}

function deleteMatchPeriod(period) {
	if($('matchPeriodKickOff'+period).getSelected()[0].value!=0) 
		if(!confirm(translate('Are you sure you want to remove this period?')))
			return;
	var tr=$('matchPeriodType'+period).getParent('tr');
	tr.dispose();
}