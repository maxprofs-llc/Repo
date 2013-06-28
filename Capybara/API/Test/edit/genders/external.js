
function addGender(caller,org) {
	var win=new popupWindow('genders/genderForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('gender',function(object) {
					var json=new Request.JSON({'url':'genders/genderJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveGender(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function saveGender(onComplete,args) {
	var gender=new Object();
	if($('selectGender')!=null)
		gender.id=$('selectGender').value;
	else
		gender.id=-1;
	gender.privateComment=$('genderPrivateComment').getElement('textarea').value;
	gender.strings=new Array();
	$('genderNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('genderPublicComment_'+lang).value;
		gender.strings.push({'languageId':langId,'name':name,'publicComment':comment,'genderId':gender.id});	
	});
	var ajax=new Request.JSON({url:'genders/saveGender.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(gender.id==-1) {
				$('selectGender').adopt(new Element('option',{'value':result.id,'html':result._name}));
				$('selectGender').value=result.id;
			}
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
	}}).post(gender);	
}