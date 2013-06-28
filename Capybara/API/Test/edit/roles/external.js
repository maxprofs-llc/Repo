
function addRole(caller,org) {
	var win=new popupWindow('roles/roleForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('role',function(object) {
					var json=new Request.JSON({'url':'roles/roleJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveRole(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function saveRole(onComplete,args) {
	var role=new Object();
	if($('selectRole')!=null)
		role.id=$('selectRole').value;
	else
		role.id=-1;
	role.parentRoleId=$('roleParentRole_id').value;
	role.privateComment=$('rolePrivateComment').getElement('textarea').value;
	role.strings=new Array();
	$('roleNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('rolePublicComment_'+lang).value;
		var fullName=$('roleFullNames_'+lang).value;
		var shortName=$('roleShortNames_'+lang).value;
		role.strings.push({'languageId':langId,'name':name,'fullName':fullName,'shortName':shortName,'publicComment':comment,'roleId':role.id});	
	});
	var ajax=new Request.JSON({url:'roles/saveRole.php',onSuccess:function(result,resultText) {
		if(result!=null && result.status=='ok') {
			if(onComplete==null) {
				$('roleSaveStatus').removeClass('error');
				saveInitialValues();
				if(role.id==-1) {
					$('selectRole').adopt(new Element('option',{'value':result.id,'html':result._name}));
					$('selectRole').value=result.id;
				}
				$('roleSaveStatus').set('html',result.statusMsg);
			} else {
				onComplete(args,result);	
			}
		} else {
			$('roleSaveStatus').addClass('error');
			if(result!=null)
				$('roleSaveStatus').set('html',result.statusMsg);
			else
				$('roleSaveStatus').set('html',resultText);
		}
	}}).post(role);	
}