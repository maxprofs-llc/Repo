
function addAgeGroup(caller,org) {
	var win=new popupWindow('ageGroups/ageGroupForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('ageGroup',function(object) {
					var json=new Request.JSON({'url':'ageGroups/ageGroupJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveAgeGroup(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}


function saveAgeGroup(onComplete,args) {
	var ageGroup=new Object();
	if($('selectAgeGroup')!=null)
		ageGroup.id=$('selectAgeGroup').value;
	else
		ageGroup.id=-1;
	ageGroup.minAge=$('ageGroupMinAge').value;
	ageGroup.maxAge=$('ageGroupMaxAge').value;
	ageGroup.privateComment=$('ageGroupPrivateComment').getElement('textarea').value;
	ageGroup.strings=new Array();
	$('ageGroupNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('ageGroupPublicComment_'+lang).value;
		ageGroup.strings.push({'languageId':langId,'name':name,'publicComment':comment,'ageGroupId':ageGroup.id});	
	});
	var ajax=new Request.JSON({url:'ageGroups/saveAgeGroup.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(ageGroup.id==-1) {
				$('selectAgeGroup').adopt(new Element('option',{'value':result.id,'html':result._name}));
				$('selectAgeGroup').value=result.id;
			}
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
	}}).post(ageGroup);	
}