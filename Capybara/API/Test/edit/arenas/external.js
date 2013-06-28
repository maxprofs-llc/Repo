function addArena(caller,org) {
	var win=new popupWindow('arenas/arenaForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('arena',function(object) {
					var json=new Request.JSON({'url':'arenas/arenaJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveArena(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function saveArena(onComplete,args) {
	var arena=new Object();
	if($('selectArena')!=null)
		arena.id=$('selectArena').value;
	else
		arena.id=-1;
	arena.nativeName=$('arenaNativeName').value;
	arena.url=$('arenaLinkaddress').value;
	arena.privateComment=$('arenaPrivateComment').getElement('textarea').value;
	//Strings
	arena.strings=new Array();
	$('arenaNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('arenaPublicComment_'+lang).value;
		arena.strings.push({'languageId':langId,'name':name,'publicComment':comment,'arenaId':arena.id});	
	});
	//Location
	arena.id=$('arenaLocationId').value;
	arena.cityid=$('arenaCity_id').value;
	arena.stateId=$('arenaState_id').value;
	arena.countryId=$('arenaCountry_id').value;
	arena.continentId=$('arenaContinent_id').value;
	arena.streetName=$('arenaStreet').value;
	arena.streetNumber=$('arenaStreetNumber').value;
	arena.zipCode=$('arenaZipCode').value;
	arena.zipArea=$('arenaZipArea').value;
	arena.latitude=$('arenaMap').retrieve('marker').getPosition().lat();
	arena.longitude=$('arenaMap').retrieve('marker').getPosition().lng();
	
	var ajax=new Request.JSON({url:'arenas/saveArena.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(arena.id==-1) {
				$('selectArena').adopt(new Element('option',{'value':result.id,'html':result._name}));
				$('selectArena').value=result.id;
			}
		} else {
			onComplete(args,result);	
		}
	}}).post(arena);	
}

function removeImageLinkToSelected() {
	var list=$('arenaImageList');
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