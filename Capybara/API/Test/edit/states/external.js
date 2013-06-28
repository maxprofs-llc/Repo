
function addState(caller,org) {
	var win=new popupWindow('states/stateForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('state',function(object) {
					var json=new Request.JSON({'url':'states/stateJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveState(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function saveState(onComplete,args) {
	var state=new Object();
	if($('selectState')!=null)
		state.id=$('selectState').value;
	else
		state.id=-1;
	state.nativeName=$('stateNativeName').value;
	state.nativeShortName=$('stateNativeShortName').value;
	state.nativeFullName=$('stateNativeFullName').value;
	state.nativeSortName=$('stateNativeSortName').value;
	state.countryId=$('stateCountry_id').value;
	state.continentId=$('stateContinent_id').value;
	var pos=$('stateMap').retrieve('marker').getPosition();
	if($('stateMap_lat').value!=pos.lat())
		state.latitude=pos.lat();
	if($('stateMap_long').value!=pos.lng())
		state.longitude=pos.lng();
	state.capitalCityId=$('stateCapital_id').value;
	state.privateComment=$('statePrivateComment').getElement('textarea').value;
	state.strings=new Array();
	$('stateNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var shortName=$('stateShortNames_'+lang).value;
		var fullName=$('stateFullNames_'+lang).value;
		var sortName=$('stateSortNames_'+lang).value;
		var comment=$('statePublicComment_'+lang).value;
		state.strings.push({'languageId':langId,'name':name,'fullName':fullName,'shortName':shortName,'sortName':sortName,'publicComment':comment,'stateId':state.id});	
	});
	var ajax=new Request.JSON({url:'states/saveState.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(state.id==-1) {
				$('selectState').adopt(new Element('option',{'value':result.id,'html':result._name}));
			}
			$('selectState').value=result.id;
			$('selectState').fireEvent('change',{target:$('selectState'),message:result.statusMsg});
		} else {
			onComplete(args,result);	
		}
	}}).post(state);	
}