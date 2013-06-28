function addSport(caller,org) {
	var win=new popupWindow('sports/sportForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('sport',function(object) {
					var json=new Request.JSON({'url':'sports/sportJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveSport(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function saveSport(onComplete,args) {
	var sport=new Object();
	if($('selectSport')!=null)
		sport.id=$('selectSport').value;
	else
		sport.id=-1;
	sport.privateComment=$('sportPrivateComment').getElement('textarea').value;
	sport.strings=new Array();
	$('sportNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('sportPublicComment_'+lang).value;
		sport.strings.push({'languageId':langId,'name':name,'publicComment':comment,'sportId':sport.id});	
	});
	var ajax=new Request.JSON({url:'sports/saveSport.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(sport.id==-1) {
				$('selectSport').adopt(new Element('option',{'value':result.id,'html':result._name}));
				$('selectSport').value=result.id;
			}
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
	}}).post(sport);	
}