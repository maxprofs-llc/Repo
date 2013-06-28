// JavaScript Document

function langFormLoaded() {
}

function saveLanguage() {
	$$('#langForm input').each(function(el){
		if(el.value!=el.retrieve('initialValue')){
			var string=el.getParent('tr').getElement('.label').get('html');
			string=String(string).substring(0, string.length-1);
			var translation=el.value;
			ajax=new Request.JSON({url:'lang/saveLang.php',async:false}).get({'string':string,'translation':translation});
			el.store('initialValue',el.value);
		}
	});
	location.reload();
}

function addPhrase() {
	var string=$('newPhrase_en').value;
	$$('#newForm input[type=text]').each(function(el) {
		if(el.get('id')!='newPhrase_en') {
			var translation=el.value;
			ajax=new Request.JSON({url:'lang/saveLang.php',async:false}).get({'string':string,'translation':translation});
		}
	});
	location.reload();
}

