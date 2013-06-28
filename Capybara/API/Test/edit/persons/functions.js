// JavaScript Document

function personFormLoaded() {
	$('personCity').addEvent('update',function(e) {
		if($('personState_id').value=='') {
			setValue('personState',e.object._state.id,e.object._state._name,e.object);
		}
	});
	$('personState').addEvent('update',function(e) {
		if($('personCountry_id').value=='') {
			setValue('personCountry',e.object._country.id,e.object._country._name,e.object);
		}
	});
	$('personCountry').addEvent('update',function(e) {
		if($('personContinent_id').value=='') {
			setValue('personContinent',e.object._continent.id,e.object._continent._name,e.object);
		}
	});	
	$('personBirthCity').addEvent('update',function(e) {
		if($('personBirthState_id').value=='') {
			setValue('personBirthState',e.object._state.id,e.object._state._name,e.object);
		}
	});
	$('personBirthState').addEvent('update',function(e) {
		if($('personBirthCountry_id').value=='') {
			setValue('personBirthCountry',e.object._country.id,e.object._country._name,e.object);
		}
	});
	$('personBirthCountry').addEvent('update',function(e) {
		if($('personContinent_id').value=='') {
			setValue('personBirthContinent',e.object._continent.id,e.object._continent._name,e.object);
		}
	});	
	addNameEvents('person');
}

function addPersonRole(scope) {
	var table=$('person'+scope+'Roles');
	var tr=table.getElement('tr:nth-child(last)');
	var newTr=new Element('tr',{'class':'role'});
	var td=new Element('td',{'html':'<img src="icons/ajax-loader.gif" alt="Loading..." />','colspan':3,'class':'card'});
	newTr.adopt(td);
	newTr.inject(tr,'before');
	var ajax=new Request.HTML({url:'roles/personRoleForm.php',update:newTr,onSuccess:function () {
		fixSearchBoxes();
		fixDateFields();
	}}).get({'prefix':scope,'no':table.getElements('tr.role').length});
}