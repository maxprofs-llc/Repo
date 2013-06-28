// JavaScript Document

function teamFormLoaded() {
	$('teamArena').addEvent('update',function(e) {
		if(typeof console != 'undefined') console.log(e.object)
		if($('teamCity_id').value=='') {
			setValue('teamCity',e.object._city.id,e.object._city._name,e.object);
		}
		if(e.object.latitude!=null)
			$('teamMap_lat').value=e.object.latitude;
		if(e.object.longitude!=null)
			$('teamMap_long').value=e.object.longitude;
		if(e.object.streetName!=null)
			$('teamStreet').value=e.object.streetName;
		if(e.object.streetNumber!=null)
			$('teamStreetNumber').value=e.object.streetNumber;
		if(e.object.zipCode!=null)
			$('teamZipCode').value=e.object.zipCode;
		if(e.object.zipArea!=null)
			$('teamZipArea').value=e.object.zipArea;
		initMap();
	});
	$('teamCity').addEvent('update',function(e) {
		if($('teamState_id').value=='') {
			setValue('teamState',e.object._state.id,e.object._state._name,e.object);
		}
	});
	$('teamState').addEvent('update',function(e) {
		if($('teamCountry_id').value=='') {
			setValue('teamCountry',e.object._country.id,e.object._country._name,e.object);
		}
	});
	$('teamCountry').addEvent('update',function(e) {
		if($('teamContinent_id').value=='') {
			setValue('teamContinent',e.object._continent.id,e.object._continent._name,e.object);
		}
	});	
	addNameEvents('team');
}
