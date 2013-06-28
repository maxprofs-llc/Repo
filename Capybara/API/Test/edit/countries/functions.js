// JavaScript Document

function countryFormLoaded() {
	$('countryContinent').addEvent('update',function(e) {
		updatePosition(e.object);
	});
	$('countryNames').getElements('.defaultValue').addEvent('change',function(e) {
		var oldName=$('countryForm').getElement('p.headline').get('html');
		var newName=this.value;
		if($('countryCities')!=null) {
			var oldText=$('moveCityToCountry').value;
			newText=oldText.substring(0,oldText.lastIndexOf(oldName))+newName;
			$('moveCityToCountry').value=newText;
		}
		if($('countryStates')!=null) {
			var oldText=$('moveStateToCountry').value;
			newText=oldText.substring(0,oldText.lastIndexOf(oldName))+newName;
			$('moveStateToCountry').value=newText;
		}
		$('countryNames').getElements('input[type=text]').each(function(el) {
			if(el.value=='')
				el.value=newName;
		});
		if($('countryNativeName').value=='')
			$('countryNativeName').value=newName;
		$('countryForm').getElement('p.headline').set('html',newName);
	});	
}

function moveCityToCountry() {
	$('unknownCities').getElements('option[selected]').each(function(opt) { 
		var city=new Object();
		city.id=opt.value;
		city.countryid=$('selectCountry').value;
		var ajax=new Request.JSON({url:'cities/saveCity.php',onSuccess:function(result) {
			$('myCities').adopt(opt.clone());
			opt.dispose();
		}}).post(city);	
	});	
}

function moveCityToUnknown() {
	$('myCities').getElements('option[selected]').each(function(opt) { 
		var city=new Object();
		city.id=opt.value;
		city.countryid=0;
		var ajax=new Request.JSON({url:'cities/saveCity.php',onSuccess:function(result) {
			$('unknownCities').adopt(opt.clone());
			opt.dispose();
		}}).post(city);	
	});	
}

function moveStateToCountry() {
	$('unknownStates').getElements('option[selected]').each(function(opt) { 
		var state=new Object();
		state.id=opt.value;
		state.countryid=$('selectCountry').value;
		var ajax=new Request.JSON({url:'states/saveState.php',onSuccess:function(result) {
			$('myStates').adopt(opt.clone());
			opt.dispose();
		}}).post(state);	
	});	
}

function moveStateToUnknown() {
	$('myStates').getElements('option[selected]').each(function(opt) { 
		var state=new Object();
		state.id=opt.value;
		state.countryid=0;
		var ajax=new Request.JSON({url:'states/saveState.php',onSuccess:function(result) {
			$('unknownStates').adopt(opt.clone());
			opt.dispose();
		}}).post(state);	
	});	
}