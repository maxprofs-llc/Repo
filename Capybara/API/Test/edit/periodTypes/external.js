
function addPeriodType(caller,periodType) {
	var win=new popupWindow('periodTypes/periodTypeForm.php?nosave=1'+(periodType!=undefined?'&id='+periodType:''),{
		onOK:function() {
			this.hide();
			if(periodType!=undefined)
				fetchFromMasterDatabase('periodType',function(object) {
					var json=new Request.JSON({'url':'periodTypes/periodTypeJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				savePeriodType(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
		},
		showButtons: false
	});
	win.show();
}

function savePeriodType(onComplete,args) {
	var periodType=new Object();
	if($('selectPeriodType')!=null)
		periodType.id=$('selectPeriodType').value;
	else
		periodType.id=-1;
	periodType.strings=new Array();
	$('periodTypeNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('periodTypePublicComment_'+lang).value;
		periodType.strings.push({'languageId':langId,'name':name,'publicComment':comment,'periodTypeId':periodType.id});	
	});
	periodType.defaultLength=$('periodTypeDefaultLength').value;
	periodType.defaultStartTime=$('periodTypeDefaultStartTime').value;
	periodType.isPause=$('periodTypePause').checked ? 1 : 0;
	periodType.isEffectiveTime=$('periodTypeEffective').checked ? 1 : 0;
	//periodType.isExtension=$('periodTypeExtended').checked ? 1 : 0;
	periodType.isPenaltyShootout=$('periodTypePenaltyShootout').checked ? 1 : 0;
	var ajax=new Request.JSON({url:'periodTypes/savePeriodType.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(periodType.id==-1) {
				$('selectPeriodType').adopt(new Element('option',{'value':result.id,'html':result._name}));
				$('selectPeriodType').value=result.id;
			}
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
		$('selectPeriodType').fireEvent('change',{target:$('selectPeriodType'),message:result.statusMsg});
	}}).post(periodType);	
}