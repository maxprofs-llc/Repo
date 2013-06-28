// JavaScript Document

function cityFormLoaded() {
	$('cityState').addEvent('update',function(e) {
		if($('cityCountry_id').value=='') {
			setValue('cityCountry',e.object._country.id,e.object._country._name,e.object);
		}
		updatePosition(e.object);
	});
	$('cityCountry').addEvent('update',function(e) {
		if($('cityContinent_id').value=='') {
			setValue('cityContinent',e.object._continent.id,e.object._continent._name,e.object);
		}
	});
	addNameEvents('city');	
}