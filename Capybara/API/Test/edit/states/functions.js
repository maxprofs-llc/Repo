// JavaScript Document

function stateFormLoaded() {
	$('stateCountry').addEvent('update',function(e) {
		if($('filterCities')!=null) {
			var label=$('filterCities')	.getElement('span');
			var labelText=label.get('html');
			labelText=labelText.substring(0,labelText.lastIndexOf(e.oldText))+e.newText;
			label.set('html',labelText);
		}
		if($('stateContinent_id').value=='') {
			setValue('stateContinent',e.object._continent.id,e.object._continent._name,e.object);
		}
		updatePosition(e.object);
	});
	$('stateNames').getElements('.defaultValue').addEvent('change',function(e) {
		var oldName=$('stateForm').getElement('p.headline').get('html');
		var newName=this.value;
		if($('stateCities')!=null) {
			var oldText=$('moveCityToState').value;
			newText=oldText.substring(0,oldText.lastIndexOf(oldName))+newName;
			$('moveCityToState').value=newText;
			var tmp=$('stateCities').getElement('table').getElements('tr')[4].getElement('p.smallheadline');;
			oldText=tmp.get('html');
			newText=oldText.substring(0,oldText.lastIndexOf(oldName))+newName;
			tmp.set('html',newText);		
		}
		$('stateNames').getElements('input[type=text]').each(function(el) {
			if(el.value=='')
				el.value=newName;
		});
		$('stateFullNames').getElements('input[type=text]').each(function(el) {
			if(el.value=='')
				el.value=newName;
		});
		$('stateSortNames').getElements('input[type=text]').each(function(el) {
			if(el.value=='')
				el.value=newName;
		});
		if($('stateNativeName').value=='')
			$('stateNativeName').value=newName;
		if($('stateNativeFullName').value=='')
			$('stateNativeFullName').value=newName;
		if($('stateNativeSortName').value=='')
			$('stateNativeSortName').value=newName;
		$('stateForm').getElement('p.headline').set('html',newName);
	});
}

function filterCities() {
	var vars={};
	if($('filterCities').getElement('input').get('checked'))
		vars={'countryid':$('stateCountry_id').value,'stateid':0};
		
	var ajax=new Request.JSON({url:'cities/cityJSON.php',onSuccess:function(result){
		var cityList=$('unknownCities');
		cityList.empty();
		result.each(function(city) {
			var opt=new Element('option',{'value':city.id,'html':city._name});
			cityList.adopt(opt);
		});
	}}).get(vars);
}

function moveCityToState() {
	$('unknownCities').getElements('option[selected]').each(function(opt) { 
		var city=new Object();
		city.id=opt.value;
		city.stateid=$('selectState').value;
		var ajax=new Request.JSON({url:'cities/saveCity.php',onSuccess:function(result) {
			$('myCities').adopt(opt.clone());
			opt.dispose();
		}}).post(city);	
	});	
}
