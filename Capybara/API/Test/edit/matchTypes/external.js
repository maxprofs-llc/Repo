function addMatchType(caller) {
	var win=new popupWindow('matchTypes/matchTypeForm.php?nosave=1',{
		onOK:function() {
			this.hide();
			saveMatchType(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function saveMatchType(onComplete,args) {
	var matchType=new Object();
	if($('selectMatchType')!=null)
		matchType.id=$('selectMatchType').value;
	else
		matchType.id=-1;
	matchType.privateComment=$('matchTypePrivateComment').getElement('textarea').value;
	matchType.strings=new Array();
	$('matchTypeNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('matchTypePublicComment_'+lang).value;
		matchType.strings.push({'languageId':lang,'name':name,'publicComment':comment,'matchTypeId':matchType.id});	
	});
	var ajax=new Request.JSON({url:'matchTypes/saveMatchType.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(matchType.id==-1) {
				$('selectMatchType').adopt(new Element('option',{'value':result.id,'html':result._name}));
				$('selectMatchType').value=result.id;
			}
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
	}}).post(matchType);	
}