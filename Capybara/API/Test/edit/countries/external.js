
function addCountry(caller,org) {
	var win=new popupWindow('countries/countryForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('country',function(object) {
					var json=new Request.JSON({'url':'countries/countryJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveCountry(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function saveCountry(onComplete,args) {
	var country=new Object();
	
	if($('selectCountry')!=null) 
		country.id=$('selectCountry').value;
	else
		country.id=-1;
	country.nativeName=$('countryNativeName').value;
	country.capitalCityId=$('countryCapital_id').value;
	country.iso2=$('countryIso2').value;
	country.iso3=$('countryIso3').value;
	country.numCode=$('countryNumCode').value;
	country.continentId=$('countryContinent_id').value;
	var pos=$('countryMap').retrieve('marker').getPosition();
	if($('countryMap_lat').value!=pos.lat())
		country.latitude=pos.lat();
	if($('countryMap_long').value!=pos.lng())
		country.longitude=pos.lng();
	country.privateComment=$('countryPrivateComment').getElement('textarea').value;
	country.strings=new Array();
	$('countryNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('countryPublicComment_'+lang).value;
		country.strings.push({'languageId':langId,'name':name,'publicComment':comment,'countryId':country.id});	
	});
	var ajax=new Request.JSON({url:'countries/saveCountry.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(country.id==-1) {
				$('selectCountry').adopt(new Element('option',{'value':result,'html':$('countryNames').getElement('.defaultValue').value}));
				$('selectCountry').value=result;
			}
		} else {
			onComplete(args,result);	
		}
	}}).post(country);		
}