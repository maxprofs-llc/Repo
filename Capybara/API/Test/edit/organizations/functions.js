// JavaScript Document

function organizationFormLoaded() {
	$('organizationCity').addEvent('update',function(e) {
		if($('organizationState_id').value=='') {
			setValue('organizationState',e.object._state.id,e.object._state._name,e.object);
		}
	});
	$('organizationState').addEvent('update',function(e) {
		if($('organizationCountry_id').value=='') {
			setValue('organizationCountry',e.object._country.id,e.object._country._name,e.object);
		}
	});
	$('organizationCountry').addEvent('update',function(e) {
		if($('organizationContinent_id').value=='') {
			setValue('organizationContinent',e.object._continent.id,e.object._continent._name,e.object);
		}
	});	
	addNameEvents('organization');
}