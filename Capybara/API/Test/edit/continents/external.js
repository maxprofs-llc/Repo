
function addContinent(caller,org) {
	var win=new popupWindow('continents/continentForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('continent',function(object) {
					var json=new Request.JSON({'url':'continents/continentJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveContinent(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function saveContinent(onComplete,args) {
	var continent=new Object();
	
	if($('selectContinent')!=null) 
		continent.id=$('selectContinent').value;
	else
		continent.id=-1;
	var pos=$('continentMap').retrieve('marker').getPosition();
	if($('continentMap_lat').value!=pos.lat())
		continent.latitude=pos.lat();
	if($('continentMap_long').value!=pos.lng())
		continent.longitude=pos.lng();	
	continent.privateComment=$('continentPrivateComment').getElement('textarea').value;
	continent.strings=new Array();
	$('continentNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var shortName=$('continentShortNames_'+lang).value;
		var comment=$('continentPublicComment_'+lang).value;
		continent.strings.push({'languageId':langId,'name':name,'publicComment':comment,'continentId':continent.id});	
	});
	var ajax=new Request.JSON({url:'continents/saveContinent.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(continent.id==-1) {
				$('selectContinent').adopt(new Element('option',{'value':result,'html':$('continentNames').getElement('.defaultValue').value}));
				$('selectContinent').value=result;
			}
		} else {
			onComplete(args,result);	
		}
	}}).post(continent);		
}