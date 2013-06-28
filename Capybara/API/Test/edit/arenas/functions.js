// JavaScript Document

function arenaFormLoaded() {
	$('arenaCity').addEvent('update',function(e) {
		if($('arenaState_id').value=='') {
			setValue('arenaState',e.object._state.id,e.object._state._name,e.object);
		}
	});
	$('arenaState').addEvent('update',function(e) {
		if($('arenaCountry_id').value=='') {
			setValue('arenaCountry',e.object._country.id,e.object._country._name,e.object);
		}
	});
	$('arenaCountry').addEvent('update',function(e) {
		if($('arenaContinent_id').value=='') {
			setValue('arenaContinent',e.object._continent.id,e.object._continent._name,e.object);
		}
	});	
	addNameEvents('arena');
}