function addOrganizationType(caller,org) {
	var win=new popupWindow('organizationTypes/organizationTypeForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('organizationType',function(object) {
					var json=new Request.JSON({'url':'organizationTypes/organizationTypeJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveOrganizationType(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function saveOrganizationType(onComplete,args) {
	var organizationType=new Object();
	if($('selectOrganizationType')!=null)
		organizationType.id=$('selectOrganizationType').value;
	else
		organizationType.id=-1;
	organizationType.privateComment=$('organizationTypePrivateComment').getElement('textarea').value;
	organizationType.strings=new Array();
	$('organizationTypeNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('organizationTypePublicComment_'+lang).value;
		organizationType.strings.push({'languageId':lang,'name':name,'publicComment':comment,'organizationTypeId':organizationType.id});	
	});
	var ajax=new Request.JSON({url:'organizationTypes/saveOrganizationType.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(organizationType.id==-1) {
				$('selectOrganizationType').adopt(new Element('option',{'value':result.id,'html':result._name}));
				$('selectOrganizationType').value=result.id;
			}
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
	}}).post(organizationType);	
}