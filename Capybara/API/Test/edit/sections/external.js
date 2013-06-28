function addSection(caller,org) {
	var win=new popupWindow('sections/sectionForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('section',function(object) {
					var json=new Request.JSON({'url':'sections/sectionJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveSection(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}


function saveSection(onComplete,args) {
	var section=new Object();
	if($('selectSection')!=null)
		section.id=$('selectSection').value;
	else
		section.id=-1;
	section.privateComment=$('sectionPrivateComment').getElement('textarea').value;
	section.strings=new Array();
	$('sectionNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('sectionPublicComment_'+lang).value;
		section.strings.push({'languageId':langId,'name':name,'publicComment':comment,'sectionId':section.id});	
	});
	var ajax=new Request.JSON({url:'sections/saveSection.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(section.id==-1) {
				$('selectSection').adopt(new Element('option',{'value':result.id,'html':result._name}));
				$('selectSection').value=result.id;
			}
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
	}}).post(section);	
}