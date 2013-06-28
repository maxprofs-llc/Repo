
function addAgeGroup(caller) {
	var win=new popupWindow('ageGroups/ageGroupForm.php?nosave=1',{
		onOK:function() {
			this.hide();
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
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('ageGroupPublicComment_'+lang).value;
		ageGroup.strings.push({'languageId':lang,'name':name,'publicComment':comment,'ageGroupId':ageGroup.id});	
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