
function addCardType(caller) {
	var win=new popupWindow('cardTypes/cardTypeForm.php?nosave=1',{
		onOK:function() {
			this.hide();
			saveCardType(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function saveCardType(onComplete,args) {
	var cardType=new Object();
	if($('selectCardType')!=null)
		cardType.id=$('selectCardType').value;
	else
		cardType.id=-1;
	cardType.strings=new Array();
	$('cardTypeNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('cardTypePublicComment_'+lang).value;
		cardType.strings.push({'languageId':langId,'name':name,'publicComment':comment,'cardTypeId':cardType.id});	
	});
	var ajax=new Request.JSON({url:'cardTypes/saveCardType.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(cardType.id==-1) {
				$('selectCardType').adopt(new Element('option',{'value':result.id,'html':result._name}));
				$('selectCardType').value=result.id;
			}
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
		$('selectCardType').fireEvent('change',{target:$('selectCardType'),message:result.statusMsg});
	}}).post(cardType);	
}