// JavaScript Document

function continentFormLoaded() {
	$('continentNames').getElements('.defaultValue').addEvent('change',function(e) {
		var oldName=$('continentForm').getElement('p.headline').get('html');
		var newName=this.value;
		if($('continentCities')!=null) {
			var oldText=$('moveCityToContinent').value;
			newText=oldText.substring(0,oldText.lastIndexOf(oldName))+newName;
			$('moveCityToContinent').value=newText;
		}
		if($('continentStates')!=null) {
			var oldText=$('moveStateToContinent').value;
			newText=oldText.substring(0,oldText.lastIndexOf(oldName))+newName;
			$('moveStateToContinent').value=newText;
		}
		if($('continentCountries')!=null) {
			var oldText=$('moveCountryToContinent').value;
			newText=oldText.substring(0,oldText.lastIndexOf(oldName))+newName;
			$('moveCountryToContinent').value=newText;
		}
		$('continentNames').getElements('input[type=text]').each(function(el) {
			if(el.value=='')
				el.value=newName;
		});
		$('continentForm').getElement('p.headline').set('html',newName);
	});
	$('continentShortNames').getElements('.defaultValue').addEvent('change',function(e) {
		var newName=this.value;
		$('continentShortNames').getElements('input[type=text]').each(function(el) {
			if(el.value=='')
				el.value=newName;
		});				
	});	
}

function moveCityToContinent() {
	$('unknownCities').getElements('option[selected]').each(function(opt) { 
		var city=new Object();
		city.id=opt.value;
		city.continentid=$('selectContinent').value;
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
		city.continentid=0;
		var ajax=new Request.JSON({url:'cities/saveCity.php',onSuccess:function(result) {
			$('unknownCities').adopt(opt.clone());
			opt.dispose();
		}}).post(city);	
	});	
}

function moveStateToContinent() {
	$('unknownStates').getElements('option[selected]').each(function(opt) { 
		var state=new Object();
		state.id=opt.value;
		state.continentid=$('selectContinent').value;
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
		state.continentid=0;
		var ajax=new Request.JSON({url:'states/saveState.php',onSuccess:function(result) {
			$('unknownStates').adopt(opt.clone());
			opt.dispose();
		}}).post(state);	
	});	
}

function moveCountryToContinent() {
	$('unknownCountries').getElements('option[selected]').each(function(opt) { 
		var country=new Object();
		country.id=opt.value;
		country.continentid=$('selectContinent').value;
		var ajax=new Request.JSON({url:'countries/saveCountry.php',onSuccess:function(result) {
			$('myCountries').adopt(opt.clone());
			opt.dispose();
		}}).post(country);	
	});	
}

function moveCountryToUnknown() {
	$('myCountries').getElements('option[selected]').each(function(opt) { 
		var country=new Object();
		country.id=opt.value;
		country.continentid=0;
		var ajax=new Request.JSON({url:'countries/saveCountry.php',onSuccess:function(result) {
			$('unknownCountries').adopt(opt.clone());
			opt.dispose();
		}}).post(country);	
	});	
}