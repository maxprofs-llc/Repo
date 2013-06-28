
function addCity(caller,org) {
	var win=new popupWindow('cities/cityForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('city',function(object) {
					var json=new Request.JSON({'url':'cities/cityJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveCity(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function saveCity(onComplete,args) {
	var city=new Object();
	if($('selectCity')!=null)
		city.id=$('selectCity').value;
	else
		city.id=-1;
	city.nativeName=$('cityNativeName').value;
	city.stateId=$('cityState_id').value;
	city.countryId=$('cityCountry_id').value;
	city.continentId=$('cityContinent_id').value;
	var pos=$('cityMap').retrieve('marker').getPosition();
	if($('cityMap_lat').value!=pos.lat())
		city.latitude=pos.lat();
	if($('cityMap_long').value!=pos.lng())
		city.longitude=pos.lng();
	city.url=$('cityLinkaddress').value;
	city.privateComment=$('cityPrivateComment').getElement('textarea').value;
	city.strings=new Array();
	$('cityNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('cityPublicComment_'+lang).value;
		city.strings.push({'languageId':langId,'name':name,'publicComment':comment,'cityId':city.id});	
	});
	var ajax=new Request.JSON({url:'cities/saveCity.php',onSuccess:function(result,resultText) {
		if(result!=null && result.status=='ok') {
			if(onComplete==null) {
				$('citySaveStatus').removeClass('error');
				saveInitialValues();
				if(city.id==-1) {
					$('selectCity').adopt(new Element('option',{'value':result.id,'html':result._name}));
				}
				$('selectCity').value=result.id;
				$('citySaveStatus').set('html',result.statusMsg);
				$('selectCity').fireEvent('change',{target:$('selectCity'),message:result.statusMsg});
			} else {
				onComplete(args,result);	
			}
		} else {
			$('citySaveStatus').addClass('error');
			if(result!=null)
				$('citySaveStatus').set('html',result.statusMsg);
			else
				$('citySaveStatus').set('html',resultText);
		}
	}}).post(city);	
}