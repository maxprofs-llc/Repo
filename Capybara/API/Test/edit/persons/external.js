
function addPerson(caller,person) {
	var win=new popupWindow('persons/personForm.php?nosave=1'+(person!=undefined?'&id='+person:''),{
		onOK:function() {
			this.hide();
			if(person!=undefined)
				fetchFromMasterDatabase('person',function(object) {
					var json=new Request.JSON({'url':'persons/personJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				savePerson(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
		},
		showButtons: false
	});
	win.show();
}

function savePerson(onComplete,args) {
	var person=new Object();
	if($('selectPerson')!=null)
		person.id=$('selectPerson').value;
	else
		person.id=-1;
	person.nativeName=$('personNativeName').value;
	person.birthDate=$('personBirthDate').value;
	person.deceaseDate=$('personDeceaseDate').value;
	person.motherOrganizationId=$('personMotherOrganization_id').value;

	person.cityId=$('personCity_id').value;
	person.stateId=$('personState_id').value;
	person.countryId=$('personCountry_id').value;
	person.continentId=$('personContinent_id').value;

	person.birthCityId=$('personBirthCity_id').value;
	person.birthStateId=$('personBirthState_id').value;
	person.birthCountryId=$('personBirthCountry_id').value;
	person.birthContinentId=$('personBirthContinent_id').value;

	var pos=$('personMap').retrieve('marker').getPosition();
	if($('personMap_lat').value!=pos.lat())
		person.latitude=pos.lat();
	if($('personMap_long').value!=pos.lng())
		person.longitude=pos.lng();
	pos=$('personBirthMap').retrieve('marker').getPosition();
	if($('personBirthMap_lat').value!=pos.lat())
		person.birthLatitude=pos.lat();
	if($('personBirthMap_long').value!=pos.lng())
		person.birthLongitude=pos.lng();

	person.privateComment=$('personPrivateComment').getElement('textarea').value;
	person.strings=new Array();
	$('personNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('personPublicComment_'+lang).value;
		var firstName=$('personFirstNames_'+lang).value;
		var lastName=$('personLastNames_'+lang).value;
		var fullName=$('personFullNames_'+lang).value;
		var nickName=$('personNickNames_'+lang).value;
		person.strings.push({'languageId':langId,'name':name,'firstName':firstName,'lastName':lastName,'fullName':fullName,'nickNames':nickName,'publicComment':comment,'personId':person.id});	
	});
	person.role=new Array();
	if($('personTeamRoles').getElements('tr.role')!=null) {
		var roles=$('personTeamRoles').getElements('tr.role').length;
		for(r=1;r<=roles;r++) {
			var id=$('personTeamRoleId'+r).value;
			var start=$('personTeamRoleStartDate'+r).value;
			var end=$('personTeamRoleEndDate'+r).value;
			var teamId=$('personRoleTeam'+r+'_id').value;
			var roleId=$('personTeamRole'+r+'_id').value;
			var shirtNumber=$('personRoleShirtNumber'+r).value;
			var primary=($('personTeamPrimaryRole'+r).checked ? 1:0);
			var comment=$('personTeamRoleNote'+r).retrieve('text');
			person.role.push({'id':id,'startDate':start,'defaultShirtNumber':shirtNumber,'endDate':end,'teamId':teamId,'roleId':roleId,'isPrimary':primary,'privateComment':comment});
		}
	}
	if($('personOrganizationRoles')!=null && $('personOrganizationRoles').getElements('tr.role')!=null) {
		roles=$('personOrganizationRoles').getElements('tr.role').length;
		for(r=1;r<=roles;r++) {
			var id=$('personOrganizationRoleId'+r).value;
			var start=$('personOrganizationRoleStartDate'+r).value;
			var end=$('personOrganizationRoleEndDate'+r).value;
			var organizationId=$('personRoleOrganization'+r+'_id').value;
			var roleId=$('personOrganizationRole'+r+'_id').value;
			var primary=($('personOrganizationPrimaryRole'+r).checked ? 1:0);
			var comment=$('personOrganizationRoleNote'+r).retrieve('text');
			person.role.push({'id':id,'startDate':start,'endDate':end,'teamId':teamId,'roleId':roleId,'isPrimary':primary,'privateComment':comment});
		}	
	}
	person.dimension=new Array();
	var dimensions=$('personDimensions').getElements('tr.dimension').length;
	for(r=1;r<=dimensions;r++) {
		var id=$('personDimensionId'+r).value;
		var date=$('personDimensionDate'+r).value;
		var weight=$('personWeight'+r).value;
		var height=$('personHeight'+r).value;
		person.dimension.push({'id':id,'date':date,'weight':weight,'height':height});
	}
	
	var ajax=new Request.JSON({url:'persons/savePerson.php',onSuccess:function(result,resultText) {
		if(result!=null && result.status=='ok') {
			if(onComplete==null) {
				$('personSaveStatus').removeClass('error');
				saveInitialValues();
				if(person.id==-1) {
					$('selectPerson').adopt(new Element('option',{'value':result.id,'html':result._name+' (ID: '+result.id+')'}));
				}
				$('personSaveStatus').set('html',result.statusMsg);
				$('selectPerson').value=result.id;
				$('selectPerson').fireEvent('change',{target:$('selectPerson'),message:result.statusMsg});
			} else {
				onComplete(args,result);	
			}
		} else {
			$('personSaveStatus').addClass('error');
			if(result!=null)
				$('personSaveStatus').set('html',result.statusMsg);
			else
				$('personSaveStatus').set('html',resultText);
		}
	}}).post(person);	
}

function removeImageLinkToSelected() {
	var list=$('personImageList');
	list.getElement('.imageList').getElements('.selected').reverse().each(function(el) {
		var id=el.getElement('img').get('id');
		var imgId=$(id+"_id").value;
		var div=$(id+"_popup");
		ajax=new Request({'url':'images/removeImage.php'}).get({'id':imgId});
		var td=el;
		while(td!=null) {
			td.removeClass('selected');
			if(td.getNext('td')!=null) {
				td.set('html',td.getNext('td').get('html'));
				td.removeEvents();
				td.cloneEvents(td.getNext('td'));
				td=td.getNext('td');
			} else {
				if(td.getParent('tr').getNext('tr')!=null && td.getParent('tr').getNext('tr').getFirst('td')!=null) {
					td.set('html',td.getParent('tr').getNext('tr').getFirst('td').get('html'));
					td.removeEvents();
					td.cloneEvents(td.getParent('tr').getNext('tr').getFirst('td'));
					td=td.getParent('tr').getNext('tr').getFirst('td');
				}
				else {
					if(td.getParent().getChildren().length==0)
						td.getParent().dispose();
					td.dispose();
					td=null;
					if(div!=null)
						div.dispose();
				}
			}
		}
	
	});
	if(typeof console != 'undefined') console.log(list.getElement('.thumbnail'));
	if(list.getElement('.thumbnail')==null) {
		if(list.getElement('.imageList').getElement('tr')!=null)
			list.getElement('.imageList').getElement('tr').dispose();
		tr=new Element('tr');
		td=new Element('td',{'html':translate('No_images')});
		tr.adopt(td);
		list.getElement('.imageList').adopt(tr);
	} 
}