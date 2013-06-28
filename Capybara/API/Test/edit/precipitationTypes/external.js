
function addPrecipitationType(caller,precipitationType) {
	var win=new popupWindow('precipitationTypes/precipitationTypeForm.php?nosave=1'+(precipitationType!=undefined?'&id='+precipitationType:''),{
		onOK:function() {
			this.hide();
			if(precipitationType!=undefined)
				fetchFromMasterDatabase('precipitationType',function(object) {
					var json=new Request.JSON({'url':'precipitationTypes/precipitationTypeJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				savePrecipitationType(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
		},
		showButtons: false
	});
	win.show();
}

function savePrecipitationType(onComplete,args) {
	var precipitationType=new Object();
	if($('selectPrecipitationType')!=null)
		precipitationType.id=$('selectPrecipitationType').value;
	else
		precipitationType.id=-1;
	precipitationType.strings=new Array();
	$('precipitationTypeNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('precipitationTypePublicComment_'+lang).value;
		precipitationType.strings.push({'languageId':langId,'name':name,'publicComment':comment,'precipitationTypeId':precipitationType.id});	
	});
	var ajax=new Request.JSON({url:'precipitationTypes/savePrecipitationType.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(precipitationType.id==-1) {
				$('selectPrecipitationType').adopt(new Element('option',{'value':result.id,'html':result._name}));
				$('selectPrecipitationType').value=result.id;
			}
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
		$('selectPrecipitationType').fireEvent('change',{target:$('selectPrecipitationType'),message:result.statusMsg});
	}}).post(precipitationType);	
}